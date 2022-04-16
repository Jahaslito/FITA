<?php
require_once 'common.php';

$imageUrl =
    'https://raw.githubusercontent.com/Azure-Samples/cognitive-services-sample-data-files/master/ComputerVision/Images/faces.jpg';


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
    'returnFaceId' => 'true');
$url->setQueryVariables($parameters);
echo $url;
$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body parameters
$body = json_encode(array('url' => $imageUrl));

// Request body
$request->setBody($body);


?>