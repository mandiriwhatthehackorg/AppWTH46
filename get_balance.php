<?php
header('Content-Type: application/json');

$url = "https://e6ebbdc0-7606-4b0a-9e04-2ea0c8b57b43:648ab102-241e-4b4d-a8a2-4ce180e2b505@apigateway.mandiriwhatthehack.com/rest/pub/apigateway/jwt/getJsonWebToken?app_id=7c72b451-c096-488d-903e-8689ab1e30b8";
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$response = get_by_curl($url, false, stream_context_create($arrContextOptions));

$jwt = get_jwt($response);

//var_dump($jwt);

$balance = get_balance($jwt);

echo($balance);


function get_balance($jwt){
    $url = "https://apigateway.mandiriwhatthehack.com/gateway/ServicingAPI/1.0/customer/1000009172";
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Accept: application/json",
        "Authorization: Bearer  	$jwt"
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $output = curl_exec($ch);
    
    curl_close($ch);     

    return $output;
}

function get_jwt($response) {
    $dom = new DOMDocument();
    $dom->loadHTML($response);

    $tds = $dom->getElementsByTagName('td');
    foreach ($tds as $td) {
        $jwt = $td->textContent;
    }

    return $jwt;
}

function get_by_curl($url) {
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $output = curl_exec($ch);
    
    curl_close($ch);     

    return $output;
}
