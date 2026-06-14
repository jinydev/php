---
layout: php
title: "PHP 8.x 신규 문법 및 특징"
permalink: /php/php8/
description: "PHP 8.x에 새롭게 도입된 혁신적인 기능(JIT 컴파일러, 네임드 인자, 생성자 프로모션, Match 표현식 등)을 학습합니다."
keywords: "PHP 8, PHP 8.x, JIT 컴파일러, 네임드 인자, 생성자 프로모션, Match 표현식, Nullsafe 연산자, jinydev"
---

# PHP 8.x 신규 문법 및 특징 🚀
---

PHP 8.0은 2020년 11월에 릴리즈되어 엔진과 언어 설계 관점에서 제2의 대격변을 몰고 온 메이저 업데이트 버전입니다. 

그간 인터프리터 언어가 가져왔던 연산 속도 병목을 물리적으로 돌파하는 **JIT(Just-In-Time) 컴파일러**가 엔진 내부에 전격 이식되었으며, 정적 타입 선언, 클래스 설계의 불변성(Immutability) 지원, 그리고 보일러플레이트 코드를 줄여주는 다양한 단축 문법들이 대거 탑재되었습니다. 현재 PHP는 최신 버전인 **8.5**에 이르기까지 모던 언어 사양을 더욱 공고히 완성해 나가고 있습니다.

<br>

### 1. PHP 8.0 ~ 8.5 로드맵 구조도
---
아래 다이어그램은 PHP 8.x 릴리즈 계보에 따라 새롭게 추가된 주요 기술 영역별 핵심 이정표를 나타냅니다.

![PHP 8.0 ~ 8.5 메이저 혁신 및 로드맵](/php/img/php8_features.svg)

<br>

### 2. 버전별 대표적인 핵심 문법 및 혁신
---

#### 1) JIT (Just-In-Time) 컴파일러 탑재 — [PHP 8.0+]
Zend VM 가상머신이 컴파일해 둔 오피코드(Opcode)를 중간 단계에서 CPU가 바로 처리할 수 있는 기계어 명령(x86, ARM 등)으로 런타임에 직접 번역해 주는 JIT 컴파일러가 장착되었습니다. 웹서버 성능뿐만 아니라 대용량 데이터 계산, 수학 연산 처리 영역에서 엄청난 속도 가속을 보여줍니다.

<br>

#### 2) 네임드 인자 (Named Arguments) — [PHP 8.0+]
함수 호출 시 인수 전달 순서에 얽매이지 않고 매개변수의 이름을 지정하여 직접 데이터를 매핑하는 문법입니다.
```php
// 중간에 많은 디폴트 기본값 매개변수가 있는 경우에도 원하는 변수명만 콕 집어 입력 가능
buildProfile(age: 28, name: "이호진", country: "US");
```

<br>

#### 3) 생성자 프로퍼티 프로모션 — [PHP 8.0+]
클래스의 프로퍼티 선언부 정의와 생성자의 매개변수 선언, 그리고 초기화 대입 바인딩 코드를 단 한 줄로 축소하는 효율적인 문법입니다.
```php
class Point {
    // 생성자 인수 앞에 public/private 등을 지정하면 런타임에 속성 등록과 대입이 자동 완료됨
    public function __construct(public float $x, public float $y) {}
}
```

<br>

#### 4) Match 표현식 (Match Expression) — [PHP 8.0+]
장황한 switch 문을 간소화한 연산 평가식입니다. 느슨한 비교(`==`)가 아닌 **엄격한 비교(`===`)**를 수행하며, 분기 결과를 변수에 즉시 반환 대입할 수 있고 `break;` 누락 에러를 미연에 차단합니다.
```php
$message = match ($statusCode) {
    200, 201 => '성공',
    404 => '페이지 없음',
    default => '알 수 없는 상태'
};
```

<br>

#### 5) Nullsafe 연산자 (`?->`) — [PHP 8.0+]
다중 객체 속성 체이닝 조회 시, 중간 객체 값이 `null`이어도 예외 에러 없이 전체를 `null`로 안전히 리턴해 주는 가드 연산자입니다.
```php
// 중간에 user가 null이거나 session이 null이어도 에러 없이 null 반환
$country = $session?->user?->getCountry();
```

<br>

#### 6) 유니온 타입 (Union Types) — [PHP 8.0+]
변수나 메서드 매개변수, 반환값에 여러 타입을 동시에 허용하도록 하는 정적 타이핑 기술입니다.
```php
class DataPool {
    // int 또는 float 형식만 가질 수 있도록 강제
    private int|float $score;
}
```

<br>

#### 7) 내장 열거형 지원 (Enums) — [PHP 8.1+]
기존의 가짜 상수 세트나 특수 라이브러리 없이, 컴파일러 레벨에서 엄격히 검증 가능한 독립 데이터 형식인 **열거형(Enum)**을 공식 지원합니다.
```php
enum Status: string {
    case Pending = 'pending';
    case Active = 'active';
    case Rejected = 'rejected';
}
```

<br>

#### 8) 읽기 전용 프로퍼티 & 클래스 — [PHP 8.1+ / 8.2+]
생성 이후 어떠한 상태 변형도 일어나지 않는 불변성(Immutability) 처리를 엔진에서 직접 통제합니다.
* **PHP 8.1+**: `public readonly string $uid;` (최초 1회 생성자 초기화 후 수정 불가)
* **PHP 8.2+**: `readonly class UserDto { ... }` (클래스 내 모든 속성이 자동으로 readonly화 됨)

<br>

#### 9) 타입 지정 클래스 상수 (Typed Class Constants) — [PHP 8.3+]
클래스 상수가 부적절한 데이터 타입으로 오버라이딩되어 발생하는 버그를 예방하기 위해, 상수 자체에도 데이터 타입을 강제할 수 있습니다.
```php
class Application {
    public const string VERSION = "2.5.0";
}
```

<br>

#### 10) 프로퍼티 훅 (Property Hooks) — [PHP 8.4+]
프로퍼티 값을 읽거나 쓸 때 별도의 게터(Getter) 및 세터(Setter) 메서드를 번거롭게 선언하지 않고, 프로퍼티 몸체 내에 바로 검증/가공 로직을 훅 형태로 탑재하는 모던 사양입니다.
```php
class User {
    // 프로퍼티 내부에 바로 get, set 처리기를 장착합니다.
    public string $name {
        set => trim(strtoupper($value));
        get => "Mr. " . $this->name;
    }
}
```

<br>

#### 11) 비대칭 가시성 (Asymmetric Visibility) — [PHP 8.4+]
값의 조회(Read) 권한과 쓰기(Write) 권한의 가시성을 다르게 셋팅할 수 있어 외부 불변성과 내부 자율성을 보장합니다.
```php
class Book {
    // 조회는 외부 누구나 가능하나, 값 수정은 private 범위 안에서만 가능하도록 설정
    public private(set) string $title;
}
```

<br>

#### 12) 괄호 생략 인스턴스 체이닝 & PHP 8.5 최적화 — [PHP 8.4+ / 8.5+]
* **PHP 8.4+**: `new` 연산자로 생성된 임시 인스턴스 뒤에 괄호 없이 멤버를 즉시 체이닝 호출할 수 있는 편의를 제공합니다. (`new User()->getName()`)
* **PHP 8.5+**: 타입 결합도 검사 가속화, 메모리 소모 극대화 방지, 그리고 JIT 컴파일러 번역 가속 등 엔진 내부 연산 최적화가 지속 보강되었습니다.

<br><br>
