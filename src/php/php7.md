---
layout: php
title: "PHP 7.x 신규 문법 및 특징"
permalink: /php/php7/
description: "PHP 7.x에 새롭게 도입된 핵심 문법(타입 선언, Null 병합 연산자, 우주선 연산자 등)을 학습합니다."
keywords: "PHP 7, PHP 7.x, Null 병합 연산자, 우주선 연자, 익명 클래스, PHP 문법, jinydev"
---

# PHP 7.x 신규 문법 및 특징 🚀
---

PHP 7.0은 2015년 12월에 정식 릴리즈된 역사적인 메이저 업그레이드 버전입니다. 

기존의 PHP 5.x 대는 동적 스크립트 언어로서 높은 인기를 구가했으나, 대용량 트래픽을 처리할 때 발생하는 실행 엔진의 성능 한계와 동적 타이핑 특유의 런타임 불안정성으로 인해 극적인 전환이 필요한 시점이었습니다. PHP 7.x는 내부 실행 코어인 **Zend Engine 3(개발명 PHPNG - PHP Next Generation)**을 탑재하여 이전 버전(PHP 5.6) 대비 **최대 2배 이상의 비약적인 속도 향상**을 이루고 **메모리 자원을 50% 가까이 획기적으로 낮추는** 쾌거를 얻었습니다. 

이러한 혁신적인 코어 리팩토링 덕분에 PHP는 다시 한번 현대적 백엔드 기술로서 제2의 전성기를 달리게 되었습니다.

<br>

### 1. PHP 5.x 대와 PHP 7.x 대의 주요 차이점
---
아래 다이어그램은 성능 및 핵심 구문 문법 측면에서 구세대와 신세대 PHP가 어떻게 달라졌는지 한눈에 설명해 줍니다.

![PHP 5.6 vs PHP 7.x 세대 대변혁 비교](/php/img/php7_summary.svg)

<br>

### 2. 핵심 변경 사양 및 신규 문법 상세
---

#### 1) 스칼라 타입 & 반환값 타입 선언 🏷️
PHP는 전통적으로 변수 선언 시 타입을 묻지 않는 유연성을 특징으로 가졌지만, 이는 대규모 서비스나 협업 환경에서 버그 유발의 주요 원인이었습니다. PHP 7.x부터는 함수 호출과 응답에 엄격한 규칙을 세울 수 있습니다.

* **스칼라 타입 선언**: 함수의 매개변수 부분에 `int`, `float`, `string`, `bool` 타입을 강제할 수 있습니다.
* **반환값 타입 선언**: 함수가 최종 계산 후 리턴해야 하는 값의 데이터 타입을 보장합니다.

```php
declare(strict_types=1); // 이 지시어를 파일 최상단에 기재하여 엄격한 타입 검사 모드를 강제합니다.

function add(int $a, int $b): int {
    return $a + $b; // 반드시 int 값이 반환됨을 정적으로 보장
}

echo add(10, 20); // 30 출력
// echo add(10.5, 20); // float 인자가 주입되었으므로 즉각 TypeError 발생!
```

<br>

#### 2) Null 병합 연산자 (Null Coalescing Operator `??`) 🔗
사용자 요청 파라미터나 변수가 존재하지 않을 때 디폴트 기본값을 바인딩해 주던 장황한 3항 연산 식을 단축 연산 기호 `??`로 깔끔하게 압축합니다.

* **PHP 5.6 이전**: `$user = isset($_GET['name']) ? $_GET['name'] : 'Guest';`
* **PHP 7.0 이후**: `$user = $_GET['name'] ?? 'Guest';`

```php
// 여러 개의 체이닝 처리가 가능하며, 가장 먼저 셋팅된 유효 값을 찾아 반환합니다.
$username = $_GET['name'] ?? $_POST['name'] ?? 'Guest';
```

<br>

#### 3) 우주선 연산자 (Spaceship Operator `<=>`) 🛸
두 값을 대소 비교하여 세 가지 분기 상태(`-1`, `0`, `1`)를 정수 타입으로 반환합니다. 복잡한 정렬 규칙(usort)을 정의해야 하는 정렬 루틴에서 가독성과 코드 효율을 대폭 향상시켜 줍니다.

* `$a <=> $b` 선언
  - `$a`가 `$b`보다 작을 때: `-1`
  - `$a`와 `$b`가 같을 때: `0`
  - `$a`가 `$b`보다 클 때: `1`

```php
echo 10 <=> 20; // -1
echo 10 <=> 10; // 0
echo 20 <=> 10; // 1

// 배열 정렬 콜백에서의 사용 예시
$data = [5, 2, 9, 1];
usort($data, function($a, $b) {
    return $a <=> $b; // 단 한 줄로 깔끔한 오름차순 정렬 처리 완료
});
```

<br>

#### 4) 익명 클래스 (Anonymous Classes) 🎭
프로그램이 가동되는 도중 한 번만 임시로 사용하고 버릴 클래스의 인스턴스를 이름 정의(class name) 없이 런타임에 즉석에서 생성하는 모던 문법을 지원합니다.

```php
interface Mailer {
    public function send(string $to, string $body);
}

// 별도의 클래스 파일을 생성하지 않고 임시 인터페이스 구현체를 즉석 생성
$mockMailer = new class implements Mailer {
    public function send(string $to, string $body) {
        echo "임시 전송 테스트: To [{$to}] - Body: {$body}";
    }
};

$mockMailer->send("jiny@jiny.dev", "Hello PHP 7");
```

<br>

#### 5) 상수 배열 선언 (`define()` 지원) 📦
PHP 5.6 이전에는 상수 선언 시 `const` 키워드 내에서만 배열의 대입이 허용되었으나, PHP 7.x부터는 런타임 상수로 동작하는 `define()` 함수 매핑 인자 값으로도 다차원 배열 상수 선언이 전면 지원됩니다.

```php
define('DATABASE_SETTING', [
    'host' => '127.0.0.1',
    'user' => 'admin',
    'pass' => 'secret_password',
    'port' => 3306
]);

echo DATABASE_SETTING['user']; // admin 출력
```

<br><br>
