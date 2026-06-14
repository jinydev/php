---
layout: php
title: "논리형 (Boolean) 자료형"
description: "참(True)과 거짓(False), 혹은 1과 0의 2진 논리 값 상태만을 가지는 PHP 논리(Boolean) 자료형의 기본 개념과 활용법을 배웁니다."
keyword: "php 논리형, php boolean, 불리언 타입, true false"
breadcrumb:
- syntax
- variable
- type
- bool
---

# 논리변수
---
불린(Boolean)이라고 부르는 변수형 타입은 논리형 변수라고도 합니다. 주로 수학적 의미로 참(True)과 거짓(False)을 표기하며, 때로는 2진 전자기 구조에 기인하여 1과 0의 숫자값으로 표현하기도 합니다. 하지만 코드 가독성을 위해 오늘날 개발에서는 숫자값 대신 상수를 이용하여 `true`, `false` 기호를 사용하여 처리합니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/bool_concept_cartoon.png" alt="Boolean Switch Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 전등 스위치의 온(ON = TRUE) / 오프(OFF = FALSE) 상태에 빗댄 논리 자료형 개념</p>
</div>

<br>
논리변수를 불린이라고 부르는 이유는 영국의 수학자 겸 논리학자인 조지 불(George Boole) 이름에 서 유래한 것입니다.  

논리변수는 조건문, 반복문 등 어떠한 처리 결과의 성공 여부를 확인하거나, 반환하는 값으로 가장 많이 사용하는 변수 타입 중 하나입니다. 따라서 논리변수의 개념은 반드시 숙지하고 넘어가야 합니다.  

<br>

## 0 과 1
---
컴퓨터는 수많은 트랜지스터의 집합으로 표현을 합니다. 전기가 통하고 있는 상태 1과 전기가 단절된 상태 0 으로만 표현이 됩니다.  

따라서, 컴퓨터는 우리가 일반적으로 사용하는 10진법의 수학을 표현하지 않고, 2진법 형태로 모든 데이터와 처리를 반복합니다.  

<br>

## 논리변수 출현
---
기존 언어에서는 변수에 논리값을 숫자 0 또는 1의 값을 넣어서 판별을 하거나, 변수의 비트값을 연산하여 처리하였습니다.  

0과 1의 표현은 사람이 직관적으로 쉽게 알아보기는 어렵습니다. 그래서,  

|표현|
{% raw %}
```
0 = false (거짓)
1 = true (참)
```
{% endraw %}

이라고 변수에 문자열로 ‘true’ 또는 ‘false’로 저장하여 문자열로 판별했습니다. 하지만 문자열을 통해 처리하는 것은 문자 수만큼의 메모리가 필요합니다. 따라서 논리변수 타입의 변수와 대입하는 값은 상수값처럼 TRUE, FALSE로 입력하여 처리합니다.  

<br>

## 논리변수 생성
---
논리변수를 만드는 것은 간단합니다. $변수명 뒤에 논리 상수명을 적어주면 됩니다.  

|문법|
{% raw %}
```php
$x = true;
$y = false;
```
{% endraw %}

논리값은 소문자/대문자를 구분하지 않습니다.  

예제 파일 bool-01.php
{% raw %}
```php
<?php
	$a = true;
	If ($a) {
		echo "a = true(참) 입니다.";
	} else {
		echo "a = false(거짓) 입니다.";
	}

	echo "<br>";

	$b = TRUE;
	If ($b) {
		echo "b = true(참) 입니다.";
	} else {
		echo "b = false(거짓) 입니다.";
	}

	echo "<br>";

	$c = false;
	If ($c) {
		echo "c = true(참) 입니다.";
	} else {
		echo "c = false(거짓) 입니다.";
	}

	echo "<br>";

	$d = FALSE;
	If ($d) {
		echo "d = true(참) 입니다.";
	} else {
		echo "d = false(거짓) 입니다.";
	}

	echo "<br>";
?>
```
{% endraw %}

결과
{% raw %}
```
a = true(참) 입니다.
b = true(참) 입니다.
c = false(거짓) 입니다.
d = false(거짓) 입니다.
```
{% endraw %}

<br>

## 논리변수 확인
---
PHP는 생성한 변수가 논리변수를 확인할 수 있는 is_bool()이라는 내부함수를 제공합니다.  

|관련함수|
{% raw %}
```php
bool is_bool ( mixed $var )
```
{% endraw %}

매개변수 값으로 변수를 전달하면 변수의 논리 타입 여부를 논리값 형태로 반환합니다.  

사용예 bool-02.php
{% raw %}
```php
<?php
  $a = false;
  $b = 0;

  // 논리값으로 쓰여진 변수인지를 확인합니다.
  if (is_bool($a) === true) {
    echo "a는 논리 변수 입니다.";
  }

  echo "<br>";

  // $b는 정수 0 입니다. 논리 변수가 아니라서 false 를 반환합니다.
  if (is_bool($b) === false) {
    echo "b는 논리 변수가 아닙니다.<br>";
    var_dump($b);
  }

?> 
```
{% endraw %}

결과
{% raw %}
```
a는 논리 변수 입니다.
b는 논리 변수가 아닙니다.
int(0)
```
{% endraw %}

위의 예제는 변수값의 논리 타입 여부를 확인하는 예입니다.  

<br>