---
layout: php
title: PHP CLI (콘솔) 실행 및 환경 개요
description: "PHP CLI(Command Line Interface)의 도입 역사와 개념, 웹 가동 방식(CGI/FPM)과의 차이 및 CLI 다이어그램을 정리합니다."
keyword: "PHP CLI, PHP 콘솔, command line interface, php sapi, php 터미널 실행"
breadcrumb:
- setup
- console
---

# PHP CLI (콘솔) 실행 개요
---
PHP는 웹 서버와 결합하여 브라우저 화면을 그리는 용도(서버 사이드 스크립트)로 널리 알려져 있으나, 터미널/콘솔 창에서 직접 명령어로 백그라운드 작업을 실행할 수 있는 강력한 **CLI(Command Line Interface)** 환경을 완전하게 지원합니다.

PHP CLI 기능은 PHP 4.3.0 버전 이후부터 정식으로 통합 제공되기 시작했으며, 내부적으로 **SAPI(Server Application Programming Interface)** 구조 중 `CLI SAPI` 형식으로 구동되어 웹 기반 가동 방식(예: FPM, CGI, Apache Module)과 실행 생명 주기가 전혀 다르게 작동합니다.

<br>

### 1. PHP CLI 실행 모드 및 인자 처리 구조
---
아래 다이어그램은 PHP CLI 인터프리터가 터미널 명령어 라인에서 전송된 파일 실행, 대화형 쉘(`-a`), 소스 즉시 구동(`-r`), 로컬 서버 가동(`-S`) 등의 옵션을 분기 처리하는 모식도와 외부에서 넘어오는 인자값(`$argv`)의 매핑 원리를 보여줍니다.

![PHP CLI 가동 구조도](/setup/console/img/cli_flow.svg)

<br>

### 2. 콘솔(CLI)의 가치와 웹 구동과의 본질적 차이
---
콘솔 창은 DOS 명령 창(CMD), macOS/리눅스의 bash, zsh 셸 등 키보드 입력 기반의 텍스트 교환 장치를 뜻합니다. 웹 브라우저를 통한 호출 방식과 비교할 때, CLI 모드는 다음과 같은 뚜렷한 특징을 지닙니다.

1. **시간 제한 없음 (`max_execution_time`)**:
   - 웹 모드(FPM 등)에서는 무한 루프나 무거운 연산이 서버 자원을 독점하는 것을 막기 위해 대개 30초 내외로 스크립트 실행이 중단되는 시간 제한이 적용됩니다.
   - 반면 CLI 모드에서는 전역 `max_execution_time` 기본값이 **`0` (무제한)**으로 설정되므로, 백그라운드 배치 연산이나 대용량 데이터 이전 등 오랜 시간이 소요되는 작업을 강제로 강제 종료시키지 않고 끝까지 수행할 수 있습니다.
2. **HTTP 헤더 제어 생략**:
   - 웹 구동 시에는 HTML 코드 출력 전에 반드시 HTTP 상태 헤더(`Content-Type` 등) 정보가 선행 송출되지만, CLI 환경에서는 헤더 패킹 정보가 불필요하므로 순수한 에코 메시지만이 표준 출력(stdout)으로 처리됩니다.
3. **독립된 php.ini 환경설정 적용**:
   - 필요에 따라 CLI 모드 전용의 다른 환경 설정 파일(`php-cli.ini`)을 읽어 들이도록 하거나 환경 인자 옵션을 동적으로 로딩하여 웹 서비스 운영에 영향을 미치지 않고 자유로운 튜닝을 할 수 있습니다.

<br>

### 3. 세부 기능 학습하기
---
- **[기본 콘솔 파일 실행법](execute)**
- **[도움말 및 옵션 테이블 정리](option)**
- **[외부 인자($argv, $argc) 전달 기법](args)**
- **[백그라운드 실행(&) 및 프로세스 격리](background)**
