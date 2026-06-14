---
layout: php
title: "Null 병합 연산자 - PHP 프로그래밍"
breadcrumb:
- syntax
- "operator"
- "coalescing"
---

# Null 병합 연산자 (Null Coalescing Operator)
---
프로그래밍을 하다 보면 가장 빈번하게 마주치는 상황 중 하나가 "변수에 값이 존재하는지 확인하고, 값이 없다면 기본값(Default)을 대입하는 처리"입니다. 

PHP 5.x 이전까지는 이를 해결하기 위해 `isset()` 함수와 3항 연산자를 결합하여 코드를 길게 작성해야 했습니다. 하지만 PHP 7.0부터는 이러한 작업을 획기적으로 줄여줄 수 있는 **Null 병합 연산자(`??`)**가 도입되었습니다. 또한 PHP 7.4에서는 대입 연산까지 결합한 **Null 병합 대입 연산자(`??=`)**가 추가되었습니다.

<br>

## 1. 기존 방식의 한계 (PHP 5)
---
기존 PHP 5.x 이하 버전에서는 사용자 입력값이나 배열의 특정 키가 정의되어 있는지 판별하고 기본값을 지정하려면 다음과 같이 작성해야 했습니다.

```php
// 사용자 입력 세션 정보 확인 예제
if (isset($_GET['user'])) {
    $username = $_GET['user'];
} else {
    $username = 'Guest';
}
```

이 코드는 단순한 할당 조건임에도 불구하고 여러 줄을 차지하여 가독성을 저해합니다. 이를 3항 연산자로 축소하면 다음과 같습니다.

```php
$username = isset($_GET['user']) ? $_GET['user'] : 'Guest';
```

한 줄로 간소화되기는 했으나, `$_GET['user']`라는 변수명이 동일한 행에 중복으로 작성되어 코드가 장황해집니다. 만약 배열의 뎁스가 깊은 `$config['db']['settings']['host']` 같은 구조라면 코드가 매우 길어지고 복잡해지는 원인이 됩니다.

<br>

## 2. Null 병합 연산자 (`??`) 도입 (PHP 7)
---
PHP 7.0부터 제공하는 Null 병합 연산자 `??`를 사용하면 변수가 정의되어 있는지와 `null` 인지를 판별하는 로직을 극적으로 줄일 수 있습니다.

![Null 병합 연산자 흐름도](./img/coalescing_flow.svg)

|문법|
```php
$result = $value1 ?? $value2;
```

작동 원리는 다음과 같습니다:
1. `$value1`이 존재(isset)하고, 그 값이 `null`이 아니면 `$value1`을 결과값으로 반환합니다.
2. 만약 `$value1`이 정의되어 있지 않거나 `null`이면, 우항의 `$value2`를 반환합니다.

예제 파일 coalescing-01.php
```php
<?php
    // 1. 선언되지 않은 변수를 좌항에 둡니다. (원래는 경고가 나지만 ??는 안전하게 기본값으로 넘어갑니다.)
    $username = $undefined_var ?? 'Guest';
    echo "결과 1: " . $username . "<br>"; // 출력: 결과 1: Guest

    // 2. 변수가 정의되었으나 명시적으로 null이 대입된 상태입니다.
    $profile = null;
    $user_profile = $profile ?? '기본 프로필';
    echo "결과 2: " . $user_profile . "<br>"; // 출력: 결과 2: 기본 프로필

    // 3. 변수가 선언되었고 유효한 문자열 데이터가 저장되어 있는 상태입니다.
    $name = '홍길동';
    $final_name = $name ?? '이름 없음';
    echo "결과 3: " . $final_name . "<br>"; // 출력: 결과 3: 홍길동
?>
```

실행 결과
```text
결과 1: Guest
결과 2: 기본 프로필
결과 3: 홍길동
```

<br>

## 3. 다중 체이닝 지원
---
Null 병합 연산자는 여러 개를 연속해서 연결(Chain)하는 동작도 완벽하게 수행합니다. 우선순위대로 검사하여 처음으로 `null`이 아닌 유효한 값을 가진 변수를 선택합니다.

예제 파일 coalescing-02.php
```php
<?php
    // 모든 GET, POST 파라미터가 비어 있고 세션 데이터만 있는 상태를 가정합니다.
    $get_user = null;
    $post_user = null;
    $session_user = 'Admin';

    // 왼쪽부터 순차적으로 검사하여 null이 아닌 첫 번째 값을 대입합니다.
    // $get_user(null) ➡️ $post_user(null) ➡️ $session_user('Admin', 유효함!) 순서로 검사
    $current_user = $get_user ?? $post_user ?? $session_user ?? 'Guest';
    echo "접속 사용자: " . $current_user; // 출력: 접속 사용자: Admin
?>
```

실행 결과
```text
접속 사용자: Admin
```

<br>

## 4. Null 병합 대입 연산자 (`??=`) 추가 (PHP 7.4)
---
PHP 7.4 버전에서는 Null 병합 연산자를 결합하여 자기 자신에게 기본값을 할당하는 코드를 더욱 간편하게 작성할 수 있는 **Null 병합 대입 연산자(Null Coalescing Assignment Operator, `??=`)**가 도입되었습니다.

- **기존 형식**: `$a = $a ?? 'Default';`
- **단축 형식**: `$a ??= 'Default';`

예제 파일 coalescing-03.php
```php
<?php
    $data = [];

    // 'timeout' 키가 정의되어 있지 않으므로(null과 동일) 기본값 30을 할당합니다.
    $data['timeout'] ??= 30;
    echo "Timeout 1: " . $data['timeout'] . "<br>"; // 출력: Timeout 1: 30

    // 이미 'timeout' 값이 30으로 존재하므로 기존 값을 유지하고 60 대입은 무시됩니다.
    $data['timeout'] ??= 60;
    echo "Timeout 2: " . $data['timeout'] . "<br>"; // 출력: Timeout 2: 30
?>
```

실행 결과
```
Timeout 1: 30
Timeout 2: 30
```

<br>

## 5. 3항 연산자 단축형과의 비교 (`?:`)
---
PHP 5.3부터 지원되는 3항 연산자의 단축형인 `$a ?: $b` 표현식과 `??` 연산자는 겉보기에 유사하지만, 판별 조건에 미세한 차이가 있으므로 주의해야 합니다.

- **`$a ?: $b` (엘비스 연산자)**: `$a`가 참(True)으로 평가되는지 확인합니다. 즉, `$a`가 `0`, `""`(빈 문자열), `false`, `null`, `[]`(빈 배열)일 때 모두 거짓으로 판별하여 `$b`를 반환합니다. 만약 `$a` 변수가 정의되어 있지 않다면 **Notice: Undefined variable** 경고가 발생합니다.
- **`$a ?? $b` (Null 병합 연산자)**: 오직 `$a`가 정의되어 있지 않거나(isset이 false) `null`인 경우에만 `$b`를 반환합니다. 변수가 정의되어 있지 않아도 경고(Notice)를 유발하지 않고 안전하게 넘어갑니다.

따라서 폼 입력값 검증 등 변수가 미선언 상태일 수 있거나, 값의 실존(null 여부)만 엄격히 판별해야 하는 경우에는 반드시 Null 병합 연산자 `??`를 사용해야 프로그램 크래시를 안전하게 방어할 수 있습니다.
