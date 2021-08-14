<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FaceRecognitionLogic\FaceAPI;
use App\Models\FaceDetails;
// use App\FaceRecognitionLogic\FaceAPI as ControllersFaceAPI;
use HTTP_Request2;


// use HTTPNEW\HTTP_Request2;

// use pear\http_request2\HTTP\Request2;

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
        
        $imageUrl= 'https://6e4725ac53e1.ngrok.io/FITA/public/storage/'.$path;  
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
        $requestReceived->validate([
            'uploaded-photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /**
         * Storing the Image before communicating with the API
         */
        $userId= Auth::user()->id;
        $photo= $requestReceived->file('uploaded-photo');
        if ($photo) {
        $imageExtension= $photo->extension();
        $imageName = "trained_photo".$userId.'.'.$imageExtension;
        $path = $photo->storeAs('TrainedPhotos', $imageName, 'public');
        $faceAPI = new FaceAPI();
        $imageUrl= 'https://f87f717fe019.ngrok.io/FITA/public/storage/'.$path;  

        /**
         * Detecting a face in the image
         */
         $faceDetectionResult= $faceAPI->detectFace($imageUrl);
         $faceDetectionResult= json_decode($faceDetectionResult);

         if (isset($faceDetectionResult[0]->faceId)) {
         
            /**
             * If Face Detected successfully  
             */

            //Check if a person is created for this particular user in the API 
            $face = FaceDetails::where('user_id', Auth::user()->id)->first();

            if ($face!=null) {
                // return "face not null called";
                /**
                 *Code if the person exists in the remote server already
                 *Add the image in the PersonGroup person created in the API
                 */
                $personId= $face->person_id;

                $responseForAddingFace= $faceAPI->addFaceToPerson($personId,$imageUrl);
                $responseForAddingFace= json_decode($responseForAddingFace);
                
                if(isset($responseForAddingFace->persistedFaceId)){
                    $this->addFaceDetail($responseForAddingFace->persistedFaceId,$personId,$path,Auth::user()->id);
                }else{
                    return "something went wrong in adding a face\n".json_encode($responseForAddingFace);
                }
                
    
            }else{
                /**
                 * Code if the person doesn't exist in the remote server already
                 * Create a PersongGroup Person then add the image in it.
                 */
                // return "face not found";
               
                $createPersonResult = $faceAPI->createPerson();
                $createPersonResult= json_decode($createPersonResult);
                if (isset($createPersonResult->personId)) {
                    $personId= $createPersonResult->personId;

                    $responseForAddingFace= $faceAPI->addFaceToPerson($personId,$imageUrl);
                    $responseForAddingFace= json_decode($responseForAddingFace);

                    if(isset($responseForAddingFace->persistedFaceId)){
                        $finalResponse = $this->addFaceDetail($responseForAddingFace->persistedFaceId,$personId,$path,Auth::user()->id);
                        return $finalResponse;
                    }else{
                        return "something went wrong in adding a face\n".json_encode($responseForAddingFace);
                    }

                }else{
                    return "something went wrong with creating a person\n".json_encode($createPersonResult);
                }
            }
         }else{
             return "System couldn't detect a face\n".json_encode($faceDetectionResult);
         }
        }else{
            return "Something went wrong with saving the image!";
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
        return "face trained successfully";
    }
    public function listPersons(){
        $faceAPI = new FaceAPI();
        dd("<pre>".$faceAPI->listPersons()."</pre>") ; 
    }
    public function deletePerson(){
        $faceAPI = new FaceAPI();
        dd("<pre>".$faceAPI->deletePerson()."</pre>") ; 
    }

    public function deleteFace(){
        $faceAPI = new FaceAPI();
        dd("<pre>".$faceAPI->deleteFace()."</pre>") ; 
    }
    public function trainPersonGroup(){
        $faceAPI = new FaceAPI();
        dd("<pre>".$faceAPI->trainPersonGroup()."</pre>") ; 
    }

    public function identifyFace(Request $request){
         /**
         * Validating the photo
         */
        // return "hey";
        $request->validate([
            'uploaded-photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /**
         * Storing the Image before communicating with the API
         */
        $userId= Auth::user()->id;
        $photo= $request->file('uploaded-photo');
        if ($photo) {
        $imageExtension= $photo->extension();
        $imageName = "trained_photo".$userId.'.'.$imageExtension;
        $path = $photo->storeAs('VerifiedPhotos', $imageName, 'public');
        $faceAPI = new FaceAPI();
        $imageUrl= 'https://f87f717fe019.ngrok.io/FITA/public/storage/'.$path;  

        /**
         * Detecting a face in the image
         */
         $faceDetectionResult= $faceAPI->detectFace($imageUrl);
         $faceDetectionResult= json_decode($faceDetectionResult);
            // return $faceDetectionResult[0]->faceId;
         if (isset($faceDetectionResult[0]->faceId)) {
            return $faceAPI->identifyFace($faceDetectionResult[0]->faceId) ; 
         }

        
    }
}

}

        // $user->profile_photo_path = $imageName;
        // $user->save();
        // return "success";
        // $request = new Http_Request2($uriBase . '/detect');
        // $request->setMethod(HTTP_Request2::METHOD_POST);
        // $parameters = array(
        //     'detectionModel' => 'detection_03',
        //     'returnFaceId' => 'true'
        // );
        // $faceAPI = new FACEAPI();

        // return $faceAPI->detectFace($request,$parameters, $imageUrl);