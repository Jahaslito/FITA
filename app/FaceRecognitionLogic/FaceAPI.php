<?php
namespace App\FaceRecognitionLogic;

use App\Models\FaceDetails;
use HTTP_Request2;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
class FaceAPI {

     public  $headers;
     public  $uriBase;
    public function __construct()
    {
        $this->headers= array(
        'Content-Type' => 'application/json',
        'Ocp-Apim-Subscription-Key' => env('ocpApimSubscriptionKey') 
        ) ;
        $this->uriBase ='https://fita.cognitiveservices.azure.com//face/v1.0/';
    }

        /**
         * Method for detecting A Face
         * @return String Face Id or an error
         */
    public function detectFace($imageUrl){
        
        $request = new HTTP_Request2($this->uriBase. '/detect');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        //getting the url where the request will be sent
        $url = $request->getUrl();
        
        //Setting the headers for the request 
        $request->setHeader($this->headers);

        //setting query variables in the url
        $parameters = array(
            'detectionModel' => 'detection_03',
            'returnFaceId' => 'true',
            'recognitionModel' => 'recognition_04'
        );

        //Binding the parameters in the url
        $url->setQueryVariables($parameters);

        // Request body parameters
        $body = json_encode(array('url' => $imageUrl));

        //Setting request body
        $request->setBody($body);

        try
        {
            //send the request
            $response = $request->send();
            //return the response
            return $response->getBody();
           
        }
        catch (HttpException $ex)
        {
            return "<pre>" . $ex . "</pre>";
        }
       
    }
    
      /**
         * Method for creating a person group
         * @return String persongroup Id or an error
        */
    
    public function createPersonGroup(){
       
        //Initializing the person group id
        $personGroupId= "trained_students_1";

        //Creating the request
        $request = new Http_Request2($this->uriBase . '/persongroups/'.$personGroupId);

        //getting the url where the request will be sent
        $url = $request->getUrl();
        
        //Setting the headers for the request 
        $request->setHeader($this->headers);
        
        //Body
        $body= json_encode(array(
            "name" => "group1",
            "userData" => "user-provided data attached to the person group.",
            "recognitionModel" => "recognition_04"
            ));

        //setting the request method
        $request->setMethod(HTTP_Request2::METHOD_PUT);
        
        // Request body
        $request->setBody($body);
        
        try
        {
            $response = $request->send();
            dd($response->getBody());
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }

    /** 
     * Method for creating a persongroup person
     * @return String persongroup Id or an error
    */
    public function createPerson(){

        $personGroupId= "trained_students_1";
        
        //Creating the request
        $request = new Http_Request2($this->uriBase.'/persongroups/'.$personGroupId.'/persons');
        
        $url = $request->getUrl();

        //Setting the request header
        $request->setHeader($this->headers);

        //Specifying the method
        $request->setMethod(HTTP_Request2::METHOD_POST);

        // Request body 

        $name= "Person".Auth::id();
        $actualFullName= Auth::user()->first_name." ".Auth::user()->last_name;

        $body= json_encode(
            array(
                'name' => $name,
                'userData' => $actualFullName
                )
            );
        $request->setBody($body);

        try
        {
            $response = $request->send();
            return $response->getBody();
        }
        catch (HttpException $ex)
        {
            return $ex;
        }
    }

    //This method adds image to a PersonGroup Person
    public function addFaceToPerson($personId,$imageUrl){
        $personGroupId= "trained_students_1";
        $request = new Http_Request2($this->uriBase.'persongroups/'.$personGroupId.'/persons/'.$personId.'/persistedFaces');

        $url = $request->getUrl();
               
        $request->setHeader($this->headers);
        
        $parameters = array(
            // Request parameters
            'detectionModel' => 'detection_03',
        );
        
        $url->setQueryVariables($parameters);
        
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        $body= json_encode(
            array(
                'url' => $imageUrl
                )
            );

        // Request body
        $request->setBody($body);
        
        try
        {
            $response = $request->send();
            return $response->getBody();
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
        
    }
    public function listPersons(){
        $personGroupId= "trained_students_1";
        $request = new Http_Request2($this->uriBase.'persongroups/'.$personGroupId.'/persons');
        $url = $request->getUrl();

        $headers = array(
            'Ocp-Apim-Subscription-Key' => env('ocpApimSubscriptionKey'),
        );

        $request->setHeader($headers);

        $parameters = array(
            // Request parameters
            'top' => '100',
        );

        $url->setQueryVariables($parameters);

        $request->setMethod(HTTP_Request2::METHOD_GET);

        // Request body
        // $request->setBody("{body}");

        try
        {
            $response = $request->send();
            return ($response->getBody());
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }
    public function deletePerson(){
        $personGroupId= "trained_students_1";
        $personId="3c97ff3f-7321-4d54-b293-aed6eb56d38f"; 
        $request = new Http_Request2($this->uriBase."persongroups/".$personGroupId."/persons/".$personId);
        $url = $request->getUrl();

        $headers = array(
            // Request headers
            'Ocp-Apim-Subscription-Key' => env('ocpApimSubscriptionKey'),
        );

        $request->setHeader($headers);

        $request->setMethod(HTTP_Request2::METHOD_DELETE);

        try
        {
            $response = $request->send();
            return $response->getBody();
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }
    public function deleteFace(){
        $personGroupId= "trained_students_1";
        $personId="d769bf6a-a2ce-48fa-a0d5-f7b60c69ae26"; 
        $persistedFaceId="c154d310-1bd1-4d36-9c8b-fca7bf9e9c71";
        $request = new Http_Request2($this->uriBase.'persongroups/'.$personGroupId.'/persons/'.$personId.'/persistedFaces/'.$persistedFaceId);
        $url = $request->getUrl();

        $headers = array(
            // Request headers
            'Ocp-Apim-Subscription-Key' => env('ocpApimSubscriptionKey'),
        );

        $request->setHeader($headers);

        $request->setMethod(HTTP_Request2::METHOD_DELETE);

        try
        {
            $response = $request->send();
            return $response->getBody();
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }
    public function trainPersonGroup(){
        $personGroupId="trained_students_1";
        $request = new Http_Request2($this->uriBase.'persongroups/'.$personGroupId.'/train');
        $headers = array(
            // Request headers
            'Ocp-Apim-Subscription-Key' => env('ocpApimSubscriptionKey'),
        );

        $request->setHeader($headers);

        $request->setMethod(HTTP_Request2::METHOD_POST);
        try
        {
            $response = $request->send();
            return $response->getBody();
        }
        catch (HttpException $ex)
        {
            return $ex;
        }
    }
    
    public function identifyFace($faceId){
        $personGroupId="trained_students_1";
        $request = new Http_Request2($this->uriBase.'identify');
        $url = $request->getUrl();

        $request->setHeader($this->headers);

        $parameters = array(
            'detectionModel' => 'detection_03',
            'returnFaceId' => 'true',
            'recognitionModel' => 'recognition_04'
        );

        $url->setQueryVariables($parameters);

        $request->setMethod(HTTP_Request2::METHOD_POST);

        // Request body
        $body= json_encode(
            array(
                'personGroupId' => $personGroupId,
                'faceIds' => array($faceId),
                'maxNumOfCandidatesReturned' => 1,
                'confidenceThreshold'=> 0.5
                )
            );
        
        $request->setBody($body);

        try
        {
            $response = $request->send();
            $response= $response->getBody();
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }
    

} 

?>