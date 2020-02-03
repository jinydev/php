---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

## 12.6 슈퍼변수: $_SERVER

$_SERVER 슈퍼변수는 서버 정보를 저장합니다. 브라우저를통하여 PHP 스크립트를 실행할 때 서버의 정보를 PHP에서확인할 수 있도록 제공하는 배열변수입니다.
PHP는 웹 개발 용도로 많이 사용을 합니다. 또한웹 서버와 언어에 최적화된 환경을 제공하는 의미도 있습니다. 따라서 이러한 $_SERVER 같은 슈퍼변수들을 제공하고 있습니다.
다음은$_SERVER 에서 사용되는 배열 값들에 대한 상세한 설명입니다:

 

$_SERVER['PHP_SELF']

PHP_SELF는 현재 실행하고 있는 PHP 스크립트파일명을 출력합니다. 이는 HTML폼 ACTION 스크립트 경로를 입력할 때 유용하게 사용을 합니다.

예제 파일 server-01.php
```
``` 

**출력 화면**

 
$_SERVER['GATEWAY_INTERFACE']

사용 중인 CGI(Common Gateway Interface)의 버전을 반환합니다.

​             
$_SERVER['SERVER_ADDR']

호스트 서버의 IP주소를 알 수 있습니다.

​             
$_SERVER['SERVER_NAME']

호스트 서버의 이름(도메인)을 알 수 있습니다.

$_SERVER['SERVER_SOFTWARE']

서버의 소프트웨어 환경. 서버 식별 문자열 (예:Apache / 2.2.24)을 반환합니다.

$_SERVER['SERVER_PROTOCOL']

프로토콜의 이름, 버전, 정보를 반환합니다(예: HTTP/ 1.1).

예제 파일 server-02.php
```
``` 

**출력 화면**

 

​             

$_SERVER['REQUEST_METHOD']

페이지 접속 방식을 POST/GET 을 반환합니다.

​             

$_SERVER['REQUEST_TIME']

접속 타임 스탬프를 반환합니다

 

$_SERVER['REQUEST_URI']

현재 페이지 주소에서 도메인을 제외한 값을반환합니다.

 

$_SERVER['HTTP_USER_AGENT']

사이트에 접속한 클라이언트 프로그램 정보를반환합니다.

 

$_SERVER['APPLPHYSICAL_PATH']

현재 페이지의 실제적인 주소를 반환합니다.

**예제파일 **server-03.php

 

**출력 화면**

 

​             

$_SERVER['QUERY_STRING']

쿼리 문자열을 통해 페이지에 액세스한 경우 쿼리 문자열을반환합니다.

 

예제 파일 server-04.php

 

**출력 화면**

스크립트 다음에 쿼리를 같이 입력합니다. server-05.php?a=1&b=2

 

​             

$_SERVER['HTTP_ACCEPT']

현재 요청에 대한 헤더를 반환합니다.

​             

$_SERVER['HTTP_ACCEPT_CHARSET']

현재 요청(예: utf-8, ISO-8859-1)에서 Accept_Charset 헤더를반환합니다.

 

$_SERVER['HTTP_ACCEPT_ENCODING']

인코딩 방식 예)gzip,deflate

 

$_SERVER['HTTP_ACCEPT_LANGAGE']

언어 예)ko

​             

$_SERVER['HTTP_HOST']

현재 요청에서Host 헤더를 반환합니다.

​             

$_SERVER['HTTP_REFERER']

현재 페이지로 오기 전의 페이지 URL을 반환합니다. <a>, <form> 태그등으로 넘어올 때 표시됩니다.

 

$_SERVER['SERVER_ADMIN']

웹 서버 설정 파일에서 SERVER_ADMIN 지시어에 주어진 값을 반환합니다. (스크립트가가상 호스트에서 실행되는 경우 가상 호스트에 대해 정의된 값이 됩니다.)

​             

$_SERVER['SERVER_PORT']

서버 포트를 확인합니다. 

​             

$_SERVER['SERVER_SIGNATURE']

서버 생성 페이지에 추가되는 서버 버전 및 가상 호스트이름을 반환합니다.

**예제 파일 **server-05.php

 

**출력 화면**

 

​             

$_SERVER['HTTPS']

https 프로토콜 여부를 확인합니다. 

 

예제 파일 server-06.php

 

$_SERVER['REMOTE_ADDR']

사용자 클라이언트가 접속한 IP 주소를반환합니다. 예) 192.168.0.3

​             

$_SERVER['REMOTE_HOST']

사용자 클라이언트가 접속한 호스트명를 반환합니다.

​             

$_SERVER['REMOTE_PORT']

사용자 클라이언트가 접속한 포트를 반환합니다.

**예제 파일 **server-07.php

 

​             

$_SERVER['PATH_TRANSLATED']

현재 스크립트에 대한 파일 시스템 기반 경로를 반환합니다.

 

$_SERVER['SCRIPT_FILENAME']

현재 실행중인 스크립트의 절대 경로 이름을 반환합니다.

 

$_SERVER['SCRIPT_NAME']

현재 스크립트의 경로를 반환합니다.

​             

$_SERVER['SCRIPT_URI']

현재 페이지의 URI를 반환합니다. 

 

예제 파일 server-08.php
```
``` 

**출력 화면**

이 책에서 설명하지 못하는 기능들과 슈퍼변수들은 공식사이트php.net의 정보를 확인하기를 바랍니다.