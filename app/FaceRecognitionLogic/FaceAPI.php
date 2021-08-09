<?php
namespace App\FaceRecognitionLogic;
use HTTP_Request2;
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

    public function detectFace($imageUrl){
        
        $request = new HTTP_Request2("https://fita.cognitiveservices.azure.com//face/v1.0/" . '/detect');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        //getting the url where the request will be sent
        $url = $request->getUrl();
        
        //Setting the headers for the request 
        $request->setHeader($this->headers);

        //setting query variables in the url
        $parameters = array(
            'detectionModel' => 'detection_03',
            'returnFaceId' => 'true'
        );

        $url->setQueryVariables($parameters);

        // Request body parameters
        $body = json_encode(array('url' => $imageUrl));
        //Setting request body
        $request->setBody($body);

        try
        {
            $response = $request->send();
            return $response->getBody();
            // return "<pre>" .
            //     json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
        }
        catch (HttpException $ex)
        {
            echo "<pre>" . $ex . "</pre>";
        }
        // $response = $request->send();
        // return json_encode($response);
       
    }
    

} 

?>