<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'common.php';
$personGroupId= "trial_1";
$personId= "407081b9-21da-4133-a8c8-5356722db5e1";
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId.'/persons/'.$personId.'/persistedFaces');

$url = $request->getUrl();


$request->setHeader($headers);

$parameters = array(
    // Request parameters
    'userData' => 'Second Image of person_1',
    'detectionModel' => 'detection_03',
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);
$imageUrl= "https://65edf7d32230.ngrok.io/face recognition/amen.jpg";
$body = json_encode(array('url' => $imageUrl));
// Request body
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