<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'common.php';

$personGroupId = "trial_1";
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId);
$url = $request->getUrl();

$request->setHeader($headers);



// $url->setQueryVariables($parameters);
echo $url;
$request->setMethod(HTTP_Request2::METHOD_PUT);

// Request body
$body= json_encode(array(
    "name" => "group1",
    "userData" => "user-provided data attached to the person group.",
    "recognitionModel" => "recognition_04"
    ));
$request->setBody($body);

try
{
    $response = $request->send();
    echo $response->getBody();
    echo "created";
}
catch (HttpException $ex)
{
    echo $ex;
}

?>