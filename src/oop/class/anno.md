---
layout: php
title: "익명 클래스 (Anonymous Classes) - PHP 프로그래밍"
breadcrumb:
- "oop"
- "class"
- "anno"
---

# 익명 클래스 (Anonymous Classes)
---
일반적으로 객체지향 프로그래밍에서는 클래스라는 명확한 설계 도면을 미리 정의하고, 이를 기반으로 `new` 키워드를 사용하여 실시간 메모리에 인스턴스(객체)를 복제하여 사용합니다.

그러나 프로그램 동작 도중 **"단 한 번만 사용하고 재사용할 계획이 없는 일회성 객체"**를 위해 매번 새로운 물리적 클래스 파일을 만들고 선언하는 것은 리소스 낭비이자 코드 설계의 복잡도를 높이는 원인이 됩니다.

PHP 7.0부터는 클래스 명칭을 사전에 정의하지 않고 즉석에서 실시간 인스턴스화하여 임시로 사용할 수 있는 **익명 클래스(Anonymous Classes)**를 지원합니다.

<br>

## 1. 익명 클래스 선언 문법
---
익명 클래스는 `new class` 구문을 사용하여 즉석에서 필요한 상속 및 인터페이스 구현체 코드를 구성합니다.

|문법|
```php
$instance = new class {
    public function doSomething() {
        // 일회성 로직 수행...
    }
};
```

익명 클래스는 일반 클래스와 동일하게 생성자(`__construct`)를 가질 수 있으며, 매개변수를 넘겨받는 것도 지원합니다.

예제 파일 anonymous-01.php
```php
<?php
    // 즉석에서 1회성 객체 생성 및 인자 주입
    $temporaryUser = new class('홍길동', 30) {
        private string $name;
        private int $age;

        public function __construct(string $name, int $age) {
            $this->name = $name;
            $this->age = $age;
        }

        public function printInfo() {
            echo "임시 사용자 이름: " . $this->name . " (나이: " . $this->age . ")<br>";
        }
    };

    $temporaryUser->printInfo();
?>
```

실행 결과
```text
임시 사용자 이름: 홍길동 (나이: 30)
```

<br>

## 2. 인터페이스 및 상속 결합 (implements & extends)
---
익명 클래스의 가장 강력한 면모는 특정 인터페이스(Interface)를 즉석에서 통과시키거나, 기존 부모 클래스를 즉시 확장하여 다형성을 충족해야 하는 경우에 나타냅니다.

![익명 클래스 주입 구조도](./img/anno_flow.svg)

예제 파일 anonymous-02.php
```php
<?php
    // 공통 로깅 인터페이스 정의
    interface Logger {
        public function log(string $message): void;
    }

    class Application {
        private Logger $logger;

        // Logger 인터페이스를 구현하는 모든 객체를 주입받는 세터 메서드
        public function setLogger(Logger $logger) {
            $this->logger = $logger;
        }

        public function run() {
            $this->logger->log("어플리케이션이 실행되었습니다.");
        }
    }

    $app = new Application();

    // Logger 인터페이스를 별도의 클래스 파일 생성 없이 즉석 구현(implements)하여 
    // 일회성 인스턴스 형태로 setLogger() 메서드 매개변수에 주입합니다.
    $app->setLogger(new class implements Logger {
        public function log(string $message): void {
            // 주입된 익명 클래스의 실제 비즈니스 로직 실행
            echo "[LOGGING]: " . $message . " (시간: " . date('Y-m-d') . ")<br>";
        }
    });

    $app->run();
?>
```

실행 결과
```text
[LOGGING]: 어플리케이션이 실행되었습니다. (시간: 2026-06-13)
```

<br>

## 3. 실무에서의 활용 분야
---

### 1) 단위 테스트 (Unit Testing)의 Mocking
테스트 코드를 작성할 때, 특정 외부 API 인터페이스를 테스트 환경에 맞게 대체하는 모의(Mock) 객체를 즉석에서 가짜로 정의하고 동작시킬 수 있어 매우 유용합니다.

### 2) 일회성 이벤트 리스너 및 콜백
특정 이벤트가 발송될 때 한 번 실행되고 소멸할 콜백 리스너 객체를 전달할 때, 코드 응집도를 비약적으로 극대화할 수 있습니다.

익명 클래스는 겉보기에 이름이 없지만, PHP 내부적으로는 고유한 가상의 주소 기반 임시 클래스명을 생성하여 관리하므로 타입 판별(`instanceof`) 등 객체지향의 모든 속성을 완전하게 충족합니다.
