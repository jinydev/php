---
layout: php
title: "const 키워드"
keyword: "const, php, keyword"
description: "PHP const 키워드를 사용하여 상수를 선언하는 방법을 알아봅니다."
breadcrumb:
- syntax
- "const"
- "const"
---

<jiny-book-mark>const 키워드</jiny-book-mark>

# const 키워드
---
PHP는 내장 함수인 `define()` 외에도 `const` 키워드를 사용하여 상수를 정의할 수 있습니다. `const`는 프로그램 소스 코드 상에서 직관적으로 상수를 생성할 수 있게 도와줍니다.

<br>

## const 문법
---
`const` 키워드를 사용하는 문법은 다음과 같이 대입 연산자(`=`)를 사용해 간단하게 작성합니다.

```php
const 상수명 = 값;
```

`const` 키워드는 컴파일 시점(Compile-time)에 값이 평가되어 상수가 생성됩니다. 따라서 소스 코드에서 `const` 키워드 이전 라인에서 상수를 호출하면, 정의되지 않은 상수를 호출한 것으로 간주하여 에러가 발생하게 됩니다.

<br>

## 사용 상의 주요 제약 사항
---
`const` 키워드는 컴파일 시점에 즉시 처리되는 언어적 특성 때문에 다음과 같은 제약 조건을 지닙니다.

1. **제어 흐름 내부 사용 불가**:  
   함수 안이나 조건문(`if`), 반복문(`for`, `while`), `try-catch` 블록 내부에서는 `const`를 사용할 수 없습니다. 컴파일 단계에서 무조건 생성되기 때문에 조건에 따른 동적 정의를 처리할 수 없기 때문입니다.
2. **클래스 상수(Class Constant) 정의 지원**:  
   반대로 클래스 정의 내부(`class {}` 블록)에서는 상수를 선언할 때 오직 `const` 키워드만 사용해야 합니다. `define()` 함수는 클래스 블록 내에서 사용할 수 없습니다.

<br>

## 실습 예제
---

### 예제: const-01.php
```php
<?php
    // 상수를 선언합니다.
    const DB_TYPE = "mysql";

    // 상수를 출력합니다.
    echo DB_TYPE;
?>
```

**출력 결과**
```text
mysql
```

<br>

### 예제: const-02.php (상수 값을 변수에 대입)
정의된 상수의 값은 일반적인 데이터와 마찬가지로 다른 변수에 대입하여 활용할 수 있습니다.

```php
<?php
    // 상수를 선언합니다.
    const DB_TYPE = "mysql";
    
    // 상수의 값을 변수에 할당합니다.
    $dbTYPE = DB_TYPE;

    // 대입된 변수의 값을 출력합니다.
    echo $dbTYPE;
?>
```

**출력 결과**
```text
mysql
```
