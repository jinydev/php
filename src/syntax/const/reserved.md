---
layout: php
title: "예약된 상수"
keyword: "const, php, reserved"
description: "PHP에서 미리 약속되어 제공되는 내장 상수와 마법 상수를 알아봅니다."
breadcrumb:
- syntax
- "const"
- "reserved"
---

<jiny-book-mark>예약된 상수</jiny-book-mark>

# 예약된 상수
---
PHP 언어는 개발자가 직접 `define()`이나 `const`로 정의하지 않아도, 엔진 자체에서 사전에 예약하여 항상 기본 제공하는 내장 상수들이 많이 있습니다. 상수를 직접 선언해 사용하기 전에, 이미 중복된 이름으로 예약되어 있는 것은 아닌지 유의할 필요가 있습니다.

<br>

## 정의된 모든 상수 목록 구하기
---
PHP에 현재 선언되어 활성화된 모든 상수를 한눈에 확인하려면 `get_defined_constants()` 함수를 사용하면 편리합니다.

```php
array get_defined_constants([bool $categorize = false]);
```

- **`$categorize`**: 이 인자의 값을 `true`로 지정하면 상수가 소속된 확장 모듈(Core, Standard, hash 등) 별로 2차원 배열 형태로 분류해서 반환합니다. 생략하거나 `false`로 지정하면 모든 상수가 단일 배열 형태로 반환됩니다.

### 예제: get_defined_constants.php
```php
<?php
    // 임의의 사용자 정의 상수를 하나 만듭니다.
    define("MY_CONSTANT", 1);
    
    // 정의된 모든 상수 목록을 카테고리 형태로 출력합니다.
    print_r(get_defined_constants(true));
?>
```

*(출력 결과는 내용이 매우 많으므로 지면 관계상 생략합니다. 실제 구동 시 수백 개 이상의 환경 상수가 노출됩니다.)*

<br>

## 미리 정의된 핵심 상수
---
PHP가 시스템 및 OS 정보를 제공하기 위해 기본적으로 내장하고 있는 대표적인 핵심 상수 목록입니다.

* **`PHP_VERSION`**: 현재 웹 서버에 설치되어 실행 중인 PHP의 버전 정보를 담고 있습니다.
* **`PHP_OS`**: PHP가 현재 작동하고 있는 서버 OS의 이름을 반환합니다. (예: `WINNT`, `Linux`, `Darwin` 등)
* **`TRUE`**: 참(true), 즉 `1`을 의미하는 논리형 상수입니다.
* **`FALSE`**: 거짓(false), 즉 빈 값을 의미하는 논리형 상수입니다.
* **`E_ERROR`**: 스크립트 실행을 완전히 중단시키는 심각한 런타임 에러 상수입니다.
* **`E_WARNING`**: 실행에는 큰 지장을 주지 않으나 주의가 필요한 경고 알림 상수입니다.
* **`E_PARSE`**: 소스 코드의 문법 검사 중 오류를 만났을 때 가리키는 구문 분석 에러 상수입니다.
* **`E_NOTICE`**: 에러는 아니지만 코딩 상 비효율적인 부분이 있을 때 발생하는 단순 알림 상수입니다.

<br>

## 마법 상수 (Magic Constants)
---
일반적인 상수는 프로그램 시작 시 결정된 뒤 절대로 변경되지 않습니다. 하지만 PHP에는 호출되는 **위치나 문맥에 따라 상수의 값이 유동적으로 변하는** 8개의 특수한 상수가 있으며, 이를 **마법 상수**라고 부릅니다. 마법 상수는 항상 두 개의 언더바(`__`)로 시작하고 끝나는 규칙을 갖습니다.

* **`__FILE__`**: 이 상수가 호출된 해당 PHP 파일의 전체 경로(절대 경로)와 파일명을 반환합니다.
* **`__LINE__`**: 이 상수가 작성되어 실행되는 해당 소스 코드의 현재 행(Line) 번호를 정수로 반환합니다.
* **`__DIR__`**: 해당 파일이 위치한 디렉터리의 절대 경로를 반환합니다. (`dirname(__FILE__)`과 동일)
* **`__FUNCTION__`**: 현재 실행 중인 함수의 이름을 반환합니다.
* **`__CLASS__`**: 현재 사용 중인 클래스의 이름을 반환합니다.
* **`__METHOD__`**: 현재 실행 중인 클래스의 메서드명을 반환합니다.
* **`__NAMESPACE__`**: 현재 지정되어 동작 중인 네임스페이스의 이름을 반환합니다.

<br>

### 실습 예제: const-03.php
```php
<?php 
    // 파일의 전체 경로와 파일명을 표시합니다.
    echo __FILE__ . "<br/>\n";

    // 현재 상수를 정의한 행 번호를 출력합니다. (5번 라인)
    echo __LINE__ . "<br/>\n";

    // 서버에 설치된 PHP 버전을 표시합니다.
    echo PHP_VERSION . "<br/>\n";

    // PHP가 실행 중인 OS의 이름을 표시합니다.
    echo PHP_OS . "<br/>\n";

    echo TRUE . "<br/>\n";
    echo FALSE . "<br/>\n";  

    // 함수명 상수 정의 
    function functionname(){ 
        echo __FUNCTION__ . "<br>"; 
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
    echo $test->test . "<br>";

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
    echo $test2->test . "<br>";
?>
```

**출력 결과**
```text
C:\php-7.1.4-Win32-VC14-x86\jinyphp\const-03.php
6
7.1.4
WINNT
1

functionname
classtest
classtest2
```
