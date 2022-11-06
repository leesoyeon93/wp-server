<?php 
/*
Template Name: page google
*/

// https://velog.io/@young224/Google-OAuth-%EA%B8%B0%EB%8A%A5-%EA%B5%AC%ED%98%84
// https://nicgoon.tistory.com/208

// 주요 값들.
$client_id = "87247861232-tb2lq6qtoh7lhp5c40a0ljfhmpda3m3a.apps.googleusercontent.com";
$client_secret = "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";
$redirect_url = "http://localhost:8000/page-google";
$scope = "https://www.googleapis.com/auth/gmail.readonly";


// 주요 url 
/**
 * https://accounts.google.com/o/oauth2/v2/auth 
 * https://www.googleapis.com/auth/gmail
 *  /oauth2/v4/token
 */
echo "받은 code & scope <br>";

print_r($_GET);
echo "<br>---------------------------<br><br>";


// 보낼 쿼리 만들기.
$sendQuery = ""
. "code=" . $_GET['code']
. "&client_id=" . $client_id
. "&client_secret=" . $client_secret
. "&redirect_uri=" . urlencode( $redirect_url )
. "&grant_type=authorization_code"
;


// 보낼 데이터를 만들어 주기 위한 기본값을 설정합니다.
$endline = "\r\n";
$req = "";


// 구글에서 요청한 필수 헤더를 추가합니다.
$req = "POST /oauth2/v4/token HTTP/1.0" . $endline
. "Host: www.googleapis.com" . $endline
. "Content-Type: application/x-www-form-urlencoded" . $endline
;


// POST 데이터를 보내기 위한 기본 헤더를 추가힙니다.
$req .= "Content-Length: " . strlen($sendQuery) . $endline
. "Connection: Close" . $endline
;

// 헤더의 끝을 표시하는 빈 문자열을 설정합니다.
$req .= $endline;

// 내용을 추가해 보내어 줍니다.
$req .= $sendQuery;
;

// 해당 구글 서버와 연결을 시도합니다.
$fsock = @fsockopen( "ssl://www.googleapis.com", 443 );

// 구글 서버에 접속 실패한 경우.
if( !$fsock )
{
    echo "구글 서버에 접속 실패하였습니다.!";
    exit;
}

// 데이터 보내기를 합니다.
fwrite( $fsock, $req );


// 데이터 받기를 위해 필요한 값들을 선언합니다.
$headPassed = false;
$TokenJson = "";


// 데이터 받기가 완료될 때 까지 대기하면 데이터를 받아 출력합니다.
while( !feof($fsock) )
{

    // 한 줄 라인을 가지고 옵니다.
    $line = fgets($fsock, 128);

    // 아직 헤더는 아니지만, 헤더의 끝을 만난 경우, 헤더가 끝났음을 마킹하고, 종료합니다.
    if( $line == "\r\n" && !$headPassed )
    {
        $headPassed = true;
        continue;
    }

    // 헤더가 아닌 경우만, 값을 출력하도록 합니다.
    if( $headPassed )
    {
        $TokenJson .= $line;
    }

}

// 연결을 닫아 주도록 합니다.
fclose( $fsock );

// 받아 온 Token Json을 토큰 객체로 만들어 줍니다.
$TokenObj = json_decode( $TokenJson );

// 받아 온 토큰을 출랙해 줍니다.
echo "받은 토큰은 아래와 같습니다.<br>";
print_r( $TokenObj );
echo "<br>---------------------------<br><br>";





// [-- 아래는 유저 프로필 가지고 오기 관련 --]


// 보낼 문장을 반들어 줍니다.
$userinfor_req = "GET /gmail/v1/users/me/profile HTTP/1.1" . $endline
. "Authorization: Bearer " . $TokenObj->access_token . $endline
. "Host: www.googleapis.com" . $endline
. "Connection: Close" . $endline

. $endline


;


// 해당 구글 서버와 연결을 시도합니다.
$fsock = @fsockopen( "ssl://www.googleapis.com", 443 );

// 구글 서버에 접속 실패한 경우.
if( !$fsock )
{
    echo "구글 서버에 접속 실패하였습니다.!";
    exit;
}

// 데이터 보내기를 합니다.
fwrite( $fsock, $userinfor_req );



// 데이터 받기를 위해 필요한 값들을 선언합니다.
$headPassed = false;
$profileJson = "";


while( !feof($fsock) )
{

    // 한 줄 라인을 가지고 옵니다.
    $line = fgets($fsock, 128);

    // 아직 헤더는 아니지만, 헤더의 끝을 만난 경우, 헤더가 끝났음을 마킹하고, 종료합니다.
    if( $line == "\r\n" && !$headPassed )
    {
        $headPassed = true;
        continue;
    }

    // 헤더가 아닌 경우만, 값을 출력하도록 합니다.
    if( $headPassed )
    {
        $profileJson .= $line;
    }

}


// 연결을 닫아 주도록 합니다.
fclose( $fsock );



// 가지고 온 유저 데이터를 출력하도록 합니다.
echo "확인한 유저 정보는 아래와 같습니다.<br>";
echo $profileJson;
