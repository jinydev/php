---
layout: php
title: "상수"
keyword: "const, php"
description: "php 상수에 대해서 학습합니다. 삼수는 고정된 값입니다."
---

# 예약된 상수 목록
---
모든 언어들이 그러하듯이 사전에 많은 상수를 포함하고 있습니다. 상수를 선언하여 사용할 때 실수로 상수명이 중복되어 프로그램의 오작동을 발생할 수도 있습니다.

상수를 선언하기 전에는 PHP에서 미리 사용된 상수명인지 확인하고 중복되지 않게 쓰는 것이 중요합니다. 또는 앞에 개인적인 접두어를 붙여서 사용하는 것도 또 다른 방법일 수 있습니다.

PHP언어에서는 기존에 미리 선언된 상수의 목록을 확인할 수 있는 내부 함수를 제공하고 있습니다. 

|관련함수|
```php
array get_defined_constants ([ bool $categorize = false ] )
```

위 함수의 반환값 형태는 배열인 것을 확인할 수 있습니다. get_define_constants() 함수는 PHP 내부 상수와 사용자가 개별적으로 선언한 모든 상수의 목록을 배열 형태로 반환받을 수 있습니다.

예제 파일 get_defined_constants.php
```php
<?php
	// 상수를 정의합니다.
	define("MY_CONSTANT", 1);
	// 정의된 모든 상수들을 출력합니다.
	// 카테고리도 같이 출력합니다.
	print_r( get_defined_constants(true) );
?> 
```

위의 예제는 get_defined_constants() 함수로 PHP의 내부 상수와 사용자 정의 상수의 목록을 출력하는 것입니다. 출력 결과는 내용이 많아서 지면상 생략하도록 하겠습니다.

<br>

## 미리 정의된 상수
---
PHP는 개발자가 선언하지 않아도 이미 미리 정의된 상수들이 있습니다. 
대부분의 프로그램 언어 또한 사전에 내장된 상수들은 다수 존재합니다.

* __FILE__
파일의 전체 경로와 파일명, 절대 경로를 표시합니다.

* __LINE__
파일의 현재 줄을 표시합니다.

* __DIR__
현재 디렉터리 경로를 출력합니다.(PHP 5.3에 추가)

* __FUNCTION__
함수명을 표시합니다. (PHP 5에 추가)

* __CLASS__
클래스명을 표시합니다. (PHP 5에 추가)

* __METHOD__
클래스 메서드명을 표시합니다. (PHP 5에 추가)

* __NAMESPACE__
이 상수는 컴파일 시에 정의됩니다. (PHP 5.3에 추가)

* PHP_VERSION
서버에 설치된 PHP 버전을 표시합니다.

* PHP_OS
PHP가 실행 중인 OS의 이름을 표시합니다.

* TRUE
TRUE (참), 1을 의미합니다.

* FALSE
FALSE (거짓), 빈 값을 의미합니다.

* E_ERROR
문법 오류가 아닌 복구가 불가능한 에러를 표시합니다.

* E_WARNING
PHP가 스크립트 실행에는 문제없으나 오류가 있음을 표시합니다.

* E_PARSE
스크립트에서 문법적으로 잘못된 명령을 만난 경우 표시합니다.

* E_NOTICE
에러는 아니지만 알릴 사항이 있음을 표시합니다.

예제 파일 const-03.php
```php
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

결과
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