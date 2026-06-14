---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 패키지 제작 (Package Development)
---
지금까지는 다른 개발자가 배포해 놓은 외부 패키지를 연동하고 활용하는 방법에 대해 배웠습니다. 이번 장에서는 자신이 직접 쓸모 있는 PHP 라이브러리 코드를 작성하고, 이를 컴포저 패키지 규격으로 구성하여 배포할 수 있는 골격을 직접 개발해 봅니다.

<br>

## 1. 프로젝트 패키지 폴더 셋업 (준비 단계)
---
우선, 현재 진행 중인 메인 프로젝트 내부에 가상으로 독립 개발할 패키지 전용 서브 디렉터리를 구성해 봅니다. 관례상 프로젝트 루트에 `packages` 디렉터리를 만들고 그 하위에서 작업합니다.
```bash
$ mkdir -p packages/jiny/hello
$ cd packages/jiny/hello
```
* **구조 설계**: 벤더명을 `jiny`, 패키지명을 `hello`로 삼아 `packages/jiny/hello` 폴더를 준비했습니다.

<br>

## 2. 패키지 전용 `composer.json` 생성
---
이 폴더를 독립적인 패키지로 컴포저가 인식하게 하려면, 패키지 폴더 내부에 독립적인 `composer.json` 설정 파일이 위치해야 합니다. 대화식 인스톨러인 `composer init`으로 뼈대 파일을 생성합니다.
```bash
$ composer init
```

* **대화식 질문 가이드**:
  1. **Package name**: `jiny/hello` 지정.
  2. **Description**: `composer package make test` 기입.
  3. **Author**: 본인의 이름과 이메일 확인 후 엔터.
  4. **Minimum Stability**: 패키지 최소 안전성 상태를 `stable`로 입력.
  5. **Package Type**: 라이브러리 목적이므로 `library` 지정.
  6. **License**: 오픈소스 사용권을 위해 `MIT` 지정.
  7. **Dependencies**: `no`를 선택해 대화식 추가 단계를 건너뜁니다.
  8. **Confirm generation**: 정보를 검증하고 `yes`를 선택해 저장합니다.

완성되면 패키지 디렉터리에 아래와 같이 군더더기 없는 `packages/jiny/hello/composer.json` 파일이 생성됩니다.
```json
{
    "name": "jiny/hello",
    "description": "composer package make test",
    "type": "library",
    "license": "MIT",
    "authors": [
        {
            "name": "hojinlee",
            "email": "infohojin@gmail.com"
        }
    ],
    "minimum-stability": "stable",
    "require": {}
}
```

<br>

## 3. 소스코드 작성
---
패키지 폴더 안에 소스코드를 격리할 `src/` 폴더를 개설하고 예제 파일을 작성합니다.
```bash
$ mkdir src
$ cd src
```

#### 파일: `packages/jiny/hello/src/HelloMessage.php`
```php
<?php

namespace Jiny\Hello; // 패키지 자체의 고유한 네임스페이스 선언

class HelloMessage
{
    public function __construct()
    {
        echo __CLASS__ . " 객체가 성공적으로 생성되었습니다.<br>";
    }

    public function sayHello($name = 'Guest')
    {
        echo "Hi! " . htmlspecialchars($name) . ", nice to meet you.<br>";
    }
}
```

* **주의 사항**: 패키지 코드를 작성할 때는 네임스페이스 기재 시 `[벤더명]\[패키지명]` 조합(예: `Jiny\Hello`)을 기준으로 코드를 설계해야 클래스 중복 위험을 예방할 수 있습니다.

<br>

## 4. 로컬 테스트용 오토로드 임시 등록
---
아직 이 패키지를 Packagist에 배포하지 않았으므로 메인 루트 디렉터리의 PHP 스크립트에서 이를 로드해 보려면, **루트 설정에 임시로 경로를 연결해 주어야 합니다.** 

프로젝트 루트 경로(`packages` 상위 디렉터리)의 `composer.json` 파일을 열어 아래처럼 `"Jiny\\Hello\\"`의 로컬 상대 경로를 추가 매핑해 줍니다.
```json
"autoload": {
    "psr-4": {
        "App\\": "src/",
        "Jiny\\Hello\\": "packages/jiny/hello/src"
    }
}
```

설정을 마치면 루트 디렉터리 콘솔에서 아래 명령을 내려 변경 사항을 갱신합니다.
```bash
$ composer dump-autoload
```

---

### 4.1 로컬 인스턴스화 테스트
루트 경로에 테스트 파일(`test-hello.php`)을 구축해 성공적으로 클래스가 올라오는지 확인합니다.
```php
<?php
// 1. 루트의 오토로더 적재
require_once __DIR__ . '/vendor/autoload.php';

// 2. 가상 네임스페이스를 통해 로컬 패키지 인스턴스화
$pack = new \Jiny\Hello\HelloMessage();
$pack->sayHello("Jiny");
```

#### 출력 결과
```text
Jiny\Hello\HelloMessage 객체가 성공적으로 생성되었습니다.
Hi! Jiny, nice to meet you.
```

<br>

## 5. 패키지 배포용 자체 오토로드 명세 지정 (필수 단계)
---
로컬 테스트에서 작동하는 것을 확인했다면, **반드시 패키지 본연의 `composer.json` 파일에도 오토로드 명세를 주입해야 합니다.**

루트의 `composer.json`에 선언했던 임시 룰(`"packages/jiny/hello/src"`)은 오로지 현재 내 개발 환경에서만 작동하는 하드코딩 경로입니다. 이 패키지를 다른 개발자가 `composer require jiny/hello` 명령으로 내려받으면, 해당 패키지는 내 로컬이 아니라 `vendor/jiny/hello/` 디렉터리에 격리 다운로드되므로 경로 정보가 어긋나 에러를 뿜게 됩니다.

따라서 **패키지 자체 폴더 내부의 `packages/jiny/hello/composer.json`**을 열어 다음과 같이 오토로드 명세를 작성합니다.
```json
{
    "name": "jiny/hello",
    "description": "composer package make test",
    "type": "library",
    "license": "MIT",
    "autoload": {
        "psr-4": {
            "Jiny\\Hello\\": "src/"
        }
    },
    "require": {}
}
```

> [!IMPORTANT]
> **상대 경로의 기준**: 패키지 자체의 `composer.json`에 적히는 `"src/"` 경로는 패키지 루트 디렉터리(`packages/jiny/hello/`)를 기준으로 작동합니다. 
> 컴포저는 외부 개발자가 이 패키지를 임포트할 때 이 내부의 `"psr-4"` 설정을 읽어들여, 다운로드된 벤더 하위의 경로(`vendor/jiny/hello/src/`)에 알아서 맞춰 맵에 병합하므로 문제없이 동작하게 됩니다.
