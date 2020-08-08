---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

10. 아파치함수
====================

PHP는 웹서버와 연동하여 웹서비스를 제공합니다. 대표적인 웹서버로는 아파치 웹서버가 있습니다.

PHP에서는 아파치 웹서버의 정보를 읽어서 처리할 수 있는 몇가지 함수들을 제공합니다.

|내부함수|
string apache_get_version ( void )

내부함수 apache_get_version()는 아파치 버전을 확인합니다.

예제) apache_get_version.php
<?php
	$version = apache_get_version();
	echo "$version";
?>

출력결과)
Apache/2.2.29 (Unix) mod_ssl/2.2.29 OpenSSL/1.0.1e-fips DAV/2 PHP/5.3.29


|내부함수|
array apache_get_modules ( void )

내부함수 apache_get_modules()는 적재된 아파치 모듈 목록을 얻습니다

예제) apache_get_modules.php
<?php
    print_r(apache_get_modules());
?>

출력결과)
Array ( [0] => core [1] => prefork [2] => http_core [3] => mod_so [4] => mod_authn_file [5] => mod_authn_dbm [6] => mod_authn_anon [7] => mod_authn_dbd [8] => mod_authn_default [9] => mod_authz_host [10] => mod_authz_groupfile [11] => mod_authz_user [12] => mod_authz_dbm [13] => mod_authz_owner [14] => mod_authz_default [15] => mod_auth_basic [16] => mod_auth_digest [17] => mod_dbd [18] => mod_dumpio [19] => mod_reqtimeout [20] => mod_ext_filter [21] => mod_include [22] => mod_filter [23] => mod_substitute [24] => mod_deflate [25] => mod_log_config [26] => mod_logio [27] => mod_env [28] => mod_expires [29] => mod_headers [30] => mod_ident [31] => mod_setenvif [32] => mod_version [33] => mod_ssl [34] => mod_mime [35] => mod_dav [36] => mod_status [37] => mod_autoindex [38] => mod_asis [39] => mod_info [40] => mod_cgi [41] => mod_dav_fs [42] => mod_vhost_alias [43] => mod_negotiation [44] => mod_dir [45] => mod_imagemap [46] => mod_actions [47] => mod_speling [48] => mod_userdir [49] => mod_alias [50] => mod_rewrite [51] => mod_php5 [52] => mod_ruid2 ) 


|내부함수|
string apache_getenv ( string $variable [, bool $walk_to_top ] )

내부함수 apache_getenv()는 아파치 서브프로세스의 환경 변수를 가져옵니다. 아파치 2 버전 이상에서만 지원합니다.

예제) apache_getenv.php
<?php
    // 아파치 환경 변수 SERVER_ADDR을 가져오는 방볍.
    $ret = apache_getenv("SERVER_ADDR");
    echo $ret;
?>

출력결과)
211.110.1.195


|내부함수|
bool apache_setenv ( string $variable , string $value [, bool $walk_to_top = false ] )

내부함수 apache_setenv()는 아파치의 서브프로세스의 환경 변수를 설정합니다. 하지만 아파치 환경 변수를 설정할 때, 해당하는 $_SERVER 변수는 바뀌지 않습니다.

예제) apache_setenv.php
<?php
    apache_setenv("EXAMPLE_VAR", "Example Value");

    $ret = apache_getenv("EXAMPLE_VAR");
    echo $ret;
?>

출력결과)
Example Value

|내부함수|
object apache_lookup_uri ( string $filename )

내부함수 apache_lookup_uri()는 지정한 URI에 부분 요청을 수행하고 그에 대한 정보를 반환 합니다.

예제) apache_lookup_uri.php
<?php
    $info = apache_lookup_uri('apache_getenv.php');
    print_r($info);

    if (file_exists($info->filename)) {
        echo 'file exists!';
    }
?>

출력결과)
stdClass Object ( [status] => 200 [the_request] => GET /jinysrc/apache_lookup_uri.php HTTP/1.1 [method] => GET [mtime] => 0 [clength] => 0 [chunked] => 0 [content_type] => application/x-httpd-php [no_cache] => 0 [no_local_copy] => 1 [unparsed_uri] => /jinysrc/apache_getenv.php [uri] => /jinysrc/apache_getenv.php [filename] => /home/www/jinysrc/apache_getenv.php [allowed] => 0 [sent_bodyct] => 0 [bytes_sent] => 0 [request_time] => 1502701432 )
file exists!


|내부함수|
string apache_note ( string $note_name [, string $note_value ] )

내부함수 apache_note()는 아파치 모듈간의 통신입니다. 아파치의 요청 노트를 얻거나 설정한다


|내부함수|
array apache_request_headers ( void )

내부함수 apache_request_headers()는 모든 HTTP 요청 헤더를 가져옵니다. 

예제) apache_request_headers.php
<?php
    $headers = apache_request_headers();

    foreach ($headers as $header => $value) {
        echo "$header: $value <br />\n";
    }
?>

출력결과)
Accept: text/html, application/xhtml+xml, image/jxr, */*
Accept-Language: ko
User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko
Accept-Encoding: gzip, deflate
Host: shop.jinyweb.com
Connection: Keep-Alive
Cookie: PHPSESSID=t48nid9kddv90e0cfps68oc663 

|내부함수|
array apache_response_headers ( void )

내부함수 apache_response_headers()는 모든 HTTP 응답 헤더를 가져옵니다

예제) apache_response_headers.php
<?php
    print_r(apache_response_headers());
?>

출력결과)
Array ( [X-Powered-By] => PHP/5.3.29 ) 

|내부함수|
bool virtual ( string $filename )

내부함수 virtual()는 아파치 하위 요청을 처리합니다. 하위 요청을 실행할 때, 헤더를 포함한 모든 버퍼를 종료하고 브라우저에 출력합니다.

virtual()은 mod_include의 <!--#include virtual...-->과 동일한 처리를 하는 아파치 함수입니다. 아파치 모듈로 설치하였을 때만 지원합니다.

예제) virtual.php
<?PHP
    $file = '../images/logo.jpg';
    $file_info = apache_lookup_uri($file);
    header('content-type: ' . $file_info -> content_type);
    virtual($file);
    die();
?>


|내부함수|
bool apache_reset_timeout ( void )

내부함수 apache_reset_timeout()는 아파치의 기본 동작 타이머는 300초 입니다. 이 타이머 값을 초기화 합니다. 

set_time_limit(0); ignore_user_abort(true)와 같은 함수 또는 주기적으로 apache_reset_timeout() 호출하면, 이론적으로 아파치를 무한 실행할 수 있습니다.

|내부함수|
bool apache_child_terminate ( void )

내부함수 apache_child_terminate()는 아파치 프로세스를 종료합니다. 보통 PHP 스크립트는 실행이 끝날을때  자동으로 프로세스를 종료하기 위해서 아파치 프로세스 목록에 등록을 합니다.

스크립트에서 사용한 메모리는 내부적으로 재사용할 수 있도록 해제되지만, 한번 사용된 메모리는 운영체제로는 반환을 하지 않습니다. 메모리를 많이 사용한 스크립트의 경우 본함수를 통하여 스크립트를 종료할 수 있습니다.

<br><br>
