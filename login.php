<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    if($username=="1000009172" && $password=="1234") {
        echo json_encode(array("message" => "ok")); 
    } else if($username=="1000002978" && $password=="1234") {
        echo json_encode(array("message" => "ok")); 
    } else if($username=="10000013945" && $password=="1234") {
        echo json_encode(array("message" => "ok")); 
    } else {
        echo json_encode(array("message" => "login error")); 
    }
} else {
    echo '{"message":"error method"}';
}