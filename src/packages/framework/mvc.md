---
layout: php
title: "웹 프레임워크 및 라라벨 소개"
keyword: "php framework, web framework, MVC pattern, Model View Controller, web request lifecycle, Separation of Concerns"
description: "MVC 디자인 패턴의 탄생 배경, 모델(Model), 뷰(View), 컨트롤러(Controller)의 상세 역할과 관계, 8단계 웹 아키텍처 생애주기 흐름을 PHP 의사 코드를 곁들여 학습합니다."
breadcrumb:
- packages
- framework
- mvc
---

# 2. MVC 디자인 패턴
---
대다수의 모던 웹 프레임워크는 소스코드 구조를 체계적으로 분류하기 위해 아키텍처 패턴인 **MVC(Model-View-Controller) 패턴**을 기본 뼈대로 차용합니다. 

이 문서에서는 MVC 패턴의 핵심 정의와 3개 레이어의 구체적인 구현 모델, 그리고 브라우저 요청 시 일어나는 웹 사이클 작동 원리를 알아봅니다.

<br>

## 2.1 MVC 패턴의 태동 배경
과거의 PHP 4/5 시절 개발 코드는 하나의 `.php` 소스 파일 내부에 SQL 질의문(Model), HTML 화면 드로잉(View), 그리고 쿠키 검증 및 분기 처리 제어문(Controller)이 뒤섞여 있는 경우가 많았습니다. 이 방식을 스파게티 코드(Spaghetti Code)라 칭했습니다.
* **문제점**: 화면 디자인만 조금 바꾸고 싶어도 내부 복잡한 SQL 로직을 건드려야 했고, DB 테이블 명칭을 수정하려면 수십 개 스크립트를 수동으로 찾아다니며 수정해야 해서 유지보수가 불가능했습니다.
* **해결책**: "사용자에게 보여주는 프론트 프레젠테이션 레이어"와 "데이터를 연산하는 백엔드 비즈니스 레이어"의 관심사를 독립적으로 분리하자고 약속한 아키텍처 규칙이 바로 MVC 패턴이며, 이는 **관심사의 분리(SoC, Separation of Concerns)** 원칙을 가장 잘 구체화한 패턴입니다.

<br>

## 2.2 3개 영역의 상세 역할과 PHP 연동 시뮬레이션

```text
       +---------------------------------------------+
       |             사용자 (Web Browser)             |
       +---------------------------------------------+
         | (1) URL 요청 (HTTP Request)  ^ (6) HTML 출력 (HTTP Response)
         v                              |
+------------------+             +------------------+
|    Controller    |======(5)===>|       View       |
|    (컨트롤러)     |             |       (뷰)       |
+------------------+             +------------------+
  | (2) 질의   ^ (4) 결과
  v            |
+------------------+
|      Model       |
|      (모델)      |
+------------------+
```

### 2.2.1 모델 (Model)
* **담당 영역**: 애플리케이션의 핵심 비즈니스 로직과 데이터 관리.
* **주요 임무**: 데이터베이스 스키마와 직접 맞닿아 있으며, 데이터의 등록, 수정, 삭제, 조회(CRUD) 연산을 처리합니다. 데이터의 논리적 무결성 검증 규칙 또한 모델 내부에서 구현됩니다.
* **독립성**: 웹 프레임워크나 HTTP 프로토콜의 특성(Request 헤더, 세션 상태 등)을 전혀 인지하지 못하는 독립된 PHP 순수 로직 객체(POPO, Plain Old PHP Object)로 설계되는 것이 이상적입니다.

### 2.2.2 뷰 (View)
* **담당 영역**: 사용자 화면 프레젠테이션 레이어.
* **주요 임무**: 컨트롤러로부터 전달받은 가공된 데이터 배열을 수신하여 사용자 화면(HTML, XML, JSON 등)으로 예쁘게 렌더링(Rendering)하여 내보냅니다.
* **독립성**: 비즈니스 계산식이나 데이터베이스 연결 코드가 직접 내포되어서는 안 되며, 오직 컨트롤러가 주입해 준 데이터를 출력하고 순회하는 단순 제어문(`echo`, `foreach` 등)만 지녀야 합니다.

### 2.2.3 컨트롤러 (Controller)
* **담당 영역**: 중재 및 제어 레이어.
* **주요 임무**: 브라우저의 HTTP 요청을 수신합니다. 입력 매개변수를 유효성 검증(Validation)한 뒤, 이에 부합하는 **모델**을 호출하여 비즈니스 처리를 지시합니다. 이후 획득한 결과 데이터를 적절한 **뷰** 템플릿에 실어 구동시킵니다.
* **독립성**: 모델과 뷰의 물리적 매핑에 집중하며, 비즈니스 계산 로직을 직접 수행하지 않고 모델로 전량 위임하는 **Skinny Controller, Fat Model(가벼운 컨트롤러, 비대한 모델)** 설계가 지향됩니다.

---

### 2.2.4 MVC 상호작용의 초소형 PHP 의사 코드 (Pseudo Code)

실제로 Model, View, Controller가 어떻게 관계를 맺고 흘러가는지 보여주는 가상의 약식 파일 예제입니다.

**1. Model: `UserModel.php`**
```php
<?php
// 데이터베이스 조회 및 비즈니스 데이터 처리를 전담합니다.
class UserModel 
{
    public function getUserData(int $id): array 
    {
        // 실제 데이터베이스 연산 대행 시뮬레이션
        return [
            'id' => $id,
            'name' => '이순신',
            'email' => 'sunshin@joseon.go.kr',
            'grade' => 'Admiral'
        ];
    }
}
?>
```

**2. View: `user_detail.php`**
```html
<!-- 전달받은 $data 배열 변수를 단순히 화면에 배치해 출력하는 역할만 수행합니다. -->
<div class="user-profile">
    <h2><?= htmlspecialchars($data['name']) ?> 장군님의 프로필</h2>
    <ul>
        <li>이메일: <?= htmlspecialchars($data['email']) ?></li>
        <li>직책: <?= htmlspecialchars($data['grade']) ?></li>
    </ul>
</div>
```

**3. Controller: `UserController.php`**
```php
<?php
require_once 'UserModel.php';

class UserController 
{
    // 사용자가 회원 상세정보 조회를 청구했을 때 호출되는 Action 메서드
    public function show(int $userId): void 
    {
        // 1. 모델 인스턴스 생성 및 데이터 요청
        $model = new UserModel();
        $userData = $model->getUserData($userId);

        // 2. 뷰로 전달할 데이터 바인딩
        $data = $userData;

        // 3. 뷰 파일을 로딩하여 화면 렌더링 시작
        include 'user_detail.php';
    }
}
?>
```

<br>

## 2.3 모던 웹 요청 생애주기 (Request Lifecycle - 8단계)
사용자가 브라우저 주소창에 `https://my-app.com/users/show?id=12`를 입력했을 때, 모던 PHP 웹 프레임워크 내부에서 일어나는 연쇄 처리 루틴은 다음과 같은 단계를 거칩니다.

1. **1단계: 진입 (Front Controller)**
   * Nginx 또는 Apache 웹 서버가 HTTP Request를 접수하고, 유일한 실행 진입점인 단일 파일 `public/index.php`(프론트 컨트롤러)로 포워딩합니다.
2. **2단계: 부트스트래핑 (Bootstrapping)**
   * 컴포저 오토로더를 로드하고, 프레임워크 핵심 커널(Kernel) 인프라를 부팅합니다. 설정 로드, 로깅 디바이스 활성화, 에러 핸들러 셋업 등이 이뤄집니다.
3. **3단계: 가상 경로 분석 (Routing)**
   * 라우터(Router) 모듈이 주소 `/users/show`를 인지하여 사전에 선언된 라우팅 명세표를 스캔합니다. 해당 경로가 `UserController` 클래스의 `show` 메서드와 매핑되어 있음을 확인합니다.
4. **4단계: 필터 파이프라인 (Middleware)**
   * 매핑된 컨트롤러로 넘어가기 전, **미들웨어(Middleware)** 체인을 통과시킵니다. CSRF 공격 시도가 있는지 토큰을 대조하고, 사용자가 로그인 상태인지(Authentication) 검사하며, CORS 요청을 필터링합니다. 검증 실패 시 즉각 차단 및 응답을 돌려보냅니다.
5. **5단계: 컨트롤러 도달 및 매개변수 유효성 검사 (Controller Action)**
   * 미들웨어를 무사히 거친 요청이 `UserController`의 `show()` 메서드로 라우팅 제어권을 인계받습니다. 컨트롤러는 요청 변수인 `id = 12`를 확보하고, 정수형인지 등에 대한 입력 유효성 검증(Validation)을 통과시킵니다.
6. **6단계: 비즈니스 트랜잭션 수행 (Model Query)**
   * 컨트롤러는 의존하고 있는 `User` 모델 클래스에 12번 회원의 정보를 조회하라고 명령합니다.
   * `User` 모델은 Eloquent ORM이나 PDO 모듈을 이용해 데이터베이스에 `SELECT * FROM users WHERE id = 12;` SQL을 실행해 처리한 뒤 컨트롤러에 자료 구조(배열 또는 컬렉션 객체)로 되돌려 줍니다.
7. **7단계: 출력 조립 (View Presentation Rendering)**
   * 컨트롤러는 모델이 제공해 준 회원 레코드 정보 객체를 담아 `users.show` 뷰 템플릿(Blade 등)을 호출하며 주도권을 넘깁니다. 뷰 엔진은 HTML 뼈대 파일 속 변수 치환자 자리에 실제 데이터를 동적 매핑하여 완성된 텍스트 코드로 컴파일 및 렌더링합니다.
8. **8단계: 송신 및 해제 (HTTP Response Delivery)**
   * 완성된 HTML 텍스트 문자열을 HTTP Response 헤더와 함께 래핑하여 프레임워크 커널이 최종 클라이언트 브라우저로 밀어 보냅니다. 메모리 점유 및 접속을 안전하게 해제하며 하나의 생애주기가 완결됩니다.
