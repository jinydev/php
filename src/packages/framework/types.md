---
layout: php
title: "웹 프레임워크 및 라라벨 소개"
keyword: "php framework types, full-stack framework, micro framework, laravel, symfony, codeigniter, yii, slim, routing comparison"
description: "PHP 웹 프레임워크 종류를 풀스택과 마이크로 카테고리로 나누어 분석하고, Laravel, Symfony, CodeIgniter, Slim의 실제 라우팅 소스 코드 스타일을 상호 대조 비교합니다."
breadcrumb:
- packages
- framework
- types
---

# 3. PHP 프레임워크의 종류 및 분류
---
PHP 언어 생태계는 약 20년이 넘는 시간 동안 다양한 프레임워크들의 흥망성쇠를 거치며 발전해 왔습니다. 오늘날 PHP 프레임워크 진영은 설계 범위와 탑재 범위의 견고함에 따라 크게 **풀스택 프레임워크**와 **마이크로 프레임워크**로 분류됩니다.

이 문서에서는 각 분류별 주요 프레임워크들의 아키텍처적 지향점과 강점, 그리고 동일한 API 엔드포인트 구현을 통한 코드 스타일 차이를 알아봅니다.

<br>

## 3.1 풀스택 프레임워크 (Full-Stack Frameworks)
대규모 비즈니스 시스템이나 상용 웹 애플리케이션 개발에 필요한 전천후 인프라 모듈(회원 인증, 데이터베이스 ORM, 메일 발송, 파일 업로드 관리, 작업 큐 등)을 빠짐없이 패키징 형태로 기본 내장하고 있는 프레임워크입니다.

```text
+-----------------------------------------------------------+
|                  풀스택 프레임워크 (Full-Stack)           |
|                                                           |
|  [ 인증 ]  [ DB / ORM ]  [ 템플릿 ]  [ 라우팅 ]  [ 메일 ] |
|  [ 캐싱 ]  [ 작업 큐 ]   [ 보안체크 ] [ 유닛테스트 ]        |
+-----------------------------------------------------------+
```

### 3.1.1 라라벨 (Laravel)
* **지향점**: "웹 아티스트를 위한 PHP 프레임워크"
* **특징**: 현재 전 세계 백엔드 점유율에서 PHP 생태계를 완벽하게 주도하고 있는 현대적 웹 프레임워크입니다.
* **코드 스타일**:
  ```php
  // [Laravel 라우팅 스타일]
  // routes/web.php
  use App\Http\Controllers\WelcomeController;
  use Illuminate\Support\Facades\Route;

  Route::get('/hello/{name}', [WelcomeController::class, 'sayHello']);
  ```
* **장점**: 문법이 극도로 간결하고 가독성이 뛰어납니다. Blade 템플릿 엔진, Eloquent ORM 등 개발자의 코딩 생산성과 편의성을 최우선으로 지향하며, 전 세계 커뮤니티 생태계 규모가 압도적으로 큽니다.

### 3.1.2 심포니 (Symfony)
* **지향점**: "엔터프라이즈 설계 표준과 견고함"
* **특징**: 엄격한 객체지향 설계 기법과 PSR 규약 디자인 패턴을 고집스럽게 구현하는 전통적인 대형 프레임워크입니다.
* **코드 스타일**:
  ```php
  // [Symfony 라우팅 스타일 (Attribute 방식)]
  // src/Controller/WelcomeController.php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  class WelcomeController 
  {
      #[Route('/hello/{name}', name: 'app_hello', methods: ['GET'])]
      public function sayHello(string $name): Response 
      {
          return new Response("Hello, " . htmlspecialchars($name));
      }
  }
  ```
* **장점**: 모든 모듈이 독립적이고 유연하게 격리(Symfony Components)되어 있습니다. 라라벨을 비롯한 수많은 오픈소스 솔루션들이 심포니 컴포넌트를 기반 뼈대로 가져다 쓰고 있을 정도로 아키텍처적 완성도와 코드 품질이 타협 없이 뛰어납니다.

### 3.1.3 코드이그나이터 (CodeIgniter 4)
* **지향점**: "가벼운 셋업, 빠른 속도와 단순함"
* **특징**: 수동 CLI 조율이나 복잡한 환경 설정 없이도 가볍게 부팅 및 가동되는 경량 풀스택 프레임워크입니다.
* **코드 스타일**:
  ```php
  // [CodeIgniter 4 라우팅 스타일]
  // app/Config/Routes.php
  $routes->get('hello/(:any)', 'Welcome::sayHello/$1');
  ```
* **장점**: 리소스를 극도로 적게 소모합니다. 뼈대 폴더와 설정 파일이 작아 학습 비용이 아주 낮고, 웹 호스팅 공간 제약이 심하거나 서버 사양이 좋지 않은 레거시 서비스에 긴급 배포할 때 최고의 효율성을 냅니다.

<br>

## 3.2 마이크로 프레임워크 (Micro Frameworks)
서버에 가해지는 로딩 지연을 최소화하기 위해, 라우팅(HTTP 요청을 코드로 연결)과 기초 커널 기능만 탑재하여 제공하는 프레임워크입니다.

```text
+-----------------------------------------------------------+
|                 마이크로 프레임워크 (Micro)               |
|                                                           |
|                      [ 초경량 라우터 ]                     |
|                                                           |
|       (나머지 ORM, 템플릿 등은 Composer 패키지로 직접 이식) |
+-----------------------------------------------------------+
```

### 3.2.1 슬림 (Slim 4)
* **지향점**: "단일 API 서버 특화 및 극단적 미니멀리즘"
* **코드 스타일**:
  ```php
  // [Slim 4 라우팅 스타일]
  // public/index.php
  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Slim\Factory\AppFactory;

  $app = AppFactory::create();

  $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
      $name = $args['name'];
      $response->getBody()->write("Hello, " . htmlspecialchars($name));
      return $response;
  });

  $app->run();
  ```
* **장점**: 프레임워크 자체가 지닌 모듈 코드가 아주 미미하여 메모리 상의 구동 오버헤드가 사실상 없습니다. 오직 RESTful JSON API만 고속으로 처리하고자 할 때 가장 유용합니다.

<br>

## 3.3 아키텍처 타입별 장단점 및 트레이드오프 비교

| 비교 항목 | 풀스택 프레임워크 (Full-Stack) | 마이크로 프레임워크 (Micro) |
| :--- | :--- | :--- |
| **기본 제공 모듈** | ORM, 인증, 메일, 큐, 보안 필터 등 일체 제공 | HTTP 라우팅, 간단한 DI 컨테이너 수준 제공 |
| **초기 개발 생산성** | **매우 높음** (필요 컴포넌트 즉각 사용 가능) | **보통** (필요 패키지를 직접 찾아 연동해야 함) |
| **애플리케이션 속도** | 프레임워크 커널이 무거워 상대적으로 다소 지연 | 불필요한 레이어가 없어 매우 빠름 |
| **학습 곡선** | 비교적 높음 (알아야 할 공식 문법이 많음) | 매우 낮음 (라우팅 및 컨트롤러만 알면 됨) |
| **적합한 프로젝트** | ERP, 대형 포털, 인증이 내장된 종합 플랫폼 | 마이크로서비스(MSA), 초경량 RESTful API 서버 |

<br>

## 3.4 PHP 진영의 최신 트렌드 동향 (Trend)
현재 글로벌 PHP 진영의 실무 채택은 **라라벨(Laravel)이 압도적인 주도권**을 쥐고 있습니다.
* **Packagist & Github**: 라라벨의 다운로드 건수와 깃허브 스타(Star) 수는 심포니 대비 수배에 이르며, 전 세계 구인 시장 및 기술 블로그 아티클 양에서도 비교할 수 없을 정도의 커뮤니티 인프라를 독식하고 있습니다.
* **심포니의 굳건함**: 하지만 심포니는 독립 컴포넌트의 독보적 안전성을 바탕으로 대형 SI 프로젝트나 Drupal, Prestashop, 심지어 라라벨의 핵심 코어 부품 공급원으로서 실질적인 기둥 역할을 하고 있습니다.
* **마이크로 프레임워크의 변화**: 과거에는 경량 API용으로 Lumen이나 Slim 등이 적극 선호되었으나, 최근 PHP 8.x의 성능 향상과 풀스택 프레임워크의 내부 최적화로 인해 '처음부터 라라벨 순정을 사용해 개발 속도를 올리는 것'이 전반적인 개발 트렌드로 자리 잡았습니다.
