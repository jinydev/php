---
layout: php
title: "상수"
keyword: "const, php"
description: "php 상수에 대해서 학습합니다. 삼수는 고정된 값입니다."
breadcrumb:
- "basic"
- "const"
---

# 상수
---
컴퓨터는 다양한 데이터 값을 처리합니다.  
`정수값`, `실수값` 및 `문자열` 등 프로그램 언어들은 이러한 다양한 데이터 값을 연산하고 결과를 화면에 출력합니다.

<br>

## 개발자의 값
---
데이터의 값은 개발자가 사전에 정의한 값이 될 수도 있고, 프로그램에서 연산을 통해 생성된 데이터일 수도 있습니다.  
개발자가 프로그램에서 `직접 정의한 데이터 값`은 프로그램 동작 중에는 변경되지 않는 `고정값`입니다.  
보통 이렇게 프로그램 동작에 따라서 처리되는 값이 아닌 프로그램 처음부터 끝까지 고정된 값을 `상수`라고 표현합니다.

<br>

## 값의 정의
---
고정된 값은 다양한 이름으로 재정의하여 사용할 수 있습니다. 이를 `데이터를 상수화 처리한다`고 합니다.  
상수는 숫자 또는 논리값, 문자열 등 다양한 데이터 값을 상수명으로 지정할 수 있습니다. 심지어 `특수기호` 등도 상수로 지정할 수 있습니다. 
 
<br>

## 일관성 있는 값을 적용
---
이렇게 데이터를 상수명 형태로 변경해서 사용하는 이유는 고정된 데이터의 값을 `일관성` 있게 처리하기 위함입니다.  
만일 어떤 고정값이 `3`이라는 숫자 값으로 있다고 합시다.  

그 다음에 고정된 값 `3`을 `5`로 변경하려고 할 때, 모든 연관된 소스 코드의 값을 모두 3에서 5로 변경해야만 할 것입니다.  
이러한 고정값과 데이터를 변경하는 작업은 소스의 크기가 커질수록 쉬운 일이 아닐 것입니다.

이처럼 상수는 자주 쓰는 고정값이나, 사람이 쉽게 인지할 수 없는 특수 데이터 값 등을 `상수명` 형태로 `정의`해서 사용하면 매우 편리합니다. 

또한 수정할 때 상수 이름의 값만 수정함으로써 소스의 전체적인 데이터 값을 한꺼번에 바꿀 수 있습니다.  
대표적으로 자주 사용하는 상수명으로는 색상을 표시하는 RED, WHITE, BLUE 등의 색상 코드값을 상수로 정의해서 많이 사용합니다.

<br>

## 설정값
---
상수명 및 데이터는 프로그램 소스의 상단 또는 별도의 파일로 분리, 관리하는 경우가 많이 있습니다.  
즉, 이렇게 별도 관리되는 파일들을 환경 설정 파일이라고도 부릅니다.

<br>

## [상수의 특징](character)
---
* 상수의 위치
* 상수의 특성

<br>

## [상수의 타입](type)
---
* 정수형 상수
* 실수형 상수
* 문자 상수

<br>

## 상수 설정
---
PHP 코드에서 상수를 선언하고 사용하는 방법에 대해서 알아 봅니다.  

<br>

### 상수의 명칭
상수의 명칭을 정의할 때는 문자, 언더바(`_`)로 시작된 이름으로만 설정할 수 있습니다.  
다만 상수명은 첫 글자를 숫자로 정의할 수 없습니다.  
또한 상수는 상수값으로 `스칼라 값` 또는 `NULL`로 설정할 수도 있습니다.

<br>

### 상수 선언하기
PHP언어 에서는 두 가지 방식으로 상수를 설정할 수 있습니다.  
내장 함수 `define()` 과 상수 키워드 `const`를 통하여 상수를 선언할 수 있습니다. 

* [define()](define)
* [const 키워드](const)

<br>

### 상수값 사용
PHP에서 코드에 설정한 상수값은 상수명을 그대로 적으면 됩니다. 상수는 변수와 달리 $ 기호를 사용하지 않습니다.

상수 출력 예제)
```php
echo DB_TYPE;
```

<br>

## [상수 존재 여부 확인](defined)
---
상수명은 중복하여 사용할 수 없습니다.  
상수의 중복 사용을 방지하기 위해 또는 상수값 참조 오류를 방지하기 위해 기존 상수값이 선언되었는지 확인이 필요합니다.  

<br>

## [미리 정의된 상수](reserved)
---

