---
layout: php
title: "PHP 기본문법"
keyword: "php, grammer, web"
description: "웹 어플리케이션 서버를 개발을 위한 php 언어의 기본 문법을 학습니다."
breadcrumb:
- basic
---

# 기본문법
---
`PHP 언어`를 학습하는 초보자를 대상으로 기본적인 프로그램밍 구조와 문법에 대해서 학습합니다.

<br>

## 코드작성
---
PHP 코드를 작성 및 삽입을 위한 `Tag`와 코드 작성을 위한 코드 컨벤션인 `PSR`에 대해서 알아 봅니다.

### [PHP 테그](tag)
---
PHP 코드를 작성하는 방법은 자유롭습니다. PHP코드의 시작과 끝을 `표기`만 해주면 됩니다.  
시작테그(`<?php`)와 종료테그(`?>`)에 대해서 학습합니다.

* [시작테그와 종료테그](tag)
* html코드와 [혼합 사용하기](tag/html)
* [독립적인 php코드](standard) 사용하기

<br>

### [코드스타일 PSR](psr)
---
PSR은 코드 스타일을 권장하여 더 많은 사람들이 PHP 소스를 공유하고 함께 개발하기 위해서입니다.  

* [PSR-1](psr/psr1)
* [PSR-2](psr/psr2)

<br>

## 자료구조 및 연산
---
PHP 언어의 `상수`, `변수`의 선언 및 구조에 대해서 알아 봅니다. 또한, 기본적인 연산 동작에 대해서 알아 봅니다. 

<br>

### [상수](const)
---
개발자가 프로그램에서 `직접 정의한 데이터 값`은 프로그램 동작 중에는 변경되지 않는 `고정값`입니다.  
보통 이렇게 프로그램 동작에 따라서 처리되는 값이 아닌 프로그램 처음부터 끝까지 고정된 값을 `상수`라고 표현합니다.  

* [상수의 타입](const/type)
* 상수값 사용
* [define()](const/define)
* [const 키워드](const/const)
* [상수 존재 여부 확인](const/defined)
* [미리 정의된 상수](const/reserved)

<br>

### [변수](variable)
---
반복적인 일을 수행하기 위해서는 변수라는 메모리 공간이 필요합니다. 
이렇게 프로그램이 실행하고 있는 도중에 값을 저장하는 메모리 공간을 변수라고 부릅니다.  

* [변수명을 만드는 규칙](variable/name)
* [변수와 메모리](variable/memory)
* [변수의 선언](variable/declare)
* 변수의 [데이터 형식](variable/type)
* [스칼라](variable/scalar) 타입
* [가변변수](variable/ref)
* [변수 삭제](variable/unset)
* 자동 [전역변수](variable/global)

<br>

### [연산자](operator)
---
프로그램 언어에서의 연산은 기본적인 덧셈, 뺄셈과 같은 산술 연산 이외에 다양한 연산 처리를 합니다.  

* [수학계산](operator)
* [대입과 참조](operator)
* [연산](operator)
* [논리](operator)
* [문자열](operator)
* [배열](operator)
* [기타](operator)


<br>

## 흐름제어
---
절차지향적 논리적 프로그래밍을 위한 흐름제어 기능에 대해서 알아 보도록 합니다.  

### 제어문
---
* [조건제어문](condition)
* [3항 연산자](condition/ternary)

### 반복문
---
* [반복문](loop)

<br>

## [전처리기](preprocess)
---
* include
* require

<br>

## [유효범위](scope)
---
* Global : 글로벌변수
* Local : 지역변수
* Static : 정적변수


<br>

