---
layout: php
title: "생성자 프로퍼티 프로모션 (Constructor Property Promotion) - PHP 프로그래밍"
breadcrumb:
- "oop"
- "class"
- "constructor-promotion"
---

# 생성자 프로퍼티 프로모션 (Constructor Property Promotion)
---
객체지향 설계에서 클래스를 만들 때 가장 자주 작성하지만 무의미하게 반복적인 타이핑을 유발하는 부분이 바로 **"속성(Property) 선언과 생성자(Constructor) 초기화 대입"** 로직입니다. 멤버 속성이 많아질수록 클래스의 선언 영역은 불필요하게 늘어나고 가독성이 떨어집니다.

PHP 8.0부터는 이러한 상투적인 보일러플레이트(Boilerplate) 코드를 획기적으로 줄이고 선언을 간소화해 주는 **생성자 프로퍼티 프로모션(Constructor Property Promotion, 생성자 속성 승진)** 문법을 전격 지원합니다.

<br>

## 1. 기존 방식의 상투적 중복 코드 (PHP 7)
---
PHP 7.x 이하에서 하나의 객체 멤버를 생성하고 초기화하기 위해서는 다음의 **3단계 과정**을 반드시 거쳐야 했습니다:
1. 클래스 상단에 속성(Property) 정의
2. 생성자 매개변수(Parameter)에 인수 선언
3. 생성자 메서드 몸체 내부에서 대입 연산 (`$this->name = $name`) 수행

```php
class User {
    // 1단계: 멤버 속성 명시 선언
    public string $name;
    public int $age;
    public string $email;

    // 2단계: 생성자 매개변수로 인수 전달
    public function __construct(string $name, int $age, string $email) {
        // 3단계: 대입 바인딩 처리
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
}
```

이 코드는 속성명이 `name`, `age`, `email`로 각각 무려 3번씩 중복되어 노출됩니다. 속성이 10개가 된다면 이 중복은 30번으로 늘어나며 코드가 매우 비대해집니다.

<br>

## 2. 생성자 프로퍼티 프로모션 규칙 (PHP 8)
---
PHP 8.0의 생성자 프로퍼티 프로모션을 사용하면 클래스 멤버 선언과 생성자의 매핑 대입을 하나의 과정으로 압축하여 선언할 수 있습니다. 

![생성자 속성 승진 비교도](./img/constructor_promotion_flow.svg)

생성자 매개변수 앞에 **접근 제어자(`public`, `protected`, `private`)**를 붙여 선언하기만 하면, PHP 엔진이 런타임에 속성 선언과 대입 연산을 자동으로 수행합니다.

|문법|
```php
class User {
    // 생성자 인수 앞에 접근 제어자만 명시하면 속성 정의와 대입이 즉시 완료됩니다!
    public function __construct(
        public string $name,
        protected int $age,
        private string $email
    ) {}

    public function getDetails(): string {
        // 내부 private, protected 속성도 일반 속성과 완전히 동일하게 사용합니다.
        return "이름: {$this->name}, 나이: {$this->age}, 이메일: {$this->email}";
    }
}

// 런타임 인스턴스 생성 및 메서드 테스트
$user = new User('홍길동', 25, 'hong@example.com');
echo $user->getDetails();
```

실행 결과
```text
이름: 홍길동, 나이: 25, 이메일: hong@example.com
```

이전 코드와 완벽하게 동일한 구조를 가지지만, 속성을 중복하여 정의하지 않아 클래스의 코드 크기가 획기적으로 줄고 가독성이 엄청나게 향상된 것을 알 수 있습니다. 생성자 몸체인 `{}` 부분은 비어있어도 무방하며, 추가적인 비즈니스 로직 검증이 필요하다면 내부에 내용을 작성할 수도 있습니다.

<br>

## 3. 세부 작동 규칙 및 조건
---

### 1) 반드시 접근 제어자를 지정해야 함
속성을 자동으로 승진시키기 위해서는 매개변수 앞에 `public`, `protected`, `private` 중 하나를 반드시 명시해야 합니다. 만약 접근 제어자 없이 타입과 변수명만 선언한다면, 그것은 기존의 일반적인 로컬 생성자 매개변수로 작동합니다.

```php
class Point {
    // x는 자동으로 속성 등록됨, y는 일반 매개변수로만 기능함
    public function __construct(public float $x, float $y) {
        // y는 속성으로 대입해주어야 합니다.
    }
}
```

### 2) 타입 힌팅과 Nullable 연계 가능
승진 속성 또한 강제할 타입과 Nullable 기호(`?`) 혹은 기본값을 결합할 수 있습니다.

```php
class Config {
    public function __construct(
        public string $host = 'localhost',
        public ?int $port = null
    ) {}
}
```

### 3) 중복 선언 금지
생성자에서 승진시킨 매개변수 이름을 클래스 본문 속성명으로 다시 한 번 명시적으로 정의할 수는 없습니다. 중복 선언 시 구문 컴파일 오류가 발생합니다.

```php
class BadClass {
    // ❌ 에러! 생성자 매개변수에서 이미 승진 속성으로 정의하여 자동 등록되는데, 
    // 동일한 이름을 가진 멤버 변수를 명시적으로 또 중복 선언했습니다.
    public string $name; 

    public function __construct(public string $name) {}
}
```

에러 발생 결과
```text
Fatal error: Cannot declare promoted property BadClass::$name; a non-promoted property with the same name already exists
```
생성자 프로퍼티 프로모션은 모던 PHP 프레임워크(Laravel 9+, Symfony 등)에서 의존성 주입(Dependency Injection)과 DTO(Data Transfer Object)를 정의할 때 압도적으로 자주 쓰이는 기법입니다.
