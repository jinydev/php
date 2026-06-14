---
layout: php
title: "타입 선언 (Type Declarations) - PHP 프로그래밍"
breadcrumb:
- syntax
- "function"
- "param"
- "types"
---

# 매개변수 및 반환값 타입 선언 (Type Declarations)
---
PHP는 원래 변수나 매개변수의 데이터 형식을 엄격하게 고정하지 않는 동적 타이핑(Dynamic Typing) 언어입니다. 동적 타이핑은 빠르게 프로토타입을 개발할 때는 편리하지만, 대규모 시스템이나 협업 개발 시 잘못된 타입의 데이터가 전달되어 런타임 오류를 유발하는 치명적인 단점이 있습니다.

PHP 7.0부터는 이러한 불안정성을 극복하고 정적 타이핑 언어 수준의 안전성을 제공하기 위해 매개변수와 반환값의 타입을 강제할 수 있는 **타입 선언(Type Declarations)**이 전격 도입되었으며, PHP 8.x로 넘어오면서 **유니온 타입(Union Types)**과 `mixed` 등이 추가되어 완성되었습니다.

<br>

## 1. 엄격한 타입 검사 모드 (`strict_types`)
---
PHP의 타입 선언은 기본적으로 '느슨한 형식(Coercive Mode)'으로 작동합니다. 즉, `int` 타입을 요구하는 매개변수에 실수 `3.14`나 문자열 `"5"`를 전달하면, PHP가 알아서 정수 `3`과 `5`로 형변환(Casting)을 시도합니다.

![타입 선언 흐름도](./img/types_flow.svg)

만약 형변환 없이 정확한 타입만 입력받도록 강제하고 싶다면, PHP 파일의 최상단에 다음과 같은 지시어를 선언해야 합니다.

```php
declare(strict_types=1);
```

이 지시어가 선언된 파일 내부에서 함수를 호출할 때는 지정된 타입과 완전히 일치하는 값만 인자로 전달해야 하며, 일치하지 않을 경우 **`TypeError` 예외**를 즉시 유발하여 오류를 사전 방어합니다.

<br>

## 2. 매개변수 & 반환값 타입 지정
---
함수의 매개변수 앞쪽에는 허용할 타입을 정의하고, 소괄호 `)` 뒤에는 콜론 `:`과 함께 반환값(Return)의 타입을 지정할 수 있습니다.

예제 파일 types-01.php
```php
<?php
    // 파일 맨 위에 엄격한 검사 모드를 지시합니다.
    declare(strict_types=1);

    // int 매개변수 2개를 인자로 받아 최종 결과 int를 반환하는 안전한 연산 함수입니다.
    function sum(int $a, int $b): int {
        return $a + $b;
    }

    // 올바른 타입(int, int)을 전달하여 결과를 출력합니다.
    echo "5 + 10 = " . sum(5, 10) . "<br>"; // 출력: 5 + 10 = 15

    try {
        // strict_types 모드이므로 실수(5.5)를 인계 시 타입 컴파일 예외(TypeError)를 유발합니다.
        echo sum(5, 5.5); 
    } catch (TypeError $e) {
        // 타입 에러 예외 객체의 메시지를 한글 화면에 친근하게 표현합니다.
        echo "타입 에러 발생: " . $e->getMessage() . "<br>";
    }
?>
```

실행 결과
```text
5 + 10 = 15
타입 에러 발생: sum(): Argument #2 ($b) must be of type int, float given
```

<br>

## 3. 유니온 타입 (Union Types) 도입 (PHP 8.0)
---
PHP 7.x에서는 하나의 매개변수에 오직 한 가지 타입만 지정할 수 있었습니다. 이로 인해 정수와 실수 둘 다 허용해야 하거나, 특정 객체와 `null`을 동시에 받아야 하는 처리를 작성하기 곤란했습니다.

PHP 8.0에서는 여러 타입을 파이프라인 기호(`|`)로 연결하여 결합할 수 있는 **유니온 타입(Union Types)**이 등장했습니다.

|문법|
```php
function processNumber(int|float $num): int|float {
    return $num * 1.5;
}
```

예제 파일 types-02.php
```php
<?php
    declare(strict_types=1);

    class Calculator {
        // 정수(int) 또는 실수(float) 타입을 모두 수용하도록 유니온 타입 지정
        private int|float $value;

        // 반환하지 않으므로 void 타입 지정
        public function setValue(int|float $value): void {
            $this->value = $value;
        }

        // 정수 또는 실수가 반환됨을 명시
        public function getValue(): int|float {
            return $this->value;
        }
    }

    $calc = new Calculator();
    
    // 1. 정수 입력
    $calc->setValue(10);
    echo "정수 입력 결과: " . $calc->getValue() . "<br>"; // 출력: 정수 입력 결과: 10

    // 2. 실수 입력
    $calc->setValue(3.14);
    echo "실수 입력 결과: " . $calc->getValue() . "<br>"; // 출력: 실수 입력 결과: 3.14
?>
```

실행 결과
```text
정수 입력 결과: 10
실수 입력 결과: 3.14
```

<br>

## 4. 특수한 타입 지시어들
---

### 1) Nullable 타입 (`?Type`, PHP 7.1)
지정된 타입 외에 `null` 값도 허용하고 싶을 때 타입명 앞에 물음표(`?`)를 붙여 선언합니다.
- `?string`은 `string|null`과 완벽히 동일한 동작을 합니다.

### 2) void 타입 (PHP 7.1)
함수가 아무런 값도 반환하지 않고 동작만 수행함을 명시합니다. `void` 타입 함수 내에서 값을 반환하려고 시도하면 컴파일 에러를 유발합니다.
```php
// 값을 반환하지 않고 단순 로그를 기록하는 함수
function logMessage(string $msg): void {
    echo "[LOG] " . $msg;
    // return; 만 허용되며 return $value;는 불가능합니다.
}
```

### 3) mixed 타입 (PHP 8.0)
모든 종류의 데이터 타입을 다 수용할 수 있음을 정의합니다. 명시적으로 타입을 비워두는 것보다 "의도적으로 아무 타입이나 허용하겠다"는 의도를 깔끔하게 전달해 줍니다.
- `mixed` 타입은 내부적으로 `array|bool|callable|int|float|null|object|resource|string` 유니온 타입을 함축하고 있습니다.

### 4) never 타입 (PHP 8.1)
함수가 값을 반환하는 것 자체가 절대 불가능하고, 내부에서 실행을 중단(`exit`, `die`)하거나 예외(`throw`)를 던져 제어권을 영구히 상실시키는 특수한 반환 타입입니다.
```php
// 시스템 오동작 감지 시 프로세스를 안전 강제 중단하는 함수
function terminateSystem(): never {
    echo "시스템을 즉시 중단합니다.";
    exit; // 제어권을 반환하지 않고 즉시 종료되므로 never가 적용 가능합니다.
}
```

<br>

## 5. 최신 고급 타입 시스템 (PHP 8.1+)
---

PHP 8.x 버전이 성숙해지면서 타입 안정성을 극대화하기 위한 다양하고 정교한 타입 시스템이 추가되었습니다.

### 1) 교차 타입 (Intersection Types) — [PHP 8.1+]
유니온 타입(`|`)이 "A 또는 B 타입"을 허용하는 것과 반대로, **교차 타입(`&`)은 지정된 모든 타입을 동시에 만족(구현)하는 객체만** 허용합니다.
클래스 상속 구조나 인터페이스 다중 구현 시 특정 여러 개의 계약(Contract)을 동시에 준수하고 있는지 엄격하게 제어할 때 요긴합니다.

> [!NOTE]
> 스칼라 타입(`int`, `string` 등)은 서로 교차할 수 없으므로, 교차 타입은 오직 **클래스 및 인터페이스 타입**에만 사용 가능합니다.

예제:
{% raw %}
```php
interface Printable {
    public function printContent(): void;
}

interface Loggable {
    public function logMessage(): void;
}

// Printable과 Loggable을 동시에 구현한 객체만 인자로 받습니다.
function processDocument(Printable&Loggable $doc) {
    $doc->printContent();
    $doc->logMessage();
}
```
{% endraw %}

### 2) DNF 타입 (Disjunctive Normal Form Types) — [PHP 8.2+]
**DNF 타입**은 교차 타입(`&`)과 유니온 타입(`|`)을 결합하여 복잡한 타입 구조를 안전하게 제어할 수 있는 고급 타이핑 규칙입니다. DNF 타입 선언 시에는 반드시 교차 타입 단위를 소괄호 `()`로 묶어야 합니다.

예제:
{% raw %}
```php
interface Editable {}

// (Printable & Loggable) 타입의 객체이거나, 또는 Editable 타입의 객체여야 합니다.
function handleResource((Printable&Loggable)|Editable $resource) {
    // 처리 로직...
}
```
{% endraw %}

### 3) 독립형 true, false, null 타입 — [PHP 8.2+]
PHP 8.0 이전이나 유니온 타입 도입 초기에는 `true`, `false`, `null`은 단독 타입으로 지정할 수 없고 오직 다른 타입과의 결합형으로만 존재할 수 있었습니다.
**PHP 8.2부터는 이들 각각을 독립적인 단독(Standalone) 반환/매개변수 타입으로 선언**하여 엄격한 의도를 컴파일러에 전달할 수 있습니다.

예제:
{% raw %}
```php
class CustomLogger {
    // 오직 false만 반환할 수 있도록 반환 타입을 고정합니다.
    public function hasError(): false {
        return false;
    }
}
```
{% endraw %}

```