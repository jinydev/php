---
layout: php
title: "오류 처리와 디버깅"
keyword: "php, error, 오류 처리, 디버깅"
description: "PHP 오류 처리 함수와 디버깅을 위해 코드 역추적(Backtrace)을 수행하는 주요 내장 기능들을 배웁니다."
breadcrumb:
- syntax
- error
---

# 오류처리 함수
---
프로그램을 작성하다 보면 소스 코드 오타, 존재하지 않는 함수 호출, 잘못된 연산 등으로 인해 다양한 **오류(Error)**가 발생하게 됩니다. PHP는 실행 중 발생하는 여러 단계의 오류를 포착하고 처리할 수 있는 에러 리포팅 시스템과 디버깅을 위한 역추적 함수들을 제공합니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/error_handler_cartoon.png" alt="Error Handling Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 프로그램 오류(바나나에 미끄러지는 로봇)를 안전하게 잡아주는 에러 핸들러(안전망)</p>
</div>

<br>

## 오류
PHP는 다양한 오류의 정의와 메시지 코드를 지원합니다. 내부함수 error_reporting()는 PHP 에러를 정의합니다.

|내부함수|
{% raw %}
```php
int error_reporting ([ int $level ] )
```
{% endraw %}

PHP에서 사용되는 대표적인 에러코드와 기호는 다음과 같습니다.

	1:	E_ERROR	에러를 출력하고 스크립트의 실행을 중단합니다.. 메모리 할당 에러등의 복구가 힘든 문제의 에러를 의미합니다.
	2:	E_WARNING	경고를 출력하지만 스크립트는 정상적으로 실행됩니다.
	4:	E_PARSE
	8:	E_NOTE	뭔가 에러를 감지를 하였으나 출력은 하지 않습니다. 
	16:	E_CODE_ERROR	PHP 코어에 의하여 생성된 에러 메시지 입니다.
	32:	E_CODE_WARNING	PHP 코어에 의하여 생성된 에러 메시지 입니다.

예제) error_report.php
{% raw %}
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
{% endraw %}

## 오류출력
PHP에서 발생한 오류에 대한 정보를 가지고 오고 로그를 출력할 수 있습니다. 

|내부함수|
{% raw %}
```php
bool error_log ( string $message [, int $message_type = 0 [, string $destination [, string $extra_headers ]]] )
```
{% endraw %}

내부함수 error_log()는 메시지를 오류처리 루틴으로 전달합니다. 지정한 타입에 따라서 메시지를 출력할 곳을 지정할 수 있습니다.

	타입0:	php.ini 에 지정된 시스템에 에러를 출력합니다.
	타입1:	지정한 이메일로 에러메시지를 출력합니다.
	타입2:	호스트,IP주소의 PHP 디버깅으로 출력합니다. 디버깅 출력은 remote debugging 설정이 되어 있어야 합니다.
	타입3:	지정한 파일로 출력합니다.	

예제) error_log.php
{% raw %}
```php
<?php
	// 지정한 로그파일에 에러를 출력합니다.
	$errFile = "./my-errors.log";
	error_log("You messed up!", 3, $errFile);
?>
```
{% endraw %}

|내부함수|
{% raw %}
```php
array error_get_last ( void )
```
{% endraw %}

내부함수 error_get_last()는 마지막으로 발생한 오류 가지고 옵니다.

예제) error_get_last.php
{% raw %}
```php
<?php
	echo $a;
	print_r(error_get_last());
?>
```
{% endraw %}

|내부함수|
{% raw %}
```php
void error_clear_last ( void )
```
{% endraw %}

내부함수 error_clear_last()는 가장 최근 오류를 지웁니다.

예제) error_clear_last.php
{% raw %}
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
{% endraw %}

|내부함수|
{% raw %}
```php
bool trigger_error ( string $error_msg [, int $error_type = E_USER_NOTICE ] )
```
{% endraw %}

내부함수 trigger_error()는 사용자 수준의 오류 / 경고 / 통지 메시지를 생성합니다.

예제) trigger_error.php
{% raw %}
```php
<?php
    trigger_error("Cannot divide by zero", E_USER_ERROR);
?>
```
{% endraw %}

콘솔출력)
[Mon Aug 21 16:59:44 2017] ::1:57186 [500]: /trigger_error.php - Cannot divide by zero in C:\php-7.1.4-Win32-VC14-x86\trigger_error.php on line 3

## 역추적
PHP는 역추적에 관련된 몇 개의 내부함수들을 지원합니다.

|내부함수|
{% raw %}
```php
array debug_backtrace ([ int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT [, int $limit = 0 ]] )
```
{% endraw %}

내부함수 debug_backtrace()는 역 추적을 실행합니다.

예제) debug_backtrace.php
{% raw %}
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
{% endraw %}

화면출력)
{% raw %}
```text
Hello World! jiny
array(1) { [0]=> array(4) { ["file"]=> string(47) "C:\php-7.1.4-Win32-VC14-x86\debug_backtrace.php" ["line"]=> int(8) ["function"]=> string(4) "test" ["args"]=> array(1) { [0]=> string(4) "jiny" } } } 
```
{% endraw %}

|내부함수|
{% raw %}
```php
void debug_print_backtrace ([ int $options = 0 [, int $limit = 0 ]] )
```
{% endraw %}

내부함수 debug_print_backtrace()는 역추적을 출력합니다.

예제) debug_print_backtrace.php
{% raw %}
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
{% endraw %}

화면출력)
{% raw %}
```text
#0 c() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:8] 
#1 b() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:4] 
#2 a() called at [C:\php-7.1.4-Win32-VC14-x86\debug_print_backtrace.php:15] 
```
{% endraw %}

## 오류 핸들
PHP는 오류처리 핸들에 관련된 몇가지 함수들을 지원합니다.

|내부함수|
{% raw %}
```php
mixed set_error_handler ( callable $error_handler [, int $error_types = E_ALL | E_STRICT ] )
```
{% endraw %}

내부함수 set_error_handler()는 사용자 정의 오류 처리기 함수를 설정합니다.

|내부함수|
{% raw %}
```php
bool restore_error_handler ( void )
```
{% endraw %}

내부함수 restore_error_handler()는 이전 오류 처리 함수를 복원합니다.

|내부함수|
{% raw %}
```php
callable set_exception_handler ( callable $exception_handler )
```
{% endraw %}

내부함수 set_exception_handler()는 사용자 정의 예외 처리 함수를 설정합니다.

|내부함수|
{% raw %}
```php
bool restore_exception_handler ( void )
```
{% endraw %}
내부함수 restore_exception_handler()는 이전에 정의 된 예외 핸들러 함수를 복원합니다.

<br><br>