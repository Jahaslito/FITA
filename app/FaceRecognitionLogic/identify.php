<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'common.php';
$personGroupId= "trial_1";

require_once 'common.php';

$imageUrl= "https://65edf7d32230.ngrok.io/face recognition/test2.jpg";

$request = new Http_Request2($uriBase . '/detect');
$url = $request->getUrl();
echo $url;
// $headers = array(
//     // Request headers
//     'Content-Type' => 'application/json',
//     'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
// );
$request->setHeader($headers);

$parameters = array(
    // Request parameters
    'detectionModel' => 'detection_03',
    'returnFaceId' => 'true',
    'recognitionModel' => 'recognition_04'
    );
$url->setQueryVariables($parameters);
$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body parameters
$body = json_encode(array('url' => $imageUrl));

// Request body
$request->setBody($body);
$firstResponse;
$faceId;
try
{
    $firstResponse = $request->send();
    $firstResponse= json_decode($firstResponse->getBody());
    echo "<pre>";
    print_r($firstResponse);
    echo "</pre>";
    $faceId = $firstResponse[0]->faceId;
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
echo "Face id: ".$faceId."\n";

$request = new Http_Request2($uriBase . '/identify');
$url = $request->getUrl();
$request->setHeader($headers);
$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
$body= json_encode(
    array(
        "personGroupId"=>$personGroupId,
        "faceIds"=> [
            $faceId
        ],
        "recognitionModel" => "recognition_04",
        "maxNumOfCandidatesReturned"=> 1,
        "confidenceThreshold"=> 0.7
        )
    );
$request->setBody($body);

try
{
    $response = $request->send();
    echo $response->getBody();
}
catch (HttpException $ex)
{
    echo $ex;
}

?>