---
layout: php
title: "변수명 작성 규칙과 명명 규격"
description: "PHP에서 변수를 선언할 때 필수적으로 지켜야 하는 달러 기호($) 접두사, 숫자로 시작 금지, 대소문자 구분, 공백 처리(스네이크 케이스) 등의 핵심 명명 규칙을 다룹니다."
keyword: "php 변수명, 변수 작명 규칙, 스네이크 케이스, 대소문자 구분"
breadcrumb:
- syntax
- variable
- name
---

# 변수명을 만드는 규칙
---
PHP의 변수는 간단하게 `i`나 `x`, `y`처럼 1개의 철자로 만들 수도 있고, `age`, `name`, `company` 등 역할을 쉽게 인지할 수 있는 단어를 사용하여 선언할 수 있습니다. 

<div style="text-align: center; margin: 30px 0;">
  <img src="img/variable_name_structure.svg" alt="PHP Variable Name Structure Diagram" style="max-width: 90%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 올바른 PHP 변수명의 구성 요소와 규칙 설명</p>
</div>

<div style="text-align: center; margin: 30px 0;">
  <img src="img/variable_name_rules_cartoon.png" alt="Variable Naming Rules Cartoon" style="max-width: 55%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 캐릭터 로봇이 알려주는 올바른 변수명(Check)과 올바르지 않은 변수명(Cross)의 실례</p>
</div>

## `$` 기호
---
php는 변수명 앞에 반드시 `$`기호를 붙여야 합니다.

{% raw %}
```php
<?php
$hello = "안녕하세요.";
```
{% endraw %}

> C언어와 같은 변수의 타입이 사전 정의된 언어들은 변수명 앞에 타입을 지정합니다. 하지만, php는 동적 변수로 타입을 지정하지 않고 `$`기호만 변수명 앞에 지정하여 사용할 수 있습니다.

<br>

## 숫자로 시작하는 변수명
---
대부분의 언어들은 변수를 선언할때 첫글자로 숫자를 허용하지 않습니다. PHP 언어 또한 변수명을 지정할때 `숫자로 시작할 수 없습니다`.

{% raw %}
```php
<?php
$123="안녕하세요";
echo $123;
```
{% endraw %}

|실행결과|
{% raw %}
```
$ php varname_num.php 
PHP Parse error:  syntax error, unexpected '123' (T_LNUMBER), expecting variable (T_VARIABLE) or '{' or '$' in D:\php\basic\variable\name\sample\var_num.php on line 2
```
{% endraw %}

<br>

## `_` 기호
---
php는 변수를 작명할때 알파벳 글자로 시작되어야 합니다.  
하지만, 예외로 특수기호인 `_`를 변수명의 시작 기호로 허용을 합니다.

{% raw %}
```php
<?php
	$_world = "php 세상";
	echo $_world;
```
{% endraw %}

|실행결과|
{% raw %}
```
$ php varname_under.php 
php 세상
```
{% endraw %}

`_`기호는 변수명 중간에 조합하여 사요할 수 있습니다.
만일 `$hello world`와 같은 변수명을 작성한다고 생각해 봅시다.  

{% raw %}
```php
<?php
$hello world = "안녕하세요";
echo $hello world;
```
{% endraw %}

php는 변수명 선언시 공백(스페이스)을 허용하지 않습니다. 위의 코드를 실행하면 오류가 발생합니다.
1개의 단어가 아닌, 여러 단어를 결합하여 변수명을 사용할려고 한다면 어떻게 해야 할까요?  

이런경우 `_`기호를 같이 사용합니다.

{% raw %}
```php
<?php
$hello_world = "안녕하세요";
echo $hello_world;
```
{% endraw %}

이처럼 `_`로 연결된 단어의 표현을 스네이크 케이스라고 합니다. 마치 `_`로 뱀이 연결된 모습과 비슷하다고 해서 붙여진 닉네임입니다.  

<br>

## 대소문자 구별
---
PHP는 변수명을 작성할 때 `대소문자`를 구분합니다.  

예를 들어 `$age`와 `$AGE`는 다른 값의 변수명입니다.
실습을 통하여 변수의 대소문자 구별을 알아 보도록 합니다.

예제 파일 var-01.php
{% raw %}
```php
<?php
	// PHP는 변수의 대소문자를 구분합니다.
	$age = "18";
	$AGE = "20";

	echo "소문자 = ".$age."<br>";
	echo "대문자 = ".$AGE."<br>";
?>
```
{% endraw %}

결과
{% raw %}
```
소문자 = 18
대문자 = 20
```
{% endraw %}

위의 예제에서 보듯이 PHP의 변수는 대소문자를 구분합니다.  
소문자 `$age` 와 대문자 `$AGE`는 서로 다른 값이 있습니다.  
출력 또한 서로 `다른 값`을 출력합니다.

<br>

## 한글이름
---
php 소스코드는 utf-8 엔코딩을 지원합니다.  
권장하지는 않지만, utf-8의 특징을 이용하여 다음과 같이 `한글` 이름으로 변수를 작성할 수도 있습니다.  

{% raw %}
```php
<?php
$안녕 = "hello world";
echo $안녕;
```
{% endraw %}

실행결과
{% raw %}
```
$ php varname_kor.php 
hello world
```
{% endraw %}