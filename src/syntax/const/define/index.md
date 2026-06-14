---
layout: php
title: "define() 함수"
keyword: "const, php, define"
description: "PHP define() 함수를 활용하여 상수를 선언하고 사용하는 방법을 학습합니다."
breadcrumb:
- syntax
- "const"
- "define"
---

<jiny-book-mark>define() 함수</jiny-book-mark>

# define() 함수
---
`define()`은 PHP가 기본적으로 제공하는 내장 함수로, 이를 사용하면 프로그램 어디서나 사용할 수 있는 상수를 선언할 수 있습니다.

<br>

## define() 함수의 형식
---
`define()` 함수는 다음과 같은 형식으로 호출합니다.

```php
bool define(string $name, mixed $value, bool $case_insensitive = false);
```

* **첫 번째 인자 (`$name`)**: 생성할 상수의 이름입니다. 문자열 형태로 지정합니다.
* **두 번째 인자 (`$value`)**: 상수에 대입할 값입니다. 스칼라 값(정수, 실수, 문자열, 논리값) 또는 `NULL`, 그리고 PHP 7 이상부터는 배열을 대입할 수 있습니다.
* **세 번째 인자 (`$case_insensitive`)**: 대소문자를 구분하지 않을지 여부를 설정합니다. 기본값은 `false` (대소문자 엄격 구분)입니다.

> [!WARNING]
> **대소문자 비구분(case_insensitive) 설정의 폐지**  
> 과거 PHP 버전에서는 세 번째 인자를 `true`로 설정하여 대소문자 구분 없이 상수를 사용할 수 있었으나, **PHP 7.3부터 권장되지 않음(Deprecated)**으로 지정되었고 **PHP 8.0부터는 더 이상 지원되지 않습니다.** 따라서 세 번째 인자는 생략하거나 `false`로 설정하는 것이 올바른 표준 개발 방법입니다.

`define()` 함수는 상수가 성공적으로 정의되면 `true`를 반환하고, 이미 존재하는 상수와 이름이 중복되는 등의 이유로 정의되지 못하면 `false`를 반환합니다.

<br>

## 실습 예제
---

### 예제: define-01.php
```php
<?php
    // 상수를 정의합니다.
    define("DB_TYPE", "mysql");

    // 설정한 상수를 출력합니다.
    echo DB_TYPE . "<br>";
?>
```

**출력 결과**
```text
mysql
```

<br>

### 예제: define-02.php (중복 선언 체크)
상수는 동일한 이름을 중복하여 재선언할 수 없으므로, 두 번째 선언 시 실패하여 `false`를 반환합니다.

```php
<?php
    // 상수를 정의합니다.
    define("DB_TYPE", "mysql");
    echo DB_TYPE . "<br>";

    // 상수를 중복 정의해 봅니다.
    if (define("DB_TYPE", "mysql")) {
        echo "상수 설정 성공";
    } else {
        echo "상수 설정 실패";
    }
?>
```

**출력 결과**
```text
mysql
상수 설정 실패
```

<br>

## 배열 상수 (PHP 7 이상)
---
기존 PHP 5.6 이하 버전에서는 상수의 값으로 하나의 단일 값(스칼라 값)만 넣을 수 있었습니다. 하지만 **PHP 7.0 이상**부터는 `define()` 함수를 활용하여 배열도 상수로 선언할 수 있습니다.

### 예제: define-03.php (배열 상수)
```php
<?php
    // 배열 상수를 선언합니다.
    define('ANIMALS', [
        'dog',
        'cat',
        'bird'
    ]);

    // 배열 상수의 요소에 접근하여 출력합니다.
    echo ANIMALS[1]; // outputs "cat"
?>
```

**출력 결과**
```text
cat
```

배열 상수도 일반 배열 변수와 동일하게 대괄호(`[]`)와 인덱스를 사용하여 각 요소에 안전하게 접근할 수 있습니다.
