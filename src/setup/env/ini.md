---
layout: php
title: php.ini 설정 파일 문법 및 Dev vs Prod 사양 분석
description: "php.ini 파일의 기초 문법 규칙, 세미콜론 주석 처리법, 설정 범위(Scope) 규격 및 개발용(development)과 운영용(production) 템플릿의 보완 차이점을 정리합니다."
keyword: "php.ini 설정, php.ini 주석, php.ini 문법, php.ini-development, php.ini-production, php 설정 세미콜론, INI_SYSTEM"
breadcrumb:
- setup
- env
- ini
---

# php.ini 설정 규칙 및 Dev vs Prod 차이
---
`php.ini` 파일은 단순해 보이지만, 구문 규칙을 오입력하면 PHP 파서가 로딩 도중 멈추거나 기본값으로 롤백되는 오류가 발생합니다. 

이 문서에서는 `php.ini` 파일의 작성 규칙, 소스 배포 파일에 담겨오는 개발용과 운영용 설정 템플릿의 본질적인 보안 설정 차이, 그리고 동적 제어 범위에 대해 깊이 있게 알아봅니다.

<br>

### 1. php.ini 파일의 문법 규칙
---
`php.ini`는 표준 INI 파일 포맷을 따릅니다.

```ini
; 1. 주석 처리 규칙
; 이 줄은 세미콜론(;)으로 시작하므로 파서가 완전히 무시합니다.
; 설정 설명이나 비활성화할 옵션을 주석 처리할 때 사용합니다.

# (주의: 구버전에서는 # 기호도 주석으로 지원했으나, PHP 7.0 이후부터는 사용이 불가하므로 반드시 세미콜론을 써야 합니다.)

# 2. 키와 값의 작성 규격
# 대소문자를 구분(Case-Sensitive)하므로 오타에 극히 주의해야 합니다.
# 등호(=)를 기준으로 설정 항목과 지정값을 연결합니다. 공백은 무시됩니다.
memory_limit = 256M

# 3. 논리값(Boolean) 대입
# 논리 참/거짓은 On/Off, True/False, Yes/No 중 어떤 것을 기입해도 동일하게 작동합니다. (통상 On/Off 사용)
display_errors = On
```

<br>

### 2. 중요: php.ini-development vs php.ini-production
---
PHP를 공식 배포 사이트에서 내려받아 압축을 풀면 실 작동용 `php.ini`는 없고, 대신 두 개의 용도별 템플릿 파일이 제공됩니다. 서비스 용도에 맞춰 복사하여 실제 `php.ini`로 작명해 가동합니다.

#### 1) `php.ini-development` (개발 서버용)
- **목표**: 오타 및 에러를 실시간으로 빠르게 인지하여 원활하게 디버깅할 수 있도록 편의성을 최적화한 파일입니다.
- **주요 속성**:
  - `display_errors = On` (에러 메시지를 클라이언트 브라우저 화면에 실시간으로 출력)
  - `display_startup_errors = On` (엔진 로딩 시점에 발생하는 초기화 오류도 즉시 모니터에 출력)
  - `error_reporting = E_ALL` (가벼운 경고(Notice)나 권장 개선안(Deprecated)을 포함한 모든 레벨의 진단 메시지를 노출)

#### 2) `php.ini-production` (운영 서버용)
- **목표**: 보안 강화와 연산 가속화에 초점을 맞추어 잠금 설계된 실 서비스 배포용 템플릿 파일입니다.
- **주요 속성**:
  - `display_errors = Off` (오류가 나더라도 해커나 일반 방문자에게 내부 DB 쿼리나 스크립트 파일 시스템 절대 경로 등이 노출되는 것을 막기 위해 화면 에러 전송을 차단)
  - `log_errors = On` (화면에 뿌리지 않는 대신, 서버 보안 로그 파일(`/var/log/php_errors.log` 등)로 내부 기록하여 관리자만 SSH 상에서 은밀히 디버깅할 수 있도록 격리)
  - `opcache.validate_timestamps = Off` (실서버 파일 수정 여부를 정기 검증하는 단계를 비활성화하여 오버헤드를 없애고 속도를 극한으로 상향)

<br>

### 3. 지시어 설정 변경 범위 (Scope)
---
모든 `php.ini` 옵션들이 코드 상의 `ini_set()` 함수나 디렉터리의 `.user.ini`를 통해 마음대로 바뀔 수 있는 것은 아닙니다. 시스템의 보안 위협을 방지하기 위해 옵션마다 허용되는 수정 권한 범위가 정해져 있습니다.

- **`INI_USER`**: 사용자의 PHP 코드 레벨(`ini_set()`)이나 세션 변수단에서 동적으로 자유롭게 오버라이드할 수 있습니다.
- **`INI_PERDIR`**: 디렉터리 기반 설정 파일(`.htaccess`, `.user.ini`)이나 웹 서버 호스트 구성 파일단에서 변경이 허용됩니다.
- **`INI_SYSTEM`**: 오직 메인 환경설정 파일인 시스템 전역 `php.ini` 파일을 직접 열어서 수정해야만 작동하는 중요 코어 설정입니다. (예: `memory_limit`, `open_basedir` 등)
- **`INI_ALL`**: 위의 세 가지 모든 범위 어디서든 자유롭게 덮어쓰기가 허용되는 일반 지시어 옵션입니다.