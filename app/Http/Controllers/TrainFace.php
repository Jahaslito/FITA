<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FaceRecognitionLogic\FaceAPI;
// use App\FaceRecognitionLogic\FaceAPI as ControllersFaceAPI;
use HTTP_Request2;


// use HTTPNEW\HTTP_Request2;
require_once 'HTTP/Request2.php';
// use pear\http_request2\HTTP\Request2;

class TrainFace extends Controller
{
    public static $uriBase ='https://fita.cognitiveservices.azure.com//face/v1.0/';
            //setting the method of request
    public function detectPhoto(Request $requestReceived){
  
        // dd(HTTP\HTTP_Request2);
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
        
        $imageUrl= 'https://e0c142c81677.ngrok.io/storage/'.$path;  
        return $imageUrl;
        return $faceAPI->detectFace($imageUrl);
        }else{
            return "Hey";
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
    }

}
