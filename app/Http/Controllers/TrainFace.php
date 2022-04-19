<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FaceRecognitionLogic\FaceAPI;
use App\Models\DailyRecord;
use App\Models\FaceDetails;
use App\Models\User;
use App\Models\ScreeningData;
use App\Models\Log;
// use App\FaceRecognitionLogic\FaceAPI as ControllersFaceAPI;
use HTTP_Request2;


class TrainFace extends Controller
{
    public static $uriBase ='https://fita.cognitiveservices.azure.com//face/v1.0/';
            //setting the method of request
    public function detectPhoto(Request $requestReceived){
  
        $requestReceived->validate([
            'uploaded-photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userId= Auth::user()->id;

        $photo= $requestReceived->file('uploaded-photo');
       
        if ($photo) {
        $imageExtension= $photo->extension();
        $imageName = "trained_photo".$userId.'.'.$imageExtension;
        $path = $photo->storeAs('TrainedPhotos', $imageName, 'public');
       
        

        $faceAPI = new FaceAPI();
        
        $imageUrl= env('ngrokLink').'/FITA/public/storage/'.$path;  
        //return $imageUrl;
        return $faceAPI->detectFace($imageUrl);
        }else{
            return "Something went wrong!";
        }

    }
    public function createPersonGroup(Request $request){
        $faceAPI = new FaceAPI();
        return $faceAPI->createPersonGroup();
    }

    public function trainFace(Request $requestReceived){

        /**
         * Validating the photo
         */
        // $requestReceived->validate([
        //     'uploaded_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);


        $userId= Auth::user()->id;
        $uploadWay=$requestReceived->type;
        // return $uploadWay;
        $path="";
        
        #Identifying which method is used to upload the image for training
        #Storing the Image before communicating with the API 
        if ($uploadWay=="webcam") {
            
            $img = $requestReceived->uploaded_photo;
            $folderPath = public_path()."/storage/TrainedPhotos/";
          
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
          
            $image_base64 = base64_decode($image_parts[1]);
            
            #Default image extension for photos taken using webcam
            $imageExtension="png";
            $imageName = "trained_photo".$userId.'.'.$imageExtension;
           
            $file = $folderPath . $imageName;
            file_put_contents($file, $image_base64);
            $path= 'TrainedPhotos/'.$imageName;          

        }else if($uploadWay=="profile"){
            if (Auth::user()->profile_photo_path!=NULL) {
                $path="photos/".Auth::user()->profile_photo_path;
            }else{
                return "No profile picture is found";
            }
           
        }else{
            $photo= $requestReceived->file('uploaded_photo');
            if ($photo) {
                $imageExtension= $photo->extension();
                $imageName = "trained_photo".$userId.'.'.$imageExtension;
                $path = $photo->storeAs('TrainedPhotos', $imageName, 'public');
            }else{
                return "Invalid Image";
            }
        }
        
        $imageUrl= env('ngrokLink').'/FITA/public/storage/'.$path;
        
        $faceAPI = new FaceAPI();
        
        
        #Detecting a face in the image
         
         $faceDetectionResult= $faceAPI->detectFace($imageUrl);
         $faceDetectionResult= json_decode($faceDetectionResult);
        // return $faceDetectionResult;
         if(count($faceDetectionResult)==0){
            return "No Face Detected";
        }
         if (isset($faceDetectionResult[0]->faceId)) {
    
            #If Face Detected successfully  
            #Check if a person is created for this particular user in the API 
            $face = FaceDetails::where('user_id', Auth::user()->id)->first();

            if ($face!=null) {
                // return "face not null called";
                
                 #Code if the person exists in the remote server already
                 #Add the image in the PersonGroup person created in the API
                 
                $personId= $face->person_id;

                $responseForAddingFace= $faceAPI->addFaceToPerson($personId,$imageUrl);
                $responseForAddingFace= json_decode($responseForAddingFace);
                
                if(isset($responseForAddingFace->persistedFaceId)){
                    $this->trainPersonGroup();
                    return $this->addFaceDetail($responseForAddingFace->persistedFaceId,$personId,$path,Auth::user()->id);
                }else{
                    return "something went wrong in adding a face\n";
                    #.json_encode($responseForAddingFace)
                }
                
    
            }else{
               
                 # Code if the person doesn't exist in the remote server already
                 # Create a PersongGroup Person then add the image in it.
               
                $createPersonResult = $faceAPI->createPerson();
                $createPersonResult= json_decode($createPersonResult);
                if (isset($createPersonResult->personId)) {
                    $personId= $createPersonResult->personId;

                    $responseForAddingFace= $faceAPI->addFaceToPerson($personId,$imageUrl);
                    $responseForAddingFace= json_decode($responseForAddingFace);

                    if(isset($responseForAddingFace->persistedFaceId)){
                        $this->trainPersonGroup();
                        $finalResponse = $this->addFaceDetail($responseForAddingFace->persistedFaceId,$personId,$path,Auth::user()->id);
                        return $finalResponse;
                    }else{
                        return "something went wrong in adding a face\n";
                        #.json_encode($responseForAddingFace)
                    }

                }else{
                    return "something went wrong with creating a person\n";
                    #.json_encode($createPersonResult)
                }
            }
         }else{
             return "System couldn't detect a face\n";
             #.json_encode($faceDetectionResult)
         }
        

        
        $faceAPI = new FaceAPI();
        
    }
    public function addFaceDetail($persistedFaceId,$personId,$path,$user_id){
        $newFaceDetail= new FaceDetails();
        $newFaceDetail->face_id= $persistedFaceId;
        $newFaceDetail->person_id=$personId;
        $newFaceDetail->training_photo_path=$path;
        $newFaceDetail->user_id=$user_id;
        $newFaceDetail->save();
        return "success";
    }
    public function listPersons(){
        $faceAPI = new FaceAPI();
        return $faceAPI->listPersons();
    }

    public function listPersonGroups(){
        $faceAPI = new FaceAPI();
        return $faceAPI->listPersonGroups();
    }

    public function deletePerson(){
        $faceAPI = new FaceAPI();
        return $faceAPI->deletePerson();

    }

    public function deleteFace(){
        $faceAPI = new FaceAPI();
        return $faceAPI->deleteFace();
    }
    public function trainPersonGroup(){
        $faceAPI = new FaceAPI();
        return $faceAPI->trainPersonGroup(); 
    }

    public function identifyFace(Request $request){
    
    #Storing the Image before communicating with the API
        $img = $request->uploaded_photo;
        $folderPath = public_path()."/storage/IdentifiedPhotos/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        
        #Default image extension for photos taken using webcam
        $imageExtension="png";
        $imageName = "identified_photo".time().'.'.$imageExtension;
        
        $file = $folderPath . $imageName;
        file_put_contents($file, $image_base64);
        $path= 'IdentifiedPhotos/'.$imageName;     
         
        $imageUrl= env('ngrokLink').'/FITA/public/storage/'.$path;  
        $faceAPI = new FaceAPI();
        
        
        #Detecting a face in the image
        $faceDetectionResult= $faceAPI->detectFace($imageUrl);
        $faceDetectionResult= json_decode($faceDetectionResult);
        // return $faceDetectionResult;
        if(count($faceDetectionResult)==0){
            return "ERROR_3";
        }
        if (isset($faceDetectionResult[0]->faceId)) {
            $response= $faceAPI->identifyFace($faceDetectionResult[0]->faceId);
            $response=json_decode($response);  
            
            #Looking for a match inside the trained Photos
            if (isset($response[0]->candidates)) {
                if (isset($response[0]->candidates[0]->personId)) {
                    $identifiedPersonId=$response[0]->candidates[0]->personId;
                    $identifiedFaceDetail= FaceDetails::where('person_id',$identifiedPersonId)->first();
                    $identifiedUserId=$identifiedFaceDetail->user_id;
                    $identifiedUser= User::where('id',$identifiedUserId)->first();
                    $identifiedUserFullName= $identifiedUser->first_name." ".$identifiedUser->last_name;
                    //return $identifiedUserFullName;

                    #Checking if the user's attendance is taken for the day 
                    date_default_timezone_set('Africa/Nairobi');
                    $date = date('F'). " ".date('d')." ".date('Y');
                    $data= Log::where("user_id",$identifiedUserId)->where("date",$date)->first();
                    //return json_encode($data);
                    #if the user's attendance is taken 
                    if($data!=null){
                        #construct the response
                        $finalResponse= array("name"=>$identifiedUserFullName,"attendance"=>"Taken");
                        return json_encode($finalResponse);
                    }else{
                        #if the user's attendance isn't taken
                        date_default_timezone_set('Africa/Nairobi');
                        $time = date('H:i:s');

                        $log = new Log();
                        $log->date = $date;
                        $log->time = $time;
                        $log->user_id = $identifiedUserId;
                        $log->save();

                        #construct the response
                        $finalResponse= array("name"=>$identifiedUserFullName,"attendance"=>"success");
                        return json_encode($finalResponse);
                    
                    
                    //     $existingDailyRecord= DailyRecord::where("screening_data_id",$data->id);
                    //    // return json_encode($existingDailyRecord);
                    //     if (json_encode($existingDailyRecord)=="{}") {
                    //         $dailyRecord= new DailyRecord();

                    //         $dailyRecord->screening_data_id= $data->id;
                    //         $dailyRecord->save();

                    //         #construct the response
                    //         $finalResponse= array("name"=>$identifiedUserFullName,"screeningData"=>"Filled");
                    //         return json_encode($finalResponse);
                    //     }else{
                    //         return "ERROR_4";
                    //     }

                       
                    }
                }else{
                    return "ERROR_1";//This error code is interpreted in the javascript file
                }
            }else {
                return "ERROR_2";//This error code is interpreted in the javascript file
            }
                    
        }    
    }

}
