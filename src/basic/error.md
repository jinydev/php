---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "error"
---

# 오류처리 함수

PHP는 오류에 대한 처리를 할 수 있는 몇가지 함수들을 제공합니다.

## 오류
PHP는 다양한 오류의 정의와 메시지 코드를 지원합니다. 내부함수 error_reporting()는 PHP 에러를 정의합니다.

|내부함수|
```php
int error_reporting ([ int $level ] )
```

PHP에서 사용되는 대표적인 에러코드와 기호는 다음과 같습니다.

	1:	E_ERROR	에러를 출력하고 스크립트의 실행을 중단합니다.. 메모리 할당 에러등의 복구가 힘든 문제의 에러를 의미합니다.
	2:	E_WARNING	경고를 출력하지만 스크립트는 정상적으로 실행됩니다.
	4:	E_PARSE
	8:	E_NOTE	뭔가 에러를 감지를 하였으나 출력은 하지 않습니다. 
	16:	E_CODE_ERROR	PHP 코어에 의하여 생성된 에러 메시지 입니다.
	32:	E_CODE_WARNING	PHP 코어에 의하여 생성된 에러 메시지 입니다.

예제) error_report.php
```php
<?php

	// Turn off all error reporting
	error_reporting(0);

	// Report simple running errors
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	// Reporting E_NOTICE can be good too (to report uninitialized
	// variables or catch variable name misspellings ...)
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	// Report all errors except E_NOTICE
	error_reporting(E_ALL & ~E_NOTICE);

	// Report all PHP errors (see changelog)
	error_reporting(E_ALL);

	// Report all PHP errors
	error_reporting(-1);

	// Same as error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

?>
```

## 오류출력
PHP에서 발생한 오류에 대한 정보를 가지고 오고 로그를 출력할 수 있습니다. 

|내부함수|
```php
bool error_log ( string $message [, int $message_type = 0 [, string $destination [, string $extra_headers ]]] )
```

내부함수 error_log()는 메시지를 오류처리 루틴으로 전달합니다. 지정한 타입에 따라서 메시지를 출력할 곳을 지정할 수 있습니다.

	타입0:	php.ini 에 지정된 시스템에 에러를 출력합니다.
	타입1:	지정한 이메일로 에러메시지를 출력합니다.
	타입2:	호스트,IP주소의 PHP 디버깅으로 출력합니다. 디버깅 출력은 remote debugging 설정이 되어 있어야 합니다.
	타입3:	지정한 파일로 출력합니다.	

예제) error_log.php
```php
<?php
	// 지정한 로그파일에 에러를 출력합니다.
	$errFile = "./my-errors.log";
	error_log("You messed up!", 3, $errFile);
?>
```

|내부함수|
```php
array error_get_last ( void )
```

내부함수 error_get_last()는 마지막으로 발생한 오류 가지고 옵니다.

예제) error_get_last.php
```php
<?php
	echo $a;
	print_r(error_get_last());
?>
```

|내부함수|
```php
void error_clear_last ( void )
```

내부함수 error_clear_last()는 가장 최근 오류를 지웁니다.

예제) error_clear_last.php
```
<?php
	var_dump(error_get_last());
	error_clear_last();
	var_dump(error_get_last());

	@$a = $b;

	var_dump(error_get_last());
	error_clear_last();
	var_dump(error_get_last());
?>
```

|내부함수|
```php
bool trigger_error ( string $error_msg [, int $error_type = E_USER_NOTICE ] )
```

내부함수 trigger_error()는 사용자 수준의 오류 / 경고 / 통지 메시지를 생성합니다.

예제) trigger_error.php
```php
<?php
    trigger_error("Cannot divide by zero", E_USER_ERROR);
?>
```

콘솔출력)
[Mon Aug 21 16:59:44 2017] ::1:57186 [500]: /trigger_error.php - Cannot divide by zero in C:\php-7.1.4-Win32-VC14-x86\trigger_error.php on line 3

## 역추적
PHP는 역추적에 관련된 몇 개의 내부함수들을 지원합니다.

|내부함수|
```php
array debug_backtrace ([ int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT [, int $limit = 0 ]] )
```

내부함수 debug_backtrace()는 역 추적을 실행합니다.

예제) debug_backtrace.php
```
<?php
	function test($str)
	{
    	echo "Hello World! $str<br>";
    	var_dump(debug_backtrace());
	}

	test('jiny');
?>
```

화면출력)
```text
Hello World! jiny
array(1) { [0]=> array(4) { ["file"]=> string(47) "C:\php-7.1.4-Win32-VC14-x86\debug_backtrace.php" ["line"]=> int(8) ["function"]=> string(4) "test" ["args"]=> array(1) { [0]=> string(4) "jiny" } } } 
```

|내부함수|
```php
void debug_print_backtrace ([ int $options = 0 [, int $limit = 0 ]] )
```

내부함수 debug_print_backtrace()는 역추적을 출력합니다.

예제) debug_print_backtrace.php
```php
<?php

	function a() {
    	b();
	}

	function b() {
    	c();
	}

	function c(){
    	debug_print_backtrace();
	}

	a();

?>
```

화면출력)
```text
#0 c() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:8] 
#1 b() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:4] 
#2 a() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:15] 
```

## 오류 핸들
PHP는 오류처리 핸들에 관련된 몇가지 함수들을 지원합니다.

|내부함수|
```php
mixed set_error_handler ( callable $error_handler [, int $error_types = E_ALL | E_STRICT ] )
```

내부함수 set_error_handler()는 사용자 정의 오류 처리기 함수를 설정합니다.

|내부함수|
```php
bool restore_error_handler ( void )
```

내부함수 restore_error_handler()는 이전 오류 처리 함수를 복원합니다.

|내부함수|
```php
callable set_exception_handler ( callable $exception_handler )
```

내부함수 set_exception_handler()는 사용자 정의 예외 처리 함수를 설정합니다.

|내부함수|
```php
bool restore_exception_handler ( void )
```
내부함수 restore_exception_handler()는 이전에 정의 된 예외 핸들러 함수를 복원합니다.

<br><br>