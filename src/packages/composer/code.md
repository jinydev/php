---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 코드 적용 실습
---
이 장에서는 실제 외부 패키지를 검색해 터미널로 프로젝트에 다운로드하고, 소스코드 파일에서 컴포저 오토로더를 호출해 로드한 후 외부 라이브러리 클래스를 직접 코드상에서 사용하는 실무 실습을 수행합니다.

또한, 실습을 마친 패키지를 깔끔하게 제거하는 법을 알아봅니다.

<br>

## 1. 외부 패키지 설치
---
실습에 적합한 다차원 배열 처리 및 유틸리티 기능들을 내포한 라라벨 프레임워크의 서포트 헬퍼 패키지인 **`illuminate/support`**를 설치해 보겠습니다. 프로젝트 루트 디렉터리에서 아래 명령을 수행합니다.
```bash
$ composer require illuminate/support
```
* **동작**: 컴포저는 Packagist를 조회해 적절한 패키지 소스를 다운로드하고 `vendor/` 폴더를 생성(혹은 갱신)하여 소스코드를 적재합니다. 동시에 `composer.json`에 의존성을 기록하고 `composer.lock`을 동기화합니다.

수정을 마친 뒤 프로젝트의 `composer.json` 파일의 `"require"` 항목을 다시 조회하면 다음과 같이 설치 내역이 자동으로 추가되어 있을 것입니다.
```json
{
    "name": "myproject/app",
    "require": {
        "illuminate/support": "^8.0"
    }
}
```

<br>

## 2. 코드 작성 및 클래스 호출
---
이제 프로젝트 루트 폴더에 실행 스크립트 파일(`index.php`)을 생성하고, 컴포저를 통해 배치된 패키지를 결합하여 사용해 보겠습니다.

> [!IMPORTANT]
> **모던 네임스페이스와 헬퍼 변경 사항**:
> 과거 구버전 PHP/Laravel 패키지에서는 `array_get()`과 같은 글로벌 헬퍼 함수가 널리 쓰였습니다. 그러나 PHP 7/8 이상 및 Laravel 6.0 이후부터는 글로벌 함수에 의한 명명 규칙 충돌과 코드 가독성을 방지하기 위해 **모든 글로벌 함수 헬퍼가 폐기 및 제거**되었습니다.
> 따라서 현재는 네임스페이스 표준에 맞춰 **`Illuminate\Support\Arr`** 클래스를 `use` 키워드로 선언한 후, 정적(static) 메서드인 **`Arr::get()`**으로 안전하게 접근하는 것이 업계의 약속입니다.

#### 파일: `index.php`
```php
<?php

// 1. 컴포저 오토로드 부트스트랩 파일을 단 한 번만 로드합니다.
require_once __DIR__ . '/vendor/autoload.php';

// 2. 사용할 일루미네이트 서포트의 배열 헬퍼 클래스를 임포트(Import)합니다.
use Illuminate\Support\Arr;

echo "<h3>Composer 실습 프로그램</h3>";

// 복잡한 다차원 타깃 배열 정의
$arr = [
    'admin' => [
        'first_name' => 'hojin',
        'last_name' => 'lee'
    ]
];

// 3. 기존의 array_get($arr, 'admin.first_name') 수동 함수 대신,
//    네임스페이스를 타는 모던 클래스 정적 메서드 방식으로 호출합니다.
$firstName = Arr::get($arr, 'admin.first_name');

echo "배열 조회 결과: " . $firstName . "<br>"; // "hojin" 출력
```

* 위의 코드처럼 아무리 많은 외부 패키지를 추가해도 우리는 오직 `vendor/autoload.php` 하나만 `require`해 두고 필요한 클래스를 `use`하여 사용하면 오토로더가 알아서 실시간으로 소스파일을 분석해 include 작업을 수행합니다.

<br>

## 3. 패키지 안전 제거
---
실습이나 개발이 종료되어 필요 없어진 패키지는 CLI 명령어를 통해 흔적을 남기지 않고 완벽히 삭제할 수 있습니다.
```bash
$ composer remove illuminate/support
```
* **수행 결과**: 컴포저는 `vendor/` 디렉터리 내부에 생성되었던 `illuminate` 관련 디렉터리를 완전히 소거하고, `composer.json` 및 `composer.lock` 파일 내의 해당 의존 설정 라인을 깔끔하게 지운 뒤 오토로드 매핑 캐시 파일까지 자동으로 재작성(Re-dump)해 줍니다.
