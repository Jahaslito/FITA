<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'common.php';
$personGroupId= "trial_1";
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId.'/train');
$url = $request->getUrl();

// $headers = array(
//     // Request headers
//     'Ocp-Apim-Subscription-Key' => '{subscription key}',
// );

$request->setHeader($headers);

// $parameters = array(
//     // Request parameters
// );

// $url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
// $request->setBody("{body}");

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