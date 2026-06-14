---
layout: php
title: "Match 표현식 - PHP 프로그래밍"
breadcrumb:
- syntax
- "condition"
- "match"
---

# Match 표현식 (Match Expression)
---
조건문 if와 switch는 제어 흐름을 분기하기 위한 가장 기본적인 제어 문법입니다. 하지만 switch 문은 장황한 문법, 유연하지 못한 비교 연산, 그리고 결정적으로 `break;` 생략 시 예기치 않게 하향하여 다른 블록까지 실행되는 낙하(Fall-through) 현상 등의 문제를 가지고 있습니다.

PHP 8.0부터는 이러한 switch 문법의 한계와 구조적 결함을 완벽히 개선한 현대적이고 안전한 **Match 표현식(Match Expression)**이 도입되었습니다.

<br>

## 1. Match 표현식 개요
---
`match`는 단순한 제어 흐름 분기가 아니라 값을 계산해서 내놓는 **표현식(Expression)**입니다. 따라서 분기 처리한 연산의 결과를 변수에 직접 바인딩할 수 있으며, 기존 switch문 대비 훨씬 압축적이고 직관적인 코드 구조를 제공합니다.

![Match 표현식 흐름도](./img/match_flow.svg)

|문법|
```php
$result = match ($value) {
    조건1 => 반환값1,
    조건2, 조건3 => 반환값2,
    default => 기본반환값
};
```

match 표현식의 규칙은 다음과 같습니다:
1. 각 매칭 분기는 콤마(`,`)로 구분합니다.
2. 화살표(`=>`) 오른쪽에 실행할 연산식 또는 반환될 값을 정의합니다.
3. 여러 조건을 하나로 묶고 싶다면 콤마(`,`)로 연달아 기술하면 됩니다.
4. 표현식의 마지막 끝은 세미콜론(`;`)으로 닫아야 합니다.

<br>

## 2. switch와 match의 성능 및 문법 대조
---
기존의 switch문과 PHP 8.0의 match 표현식이 어떻게 다르고 가독성이 향상되는지 동일한 동작의 예제를 통해 비교해 봅니다.

### 기존 switch 방식 (PHP 7)
```php
$roleCode = 2;
$roleName = '';

// switch문은 여러 줄의 case와 break; 문을 반복 선언해야 하므로 장황해집니다.
switch ($roleCode) {
    case 1:
        $roleName = 'Administrator';
        break;
    case 2:
    case 3:
        $roleName = 'Manager'; // break;가 없으면 다음으로 그대로 진행되는 예외가 발생할 위험이 있습니다.
        break;
    default:
        $roleName = 'Guest';
        break;
}
echo $roleName; // 출력: Manager
```

### 개선된 match 방식 (PHP 8)
```php
$roleCode = 2;

// match는 결과를 즉시 평가하여 변수에 할당(대입)할 수 있어 매우 직관적입니다.
$roleName = match ($roleCode) {
    1 => 'Administrator',
    2, 3 => 'Manager', // 콤마(,)로 여러 매칭 조건을 깔끔하게 묶을 수 있습니다.
    default => 'Guest',
};
echo $roleName; // 출력: Manager
```

코드가 대폭 단축되었으며, `break;`나 중복되는 변수 할당문 `$roleName = ...`이 제거되어 실수의 소지를 차단하고 비약적인 가독성을 보여줍니다.

<br>

## 3. match 표현식의 핵심 특징
---

### 1) 엄격한 타입 비교 (`===`)
기존 switch문은 값을 비교할 때 느슨한 비교(Loose Comparison, `==`)를 수행합니다. 이로 인해 정수 `0`과 빈 문자열 `""` 혹은 `false`를 동일한 조건으로 판별하여 예기치 못한 버그를 유발합니다.  
반면, match 표현식은 **엄격한 비교(Strict Comparison, `===`)**를 강제하므로 타입과 값이 모두 정확하게 일치해야만 동작합니다.

예제 파일 match-01.php
```php
<?php
    $value = '0'; // 문자열 '0'

    // switch문은 느슨한 비교(==)를 통해 문자열 '0'과 정수 0을 동일하게 봅니다.
    switch ($value) {
        case 0:
            echo "switch 결과: 정수 0 입니다.<br>";
            break;
        default:
            echo "switch 결과: 일치하지 않습니다.<br>";
    }

    // match 표현식은 엄격한 비교(===)를 수행하므로 정수 0과 매치되지 않습니다.
    $matchResult = match ($value) {
        0 => "정수 0 입니다.",
        default => "일치하지 않습니다."
    };
    echo "match 결과: " . $matchResult; // 출력: match 결과: 일치하지 않습니다.
?>
```

실행 결과
```text
switch 결과: 정수 0 입니다.
match 결과: 일치하지 않습니다.
```

<br>

### 2) 미매칭 시 발생되는 예외 (UnhandledMatchError)
switch문은 일치하는 조건이 없고 `default` 분기조차 선언하지 않았을 때 아무 일도 일어나지 않은 채 다음 코드로 넘어갑니다. 이는 버그 감지를 어렵게 만듭니다.  
하지만 match 표현식은 일치하는 조건이 없으면 런타임에 **`UnhandledMatchError` 예외**를 즉시 발생시켜 비정상적인 흐름을 예방합니다.

예제 파일 match-02.php
```php
<?php
    $statusCode = 503;

    try {
        // 일치하는 조건 및 default가 선언되지 않은 상태에서 호출을 감행합니다.
        $msg = match ($statusCode) {
            200 => 'OK',
            404 => 'Not Found',
            // default 혹은 503에 해당하는 분기가 없습니다!
        };
    } catch (UnhandledMatchError $e) {
        // 일치하는 매치가 없을 시 런타임 예외가 던져집니다.
        echo "에러 감지: 일치하는 매치 조건을 찾지 못했습니다. (" . $e->getMessage() . ")";
    }
?>
```

실행 결과
```text
에러 감지: 일치하는 매치 조건을 찾지 못했습니다. (Unhandled match value of type int)
```
따라서 match 표현식을 사용할 때는 발생 가능한 모든 입력값을 처리하거나, 마지막에 `default` 분기를 필수적으로 지정해 주는 습관이 필요합니다.

<br>

### 3) 값의 직접 평가와 가벼운 실행식
match 표현식의 우항에는 단순히 리터럴 상수 값만 적을 수 있는 것이 아닙니다. 함수 호출이나 복잡한 연산식도 지원합니다.

```php
$status = 404;

// 각 조건에 따라 다른 핸들러 함수를 실행하고 그 결과 값을 대입합니다.
$response = match ($status) {
    200 => handleSuccess(), // 함수 호출 결과 반영
    400, 404 => handleClientError($status), // 매개변수도 전달 가능
    default => handleServerError()
};
```
단, match의 각 분기는 실행 경로 분기가 아니라 "결과 평가식"이므로 분기에 복잡한 다중 행의 실행 블록 `{ ... }`을 직접 넣을 수는 없습니다. 복잡한 제어 흐름 분기가 필요한 경우에는 기존의 `if`나 `switch` 문을 적절히 혼용해서 설계해야 합니다.
