---
layout: php
title: "상수 존재 확인"
keyword: "const, php, defined"
description: "PHP defined() 함수를 활용하여 특정 상수가 이미 선언되어 있는지 확인하는 방법을 학습합니다."
breadcrumb:
- syntax
- "const"
- "defined"
---

<jiny-book-mark>상수 존재 확인</jiny-book-mark>

# 상수 존재 확인
---
PHP 프로그램은 다양한 모듈이나 외부 라이브러리를 동적으로 연결하여 실행되기도 합니다. 이로 인해 동일한 이름의 상수가 이미 선언되어 오류가 발생하거나, 혹은 정의되지 않은 상수를 호출하여 프로그램이 중단될 위험이 있습니다.

이러한 오작동과 오류를 방지하기 위해, 특정 상수가 이미 선언되어 활성화되어 있는지를 확인하는 과정이 필요합니다.

<br>

## defined() 함수
---
PHP는 상수가 메모리에 정의되어 있는지를 체크할 수 있도록 `defined()` 내장 함수를 제공합니다. 이 함수는 상수명을 문자열로 인자로 받아 존재 여부를 논리값(`true`/`false`)으로 반환합니다.

```php
bool defined(string $name);
```

* **매개변수 (`$name`)**: 검사하고자 하는 상수의 이름입니다. 반드시 문자열(String) 형태로 입력합니다.
* **반환값**: 상수가 이미 존재하고 설정되어 있으면 `true`, 존재하지 않으면 `false`를 반환합니다.

<br>

## 실습 예제
---

### 예제: defined.php
```php
<?php
    // TEST 상수가 정의되어 있는지 확인합니다.
    if (defined('TEST')) {
        echo "TEST 상수가 존재합니다.";
    } else {
        echo "TEST 상수가 없습니다.";
    }
    echo "<br>";

    // TEST 상수를 임의로 정의해 봅니다.
    define('TEST', 'Hello PHP');

    // 다시 정의 여부를 검사해 봅니다.
    if (defined('TEST')) {
        echo "이제 TEST 상수가 존재합니다. 값: " . TEST;
    }
?>
```

**출력 결과**
```text
TEST 상수가 없습니다.
이제 TEST 상수가 존재합니다. 값: Hello PHP
```

이처럼 `defined()` 함수를 사용하면 동적으로 외부 설정 파일을 로드하거나 조건부로 공통 라이브러리를 바인딩할 때, 상수의 중복 정의 에러나 미지정 상수 참조 에러를 손쉽게 방어할 수 있습니다.
