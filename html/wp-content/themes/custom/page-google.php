<?php 
/*
Template Name: page google
*/

// https://velog.io/@young224/Google-OAuth-%EA%B8%B0%EB%8A%A5-%EA%B5%AC%ED%98%84
// https://nicgoon.tistory.com/208

// 주요 값들
$client_id = "87247861232-tb2lq6qtoh7lhp5c40a0ljfhmpda3m3a.apps.googleusercontent.com";
$client_secret = "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";
$redirect_url = "http://localhost:8000/page-google";
$scope = "https://www.googleapis.com/auth/gmail.readonly";


// 주요 url 
/**
 * https://accounts.google.com/o/oauth2/v2/auth 
 * https://www.googleapis.com/auth/gmail
 * https://www.daimto.com/how-to-get-a-google-access-token-with-curl/
 */
echo "받은 code & scope <br>";

print_r($_GET);
echo "<br>---------------------------<br><br>";

// access token 받기
if(isset($_GET['code'])){
  
  echo "<br>-----------token ----------------<br><br>";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.googleapis.com/oauth2/v4/token',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POSTFIELDS => http_build_query([
            'code' => $_GET['code'],
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_url,
            'grant_type' => 'authorization_code',
        ]),
    ));

    $response = curl_exec($curl);
    $access_token = json_decode($response)->access_token;
    $token_type = json_decode($response)->token_type;
    $expires_in = json_decode($response)->expires_in;
    $id_token = json_decode($response)->id_token;


    var_dump($response);

    echo "<br>---------------------------<br><br>";

    echo "<br>-----------user info----------------<br><br>";

    $header = array(
      'Content-Type: application/x-www-form-urlencoded',
      'Accept: application/json',
      'host: www.googleapis.com',
      'Authorization: Bearer '.$access_token
    );


      $method = "GET";

      $url = "https://www.googleapis.com/gmail/v1/users/me/profile";

      $ch = curl_init();                                 //curl 초기화
      curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함 
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);   //호스트 이름을 체크 안함
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);  //메소드 지정하기
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);     //헤더 지정하기
   
      $userInfo = curl_exec($ch);
      
      var_dump($userInfo);


}




