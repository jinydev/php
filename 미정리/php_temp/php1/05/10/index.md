---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

# 5.10 미리 정의된 상수
---
> `넘버 PHP 1권` 보충정리 내용입니다. 원문은 도서를 참고해 주시길 바랍니다.

PHP는 개발자가 선언하지 않아도 이미 미리 정의된 상수들이 있습니다. 대부분의 프로그램 언어 또한 사전에 내장된 상수들은 다수 존재합니다.
<br>

## __FILE__
---
파일의 전체 경로와 파일명, 절대 경로를 표시합니다.

## __LINE__
---
파일의 현재 줄을 표시합니다.

## __DIR__
---
현재 디렉터리 경로를 출력합니다.(PHP 5.3에 추가)

## __FUNCTION__
---
함수명을 표시합니다. (PHP 5에 추가)

## __CLASS__
---
클래스명을 표시합니다. (PHP 5에 추가)

## __METHOD__
---
클래스 메서드명을 표시합니다. (PHP 5에 추가)

## __NAMESPACE__
---
이 상수는 컴파일 시에 정의됩니다. (PHP 5.3에 추가)

## PHP_VERSION
---
서버에 설치된 PHP 버전을 표시합니다.

## PHP_OS
---
PHP가 실행 중인 OS의 이름을 표시합니다.

## TRUE
---
TRUE (참), 1을 의미합니다.

## FALSE
---
FALSE (거짓), 빈 값을 의미합니다.

## E_ERROR
---
문법 오류가 아닌 복구가 불가능한 에러를 표시합니다.

## E_WARNING
---
PHP가 스크립트 실행에는 문제없으나오류가 있음을 표시합니다.

## E_PARSE
---
스크립트에서 문법적으로 잘못된 명령을 만난 경우 표시합니다.

## E_NOTICE
---
에러는 아니지만 알릴 사항이 있음을 표시합니다.

예제 파일 const-03.php
```
<?php 
	// 파일의 전체 경로와 파일명, 절대 경로를 표시합니다.
	echo __FILE__ . "<br/>\n";

	// 상수를 정의한 위치가 5 라인입니다. 
	echo __LINE__ . "<br/>\n";

	// 서버에 설치된 PHP버전을 표시합니다.
	echo PHP_VERSION . "<br/>\n";

	// PHP가 실행 중인 OS의 이름을 표시합니다.
	echo PHP_OS . "<br/>\n";

	echo TRUE . "<br/>\n";

	echo FALSE . "<br/>\n";  

	// 함수명 상수 정의 
	function functionname(){ 
    		echo __FUNCTION__."<br>"; 
	} 
	
	functionname();

	// 클래스명 상수 정의 
	class classtest
	{ 
    		var $test = __CLASS__; 
    		function test()
    		{ 
           			echo $this->test; 
    		} 
	} 

	$test = new classtest; 
	echo $test->test."<br>";

	// 메서드명 상수 정의 
	class classtest2
	{ 
    		var $test = __METHOD__; 
    		function test()
    		{ 
          			echo $this->test; 
    		} 
	} 

	$test2 = new classtest2; 
	echo $test2->test."<br>";
	

 ?>
```

결과)
```
C:\php-7.1.4-Win32-VC14-x86\jinyphp\const-03.php

6
7.1.4
WINNT
1 

functionname

classtest
classtest2
```

위의 예제는 다양한 내부 상수들을 확인하고 출력하는 예제입니다. 

<br><br> 