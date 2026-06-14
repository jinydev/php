---
layout: php
title: PHP 에러 로그 출력 및 보안 환경 설정 가이드
description: "PHP 가동 시 발생하는 에러의 노출 범위를 제어하는 php.ini의 4대 핵심 에러 지시어(display_errors, log_errors, error_reporting, error_log)의 보안 지침과 실무 코드를 정리합니다."
keyword: "php 에러 출력, php.ini 에러 설정, display_errors, log_errors, error_reporting, php 에러 로그, error_log 경로"
breadcrumb:
- setup
- env
- ini
- error
---

# PHP 에러 로그 출력 및 보안 설정
---
PHP 프로그램 개발 단계에서 구문 오류나 데이터베이스 예외 발생 시 원인을 파악하는 가장 빠른 열쇠는 에러 메시지입니다. 하지만 실제 고객이 방문하는 실 서비스(Production) 환경에서 에러 정보를 고스란히 화면에 노출시키는 것은 해커에게 시스템 전체의 설계도와 취약점을 조공하는 것과 다름없습니다.

이 문서에서는 에러 출력을 엄격히 통제하는 `php.ini` 에러 관련 4대 지시어와 환경별 모범 설정 방안, 그리고 런타임 제어법을 알아봅니다.

<br>

### 1. 에러 제어 4대 지시어
---
`php.ini`의 `[Error handling and logging]` 색션에서 아래 지시어들을 설정합니다.

```ini
; 1. 에러 발생 시 브라우저 화면(응답 본문)에 출력할지 여부
; 개발 환경(On) / 운영 환경(Off) 필수 분리
display_errors = Off

; 2. 엔진이 감지하고 수집할 에러의 깊이 단계를 제어
; E_ALL은 사소한 Notice 경고부터 심각한 치명적 에러(Fatal Error)까지 모두 다루겠다는 권장값입니다.
error_reporting = E_ALL

; 3. 수집된 에러 내용을 파일 로그로 써서 물리 디스크에 저장할지 여부
; 운영 서버에서는 화면 출력을 끄는 대신 반드시 이 값을 On으로 켜야 진단이 가능합니다.
log_errors = On

; 4. 에러 로그 파일이 기록될 서버 내부의 절대 물리 경로 명시
; 파일 권한이 웹서버 소유자(nginx, www-data 등)에게 쓰기 허용되어 있어야 작동합니다.
error_log = /var/log/php/php_errors.log
```

<br>

### 2. display_errors=On의 보안상 치명적 위협
---
운영 서버에서 `display_errors = On` 상태를 유지하면 외부 해커가 고의로 잘못된 매개변수나 비정상 데이터 주입(SQL Injection 시도 등)을 가해 오류를 유도할 수 있습니다. 이때 나타나는 에러 메시지는 심각한 **정보 노출 취약점(Information Disclosure)**을 초래합니다.

1. **데이터베이스 연결 정보 및 쿼리 구조 노출**: 에러 내용에 DB 호스트 주소, 계정명, 테이블 및 컬럼 구조가 적나라하게 포함되어 표기됩니다.
2. **서버 내부 파일 디렉터리 경로 유출**: 소스코드 파일의 물리 주소(예: `/var/www/html/secure/db.php`)가 에러 스택 트레이스에 함께 올라오므로 해커가 로컬 파일 포함(LFI) 공격 루트를 계획하기 쉽게 만듭니다.

> [!IMPORTANT]
> **실서버 운영 철칙**
> 실서비스 서버는 **반드시 `display_errors = Off` / `log_errors = On`**으로 고정하고, 오류 발생 시 사용자에게는 "서버에 일시적인 장애가 발생했습니다."와 같은 마스킹된 커스텀 HTML 에러 페이지를 띄우는 것이 절대적인 보안 의무 사양입니다.

<br>

### 3. 소스코드 상에서 런타임에 에러 설정 변경하는 법
---
공용 호스팅 서버나 시스템 전역 `php.ini` 권한이 잠겨 설정 파일을 수정할 수 없는 특수한 디버깅 시점에는, 내 코드 최상단 영역에 런타임 제어 함수들을 임시 선언하여 작동하게 만들 수 있습니다.

```php
<?php
// 1. 임시로 에러 수집 범위를 전체(E_ALL)로 전환
error_reporting(E_ALL);

// 2. 화면에 에러를 즉시 강제 출력하도록 변경 (1: On, 0: Off)
ini_set('display_errors', '1');

// 3. 테스트 연산 에러 발생 유도
$result = 100 / 0; // Division by zero 에러 화면 노출됨
?>
```

> [!NOTE]
> **코드 레벨 ini_set()의 작동 범위 한계**
> 코드 상에 적은 `ini_set()`은 PHP 엔진이 파일을 기계어로 번역 완료한 후 **실행하는 런타임 단계**에서야 적용됩니다. 따라서 문법 오타로 인한 구문 오류(`Parse error`) 등 컴파일 자체가 불가능한 치명적 문법 에러는 `ini_set` 코드 한 줄도 읽기 전에 엔진이 중단되므로 화면 출력을 켤 수 없습니다. 이 경우는 반드시 `php.ini` 전역 파일이나 웹서버 환경 지시어를 통해 display_errors를 켜주어야만 원인을 파악할 수 있습니다.