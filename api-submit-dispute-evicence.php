<?php

ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include_once 'bootstrap.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\MultipartStream;

$dispute_apiResource = $payPalRestAPIEndPoint . $payPalRestAPIDisputResource;
$provide_evidence_endpoint = "/" . $disputeAPIExerciseSamples["dispute-id"] . "/provide-evidence";
$base_uri = $dispute_apiResource . $provide_evidence_endpoint;


$headers = [
    'Authorization' => 'Bearer ' . $payPalRestAPIAppToken,
    'Content-Type' => 'multipart/related; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'    
];
$multiPartBody = new MultipartStream([
    [
    'name' => 'file1',
    'contents' => fopen('/Users/wdai1/Sites/This_is_my_dummy_evidence_file_.png', 'r')
    ]
    
]);


$httpRequest = new Request('post', $base_uri, $headers, $body);

$httpClient = new Client();

//$response = $httpClient->send($httpRequest);

/*
$response = $httpClient->request('post', $base_uri, [
    'headers' => [
        'Authorization' => 'Bearer ' . $payPalRestAPIAppToken,
        'Content-Type' => 'multipart/related; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
    ],
    'multipart' => [
        [
        'name' => 'input',
        'contents' => '{
            "evidence_type": "PROOF_OF_FULFILLMENT",
            "evidence_info": {
                "tracking_info": [
                    {
                        "carrier_name": "FEDEX",
                        "tracking_number": "122533485"
                    }
                ]
            },
            "notes": "test"
        }'
        ],
        [
            'name' => 'file',
            'contents' => fopen('/Users/wdai1/Sites/This_is_my_dummy_evidence_file_.png', 'r'),
            'filename' => 'This_is_my_dummy_evidence_file_.png'
        ] 
    ] 
]);
*/