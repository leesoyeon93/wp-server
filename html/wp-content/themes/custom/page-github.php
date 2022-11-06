<?php 
/*
Template Name: page landing
*/

// https://www.youtube.com/watch?v=IOjy6r0EE5s
$github_client_id = "192f2bd885c08a5102e1";
$github_client_secret = "99af620635f7a97498bc6f7411470c4f382e3c21";
$url = "https://github.com/login/oauth/access_token";
$access_token = "access_token=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&scope=&token_type=bearer";

// token parsing
$access_token = (explode("=", $access_token)[1]);
$access_token = explode("&", $access_token)[0];


if($_GET['code']) {
    var_dump('code',$_GET['code']);
}

// function init(){ 
// if (isset($_GET['code'])) {
//     $code = $_GET['code'];
//     $data = array(
//         'client_id' => $github_client_id,
//         'client_secret' => $github_client_secret,
//         'code' => $code
//     );
//     $options = array(
//         'http' => array(
//             'header' => "Content-type: application/json",
//             'method' => 'POST',
//             'content' => json_encode($data)
//         )
//     );
//     $context = stream_context_create($options);
//     $result = file_get_contents($url, true, $context);
//     $result = json_decode($result);
//     // var_dump( $result);
//     exit; 
        
//   }
// }
// init();


// // get githgub user data
// function get_user_data($access_token){
//     $url = "https://api.github.com/user";
//     $options = array(
//         'http' => array(
//             'header' => "Authorization: token " . $access_token,
//             'method' => 'GET'
//         )
//     );
//     $context = stream_context_create($options);
//     $result = file_get_contents($url, true, $context);
//     $result = json_decode($result);
//     var_dump($result);
// }

// get_user_data($access_token);

// lambda function


// ajax

