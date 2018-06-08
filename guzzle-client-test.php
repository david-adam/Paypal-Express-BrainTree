<?php

ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include_once 'bootstrap.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;



$dispute_apiResource = $payPalRestAPIEndPoint . $payPalRestAPIDisputResource;
$provide_evidence_endpoint = "/" . $disputeAPIExerciseSamples["dispute-id"] . "/provide-evidence";
$base_uri = "http://httpbin.org/post";

//$container = [];
//$history = Middleware::history($container);
$stack = HandlerStack::create();
$stack->push(Middleware::mapRequest(function (RequestInterface $request) {
    $contentsRequest = (string) $request->getBody();
    var_dump($contentsRequest);

    return $request;
}));
$httpClient = new Client(['handler' => $stack]);

$headers = [
    'Authorization' => 'Bearer ' . $payPalRestAPIAppToken,
    'Content-Type' => 'multipart/related; boundary=166318e50f049a8364b14a62f94b257295a1f163'    
];
$multiPartBody = new MultipartStream([
    [
    'name' => 'file1',
    'contents' => fopen('/Users/wdai1/Sites/This_is_my_dummy_evidence_file_.png', 'r')
    ]
    
]);

$httpRequest = new Request('post', $base_uri, $headers, $body);

$httpClient->send($httpRequest);

/*
echo count($container) . "\n";

foreach($container as $client_payload) {
    //var_dump ($client_payload['request']);
    $cliend_request = $client_payload['request'];
    echo $cliend_request->getBody()->read($cliend_request->getBody()->getSize());
}
*/