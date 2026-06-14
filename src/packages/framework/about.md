---
layout: php
title: "웹 프레임워크 및 라라벨 소개"
keyword: "php framework, web framework, framework definition, library vs framework, IoC, Inversion of Control, CoC, Dependency Injection"
description: "웹 애플리케이션 프레임워크의 상세 개념과 라이브러리와의 근본적 아키텍처 차이, 제어의 역전(IoC), 설정보다 규약(CoC) 및 의존성 주입(DI)의 기술적 코드를 학습합니다."
breadcrumb:
- packages
- framework
- about
---

# 1. 프레임워크란 무엇인가?
---
웹 개발 분야에서 애플리케이션의 규모가 확장되고 다수의 인원이 공동 작업을 진행할 때, 개발 품질의 상향 평준화와 빠른 릴리스를 달성하기 위해 도입하는 도구가 바로 **웹 프레임워크(Web Framework)**입니다. 

이 문서에서는 프레임워크의 본질적인 기술 사양과 제어의 역전(IoC), 설정보다 규약(CoC), 그리고 라이브러리와의 아키텍처적 차이점을 실무 PHP 코드를 통해 알아봅니다.

<br>

## 1.1 소프트웨어 프레임워크의 정의
소프트웨어 프레임워크는 특정 종류의 소프트웨어를 개발할 때 기초가 되는 정형화된 코드 설계 골격과 공통 기반 설비(Infrastructure)를 제공하는 **세미완성형(Semi-complete) 소프트웨어 뼈대**입니다.
* 개발자는 빈 도화지에서 코딩을 시작하는 것이 아니라, 이미 설계 원칙과 기본 환경(세션 처리, 데이터 연결, 가상 경로 매핑 등)이 완성된 구조체 위에서 해당 프로젝트만의 특수한 비즈니스 로직(Business Logic)을 개발하게 됩니다.

### 설정보다 규약 (CoC, Convention over Configuration)
현대 웹 프레임워크(특히 Laravel, Ruby on Rails 등)를 관통하는 핵심 철학 중 하나는 **설정보다 규약(CoC)**입니다.
* 과거의 프레임워크들은 데이터베이스 테이블 매핑, 라우팅 경로, 컴포넌트 간 관계를 조율하기 위해 방대한 양의 XML이나 JSON 설정 파일을 수동으로 기재해야 했습니다.
* CoC 철학 하에서는 개발자가 프레임워크가 제시한 **네이밍 규칙(Convention)**을 준수하면, 별도의 설정 파일 없이도 프레임워크가 알아서 부품들을 찾아 연결합니다.
* *예시*: 모델 클래스명이 `User`라면 데이터베이스 테이블명은 자동으로 복수형인 `users`에 매핑되고, 기본키는 `id` 컬럼으로 자동 유추됩니다. 이를 통해 개발자는 설정 지옥에서 벗어나 코드 자체에만 집중할 수 있습니다.

<br>

## 1.2 라이브러리(Library) vs 프레임워크(Framework)
많은 초보 개발자가 라이브러리와 프레임워크를 단순한 크기 차이나 패키지 결합 구조의 차이로 생각하곤 합니다. 그러나 둘의 진짜 구분 기준은 코드 실행 제어권의 주체가 누구에게 있는가인 **제어의 역전(IoC, Inversion of Control)**에 있습니다.

```text
+-------------------------------------------------------------+
| [도서관 모델] 라이브러리 (Library)                          |
|                                                             |
|   나의 애플리케이션 코드 =================> 외부 라이브러리   |
|   (개발자가 주체가 되어 필요할 때마다 함수 호출)             |
+-------------------------------------------------------------+

+-------------------------------------------------------------+
| [공장 컨베이어 벨트] 프레임워크 (Framework)                 |
|                                                             |
|   프레임워크 코어 엔진 ==================> 개발자의 컨트롤러  |
|   (프레임워크가 구동 흐름을 쥐고 있다가 개발자 함수 호출)   |
+-------------------------------------------------------------+
```

### 1.2.1 라이브러리 (Library): 개발자가 주도하는 제어 흐름
라이브러리는 개발자가 프로그램의 주도권을 100% 쥐고 동작시킵니다. 개발자는 자신이 작성한 프로그램 안에서 필요할 때마다 외부 기능을 적극적으로 불러와서(Call) 사용합니다.

```php
<?php
// [라이브러리 방식 예시]
// 개발자가 메인 실행 흐름을 지배하며, 필요 시점에 직접 객체를 만들어 호출합니다.
require_once 'vendor/autoload.php';

use Carbon\Carbon; // 날짜 계산 라이브러리

class CustomApplication 
{
    public function run() 
    {
        echo "애플리케이션이 구동 중입니다...\n";

        // 개발자가 필요한 시점에 라이브러리 객체를 직접 인스턴스화하고 조종함
        $now = Carbon::now();
        $threeDaysLater = $now->addDays(3);

        echo "배송 예정일: " . $threeDaysLater->toDateString() . "\n";
    }
}

$app = new CustomApplication();
$app->run();
?>
```

### 1.2.2 프레임워크 (Framework): 프레임워크 엔진이 주도하는 제어 흐름
프레임워크는 프레임워크 엔진 자체가 프로세스의 거대한 메인 흐름을 시작하고 제어합니다. 개발자는 프레임워크가 규정한 특정 자리에 규격에 맞는 조각 코드(클래스 및 메서드)를 꽂아 넣을 뿐입니다. 그러면 프레임워크가 적절한 시점에 개발자의 코드를 자동으로 콜백(Callback) 호출합니다.

이러한 작동 원리를 소프트웨어 공학에서는 **헐리우드 원칙(Hollywood Principle)**이라고 부릅니다.
> *"우리에게 먼저 전화하지 마세요. 필요하다면 저희가 당신에게 연락하겠습니다." (Don't call us, we'll call you)*

```php
<?php
// [프레임워크 방식 예시]
// 개발자는 이 스크립트를 직접 실행(run)하지 않습니다. 
// 프레임워크 엔진이 부팅된 후, 라우팅 일치 시점에 이 show() 메서드를 자동으로 기동(Callback)합니다.
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // 프레임워크가 HTTP 요청을 수집, 파싱한 뒤 매개변수 $id와 함께 이 메서드를 강제로 호출함
    public function show(int $id)
    {
        // 비즈니스 로직 조각만 채워 넣음
        $post = \App\Models\Post::find($id);

        return view('post.show', ['post' => $post]);
    }
}
?>
```

<br>

## 1.3 제어의 역전 (IoC)과 의존성 주입 (DI)
제어의 역전(IoC)은 부품(클래스) 간의 결합도를 낮추고 테스트 이식성을 늘리기 위해 객체의 생명주기 관리 권한을 시스템(프레임워크)에 위임하는 객체지향 설계 원칙입니다. 이를 구체적으로 실현하는 대표적인 기술적 수단이 **의존성 주입(DI, Dependency Injection)**입니다.

### 1.3.1 의존성 결합 문제 (Direct Coupling)
전통적인 코딩 방식에서는 사용할 대상 객체를 클래스 내부에서 `new` 키워드로 직접 생성했습니다. 이는 두 클래스를 강하게 결합(Tightly Coupled)시켜 유연성을 해칩니다.

```php
<?php
// [강결합 구조]
class EmailSender 
{
    public function send(string $message) { /* 이메일 전송 로직 */ }
}

class MemberService 
{
    private EmailSender $sender;

    public function __construct() 
    {
        // 클래스 내부에서 특정 구현체 객체를 직접 생성 -> 강결합 발생!
        // 만약 SMS 전송 객체로 바꾸려면 이 클래스의 소스코드 자체를 뜯어고쳐야 합니다.
        $this->sender = new EmailSender();
    }

    public function join() 
    {
        $this->sender->send("회원가입 환영메시지");
    }
}
?>
```

### 1.3.2 의존성 주입을 통한 해결 (Dependency Injection)
의존성 주입을 구현하면, 클래스는 자신이 사용할 실제 구체 클래스 타입을 알지 못하더라도 인터페이스 규약에만 의존하며, 외부(IoC 컨테이너)로부터 생성된 인스턴스를 주입받아 동작합니다.

```php
<?php
// 1. 공통 인터페이스 선언
interface MessageSenderInterface 
{
    public function send(string $message): void;
}

// 2. 구현체 분리
class EmailSender implements MessageSenderInterface 
{
    public function send(string $message): void { /* 이메일 발송 */ }
}

class SmsSender implements MessageSenderInterface 
{
    public function send(string $message): void { /* SMS 발송 */ }
}

// 3. 의존성 주입 대상 클래스
class MemberService 
{
    private MessageSenderInterface $sender;

    // 생성자 주입 (Constructor Injection)
    // new 키워드를 배제하고 외부에서 객체를 꽂아주도록 설계
    public function __construct(MessageSenderInterface $sender) 
    {
        $this->sender = $sender;
    }

    public function join() 
    {
        $this->sender->send("회원가입 완료!");
    }
}

// [프레임워크 내부 실행 흐름 시뮬레이션]
// 프레임워크의 의존성 컨테이너가 실행 환경에 맞게 의존 객체를 조립해 줍니다.
$realSender = new SmsSender(); // 또는 new EmailSender();
$service = new MemberService($realSender); // 주입(DI)
$service->join();
?>
```
이러한 IoC/DI 처리를 자동으로 대행해 주는 프레임워크 내부 모듈을 **IoC 컨테이너(또는 서비스 컨테이너)**라고 부르며, 이로 인해 유닛 테스트와 결합도 제거가 비약적으로 쉬워집니다.

<br>

## 1.4 프레임워크 도입의 장단점
프레임워크는 양날의 검과 같아 프로젝트의 비즈니스 규모에 맞게 알맞은 전략으로 채택해야 합니다.

### 1.4.1 핵심 장점
* **신속한 생산성 확보**: DB 드라이버, 메일 발송, 파일 보관소 등 웹 서비스에 필요한 범용 모듈이 내장되어 초기 셋업 시간이 극단적으로 줄어듭니다.
* **디자인 패턴 강제**: MVC 패턴 등이 아키텍처 레벨에서 강제되므로 다수의 공동 개발 과정에서 소스 코드의 위치와 파일 형식이 일관되게 유지됩니다.
* **통합 보안 체계**: SQL 인젝션, CSRF(사이트 간 요청 위조), XSS(크로스 사이트 스크립팅) 등 3대 보안 위협에 대한 필터링 방어선이 프레임워크 커널 레벨에 사전 내장되어 있어 인적 실수로 인한 보안 사고를 막아줍니다.

### 1.4.2 고려해야 할 단점
* **높은 학습 곡선 (Learning Curve)**: 프레임워크 고유의 네이밍 룰, 구동 주기, 독자적인 쿼리 빌더 및 템플릿 문법을 깊이 있게 공부해야 진정한 생산성이 나옵니다.
* **프레임워크 락인 (Lock-in) 및 유연성 제한**: 프레임워크의 주도적 설계 방식을 벗어나는 특수한 아키텍처나 비표준 패키지를 이식하고 커스터마이징하는 작업이 순수 코딩(Raw PHP) 대비 극도로 까다로워집니다.
* **런타임 오버헤드**: 프레임워크 핵심 커널이 구동되면서 수많은 클래스를 로딩하고 파이프라인(미들웨어)을 거쳐 가므로, 메모리 점유율이 높아지고 가볍게 짠 단일 파일 스크립트 대비 요청 처리 지연 속도가 다소 늘어납니다.
