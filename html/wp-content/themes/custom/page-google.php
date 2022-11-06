<?php 
/*
Template Name: page google
*/
// https://velog.io/@young224/Google-OAuth-%EA%B8%B0%EB%8A%A5-%EA%B5%AC%ED%98%84
// https://nicgoon.tistory.com/208

$google_client_id = "87247861232-tb2lq6qtoh7lhp5c40a0ljfhmpda3m3a.apps.googleusercontent.com";
$google_client_secret = "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";
// $url = "https://www.googleapis.com/drive/v2/files?access_token=access_token";
$code = $_GET['code'];

var_dump($code);

if(isset($code)){
    $data = array(
        'client_id' => $google_client_id,
        'client_secret' => $google_client_secret,
        'redirect_uri' => 'http://localhost:8000/page-google',
        'grant_type' => 'authorization_code',
        'code' => $code
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/json",
            'method' => 'POST',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options); 
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    $access_token = $response->access_token;
    $url = 'https://www.googleapis.com/auth/userinfo?access_token=access_token='.$access_token;
    $user = json_decode(file_get_contents($url));
    // echo $user->name;
    // echo $user->email;
    // echo $user->id;
    // echo $user->picture;
    var_dump(  $user );
}

