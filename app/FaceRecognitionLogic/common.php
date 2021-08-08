<?php
require_once 'HTTP/Request2.php';
$ocpApimSubscriptionKey = "0129c4b0a3244f028718aeca19f83c33";
$uriBase ='https://fita.cognitiveservices.azure.com//face/v1.0/';
$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
);

?>