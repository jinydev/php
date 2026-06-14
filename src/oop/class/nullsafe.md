---
layout: php
title: "Nullsafe 연산자 (?->) - PHP 프로그래밍"
breadcrumb:
- "oop"
- "class"
- "nullsafe"
---

# Nullsafe 연산자 (Nullsafe Operator)
---
객체지향 프로그래밍에서 여러 객체 간의 관계를 엮어 상호작용할 때, 하나의 객체 내부에 포함된 다른 하위 객체들의 속성이나 메서드에 점진적으로 접근하는 체이닝(Chaining) 기법을 흔히 사용합니다.

그러나 이 체이닝의 단계 중 단 하나라도 `null` 값을 가지는 객체가 포함되어 있다면, 프로그램은 즉시 예외(NullPointerException 크래시)를 유발하며 중단됩니다. 이를 막기 위해 장황하게 null 방어막을 쳐야 했습니다.

PHP 8.0부터는 이러한 불안 요소를 우아하고 깔끔하게 종식해 주는 **Nullsafe 연산자(`?->`)**를 제공합니다.

<br>

## 1. 다중 객체 탐색에서의 Null 예외 방어의 난해함 (PHP 7)
---
사용자 세션 객체에서 주소 정보를 꺼내오고, 주소에서 국가명(Country)을 조회하는 다음의 구조를 생각해 봅니다.

```
[Session] ➡️ [User] ➡️ [Address] ➡️ getCountry()
```

만약 비회원이어서 User가 없거나, 주소를 아직 등록하지 않아 Address가 `null`일 수 있는 상황을 가정해 보겠습니다. PHP 7.x 이하에서 런타임 오류를 방지하기 위해 다음과 같이 첩첩이 `if` 조건문을 사용하여 null 체크를 수행해야 했습니다.

```php
$country = null;

if ($session !== null) {
    $user = $session->getUser();
    if ($user !== null) {
        $address = $user->getAddress();
        if ($address !== null) {
            $country = $address->getCountry();
        }
    }
}
```

이 중첩 조건문 구조(일명 파라오의 피라미드)는 비즈니스 핵심 흐름보다 null 체크용 제어 구문이 소스 코드의 대부분을 차지하여 가독성을 극심하게 해칩니다.

<br>

## 2. Nullsafe 연산자 (`?->`) 동작 원리 (PHP 8)
---
PHP 8.0의 Nullsafe 연산자 `?->`를 사용하면 복잡한 중첩 null 판별 조건식을 단 한 줄로 명쾌하게 정리할 수 있습니다.

![Nullsafe 연산자 흐름도](./img/nullsafe_flow.svg)

|문법|
```php
$country = $session?->getUser()?->getAddress()?->getCountry();
```

동작 방식은 다음과 같습니다:
1. 연쇄 호출 경로 중 임의의 시점에서 피연산자가 `null`인 경우, 이후의 전체 호출을 즉시 평가 중단(Short-circuiting)하고 최종 결과로 **`null`**을 조용히 반환합니다.
2. 피연산자가 `null`이 아닌 유효한 객체인 경우, 기존 객체 접근 연산자(`->`)와 완전하게 동일한 속성/메서드 호출을 수행합니다.

예제 파일 nullsafe-01.php
```php
<?php
    class Address {
        public function getCountry(): string { return "South Korea"; }
    }

    class User {
        // null이 허용되는 주소(?Address) 속성입니다. 초기값은 null입니다.
        private ?Address $address = null;

        public function setAddress(?Address $address) { $this->address = $address; }
        public function getAddress(): ?Address { return $this->address; }
    }

    // 1. 주소 정보가 등록되지 않은(null) 유저를 생성합니다.
    $userWithoutAddress = new User();

    // Nullsafe 연산자를 사용하므로, getAddress()가 null을 반환하는 순간 
    // 그 다음 getCountry() 호출을 생략하고 안전하게 null을 반환합니다.
    $country = $userWithoutAddress->getAddress()?->getCountry();

    echo "결과 1 (주소 없음): ";
    var_dump($country); // 출력: NULL
    echo "<br>";

    // 2. 유효한 주소를 등록한 유저의 주소를 조회합니다.
    $userWithAddress = new User();
    $userWithAddress->setAddress(new Address());
    
    // 이 경우 getAddress()가 Address 객체를 정상 반환하므로 getCountry()까지 끝까지 정상 접근합니다.
    $country = $userWithAddress->getAddress()?->getCountry();

    echo "결과 2 (주소 있음): ";
    var_dump($country); // 출력: string(11) "South Korea"
?>
```

실행 결과
```text
결과 1 (주소 없음): NULL
결과 2 (주소 있음): string(11) "South Korea"
```

<br>

## 3. 사용 시 주의사항 및 대입 금지 규칙
---

### 1) 쓰기(대입) 연산자로 사용 불가능
Nullsafe 연산자는 값을 읽어오거나(Read) 메서드를 실행하는 구문에서는 완벽히 기능하지만, 속성에 값을 대입하는(Write) 연산자 좌항에서는 사용할 수 없습니다.

```php
// ❌ 에러 발생! 값을 대입하는 연산의 대상으로는 Nullsafe(?->)를 적용할 수 없습니다.
// $user?->name = '홍길동'; 
```

에러 발생 결과
```text
Fatal error: Can't use nullsafe operator in write context
```

### 2) 참조 형식과의 호환 불가
참조를 반환하는 메서드나 값을 바인딩하는 구문에서는 Nullsafe 연산자를 엮을 수 없습니다. 오직 안전한 값 추출 용도로만 제한적으로 활용하는 것을 권장합니다.

Nullsafe 연산자는 앞서 배운 Null 병합 연산자 `??`와 결합하면 더욱 강력한 방어 로직을 생성할 수 있습니다.
```php
// 국가명이 없거나 null 단계를 거치면 'Default Country'를 기본값으로 지정
$country = $session?->getUser()?->getAddress()?->getCountry() ?? 'Default Country';
```
