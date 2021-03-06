---
layout: php
title: "PHP 제어문 - 3항 연산자 (Ternary operator)"
breadcrumb:
- basic
- condition
- ternary
keyword: "php, grammer, web, 3항 연산자, Ternary operator"
description: "웹 어플리케이션 서버를 개발을 위한 php 언어의 기본 문법을 학습니다."
---

# 3항 연산자 (Ternary operator)
---
새롭게 등장하는 3항 연산자는 if조건문을 간략하게 약식 형태의 연산자 처럼 표현을 할 수 있는 방법입니다. 
3항 연산자는 물음표(?) 기호와 콜론(:) 기호로 구성됩니다.  

|문법|
```php
조건식 ? true의 처리 로직 : false의 처리 로직
```

위와 같이 조건식`?`공식1`:`공식2 형태로 표현한 것을 3항 연산자라고 합니다.  
3항 연산자는 두 개의 연산 기호를 사용합니다. 바로 ? 기호와 : 기호입니다.  

<br>

## 물음표(?)
---
물음표(?) 연산 기호 앞에 조건을 입력하거나 조건 값을 가지는 변수를 넣을 수 있습니다.  
물음표(?) 뒤에는 조건에 따른 처리 로직을 작성합니다. 기본적으로 다음에 있는 조건은 참(true)일 경우 실행됩니다.  

다음의 콜론(:) 기호는 else의 의미를 가집니다. 
기존 if의 경우 참/거짓의 로직을 else 키워드로 구분했으나 3항 연산자에서는 else 대신에 콜론(:) 기호를 작성합니다.  

콜론(:) 앞쪽에는 참(true) 처리 로직, 뒤쪽에는 거짓(false) 처리 로직을 작성합니다. 수식을 작성할 수도 있고 상수나 변수 값을 입력하여 값을 반환할 수 있습니다.  

3항 연산자는 복잡한 다수의 조건을 처리하는 것이 아니라 간단한 값의 대입이나 처리하는 데 주로 사용을 합니다.  

예제 파일 if-11.php
```php
<?php
	$lang = "ko";
	$title = ($lang == "ko") ? "한국어" : "korean";

	echo $title;
?>
```

결과
```
한국어
```

위의 예제는 $lang 변수의 값이 `ko`인 경우에는 참(true) 조거인 `한국어` 문자열을 출력합니다.  
그 이외의 경우에는 else의 의미인 콜론 기호 다음의 “Korean” 문자열을 출력합니다.  

<br>

## 참(true) 생략
---
3항 연산자에서 만일 참(true) 조건이 없는 경우에는 참 조건의 식은 생략 가능합니다.  
> 이 기능은 `PHP 5.3`부터 지원합니다.  

|문법|
```php
조건식 ?: false의 처리 로직
```

다음은 참 조건을 생략하는 예제입니다.  

예제 파일 if-12.php
```php
<?php
	
	$title = $lang?:"english";
	echo $title;

	echo "<br>";

	$lang = "Korean";
	$title = $lang?:"english";
	echo $title;

?>
```

결과
```
english
Korean
```

위의 예제에는 두 번의 3항 연산자를 사용했습니다. 처음의 3항 연산자의 경우 `$lang` 변수의 값이 미지정되어 미정의된 상태입니다.  
따라서 3항 연산자의 첫 번째 로직의 조건은 거짓(false)으로 false 조건인 `english` 문자열이 출력됩니다.  

두 번째 3항 연산자의 경우 먼저 $lang 변수에 값을 미리 지정합니다. 
따라서 두 번째 3항 연산자의 조건은 참(true)이 되어서 `Korean` 문자열을 출력합니다. 
즉, `$lang`의 값이 반환됩니다.  

<br>