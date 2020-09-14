---
layout: php
breadcrumb:
- "basic"
- "variable"
- "name"
---

# 변수명을 만드는 규칙
---
PHP는 간단하게 i나 x, y처럼 1개의 철자로 만들 수도 있고 age, sex, company 등 우리가 쉽게 알 수 있는 문자열로 만들어서 사용할 수 있습니다.  

<br>

## `$` 기호
---
php는 변수명 앞에 반드시 `$`기호를 붙여야 합니다.

```php
<?php
$hello = "안녕하세요.";
```

> C언어와 같은 변수의 타입이 사전 정의된 언어들은 변수명 앞에 타입을 지정합니다. 하지만, php는 동적 변수로 타입을 지정하지 않고 `$`기호만 변수명 앞에 지정하여 사용할 수 있습니다.

<br>

## 숫자로 시작하는 변수명
---
대부분의 언어들은 변수를 선언할때 첫글자로 숫자를 허용하지 않습니다. PHP 언어 또한 변수명을 지정할때 `숫자로 시작할 수 없습니다`.

```php
<?php
$123="안녕하세요";
echo $123;
```

|실행결과|
```
$ php varname_num.php 
PHP Parse error:  syntax error, unexpected '123' (T_LNUMBER), expecting variable (T_VARIABLE) or '{' or '$' in D:\php\basic\variable\name\sample\var_num.php on line 2
```

<br>

## `_` 기호
---
php는 변수를 작명할때 알파벳 글자로 시작되어야 합니다.  
하지만, 예외로 특수기호인 `_`를 변수명의 시작 기호로 허용을 합니다.

```php
<?php
	$_world = "php 세상";
	echo $_world;
```

|실행결과|
```
$ php varname_under.php 
php 세상
```

`_`기호는 변수명 중간에 조합하여 사요할 수 있습니다.
만일 `$hello world`와 같은 변수명을 작성한다고 생각해 봅시다.  

```php
<?php
$hello world = "안녕하세요";
echo $hello world;
```

php는 변수명 선언시 공백(스페이스)을 허용하지 않습니다. 위의 코드를 실행하면 오류가 발생합니다.
1개의 단어가 아닌, 여러 단어를 결합하여 변수명을 사용할려고 한다면 어떻게 해야 할까요?  

이런경우 `_`기호를 같이 사용합니다.

```php
<?php
$hello_world = "안녕하세요";
echo $hello_world;
```

이처럼 `_`로 연결된 단어의 표현을 스네이크 케이스라고 합니다. 마치 `_`로 뱀이 연결된 모습과 비슷하다고 해서 붙여진 닉네임입니다.  

<br>

## 대소문자 구별
---
PHP는 변수명을 작성할 때 `대소문자`를 구분합니다.  

예를 들어 `$age`와 `$AGE`는 다른 값의 변수명입니다.
실습을 통하여 변수의 대소문자 구별을 알아 보도록 합니다.

예제 파일 var-01.php
```php
<?php
	// PHP는 변수의 대소문자를 구분합니다.
	$age = "18";
	$AGE = "20";

	echo "소문자 = ".$age."<br>";
	echo "대문자 = ".$AGE."<br>";
?>
```

결과
```
소문자 = 18
대문자 = 20
```

위의 예제에서 보듯이 PHP의 변수는 대소문자를 구분합니다.  
소문자 `$age` 와 대문자 `$AGE`는 서로 다른 값이 있습니다.  
출력 또한 서로 `다른 값`을 출력합니다.

<br>

## 한글이름
---
php 소스코드는 utf-8 엔코딩을 지원합니다.  
권장하지는 않지만, utf-8의 특징을 이용하여 다음과 같이 `한글` 이름으로 변수를 작성할 수도 있습니다.  

```php
<?php
$안녕 = "hello world";
echo $안녕;
```

실행결과
```
$ php varname_kor.php 
hello world
```

