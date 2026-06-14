---
layout: php
title: PHP CLI 콘솔 명령어 옵션 전체 요약 가이드
description: "PHP CLI 환경에서 사용되는 다양한 커맨드라인 플래그 옵션들을 깔끔하게 분류 정리하고, 각 옵션에 해당하는 설명 페이지 링크와 활용 실례를 정리합니다."
keyword: "php cli 옵션, php 옵션 목록, php command flags, php -a, php -r, php -v, php -l"
breadcrumb:
- setup
- console
- option
---

# PHP CLI 콘솔 옵션 총정리
---
PHP CLI 엔진은 터미널 환경에서 스크립트를 파싱하고 제어하기 위해 매우 다양한 **커맨드라인 플래그(Flag) 옵션**을 지원합니다. 터미널에서 `php -h` 또는 `php --help`를 입력하면 모든 명령어 스펙을 조회할 수 있습니다.

이 장에서는 자주 사용하는 핵심 옵션들을 표로 일목요연하게 정리하고, 각 옵션의 세부 정보 페이지를 연결해 알아봅니다.

<br>

### 1. PHP CLI 명령어 기본 문법 포맷
---
```console
# 1. 스크립트 파일을 실행하는 기본 구조
php [옵션들] [-f] <파일명> [--] [인자값들...]

# 2. 파일 없이 코드를 직접 실행하는 구조
php [옵션들] -r <code> [--] [인자값들...]

# 3. 로컬 테스트용 경량 웹 서버 실행 구조
php [옵션들] -S <서버주소>:<포트> [-t 도큐먼트루트]
```

<br>

### 2. 핵심 CLI 옵션 매핑 테이블
---

| 옵션 플래그 | 주요 설명 | 연관 상세 링크 |
| :--- | :--- | :--- |
| **`-a`** | **Interactive Shell** - 대화형 REPL 터미널 세션을 켭니다. | [대화식 실행 (-a)](a) |
| **`-i`** | **PHP Info** - `phpinfo()`와 동일한 전체 시스템 환경 정보를 출력합니다. | [정보 확인 (-i)](i) |
| **`-l`** | **Syntax Check (Lint)** - 소스코드를 실행하지 않고 **문법 오류만 검증**합니다. | [문법 검사 (-l)](l) |
| **`-m`** | **Modules List** - 컴파일 내장 및 로드 완료된 core/zend 모듈들을 나열합니다. | [모듈 출력 (-m)](m) |
| **`-r <code>`** | **Run Code** - `<?php ... ?>` 태그 없이 PHP 코드를 한 줄로 즉시 실행합니다. | [코드 실행 (-r)](r) |
| **`-S <addr>:<port>`** | **Built-in Server** - 로컬 개발용 단일 스레드 웹 서버를 가동합니다. | [서버 시작 (-S)](s) |
| **`-s`** | **Syntax Highlight** - PHP 소스 구문을 컬러 코딩된 **HTML 양식으로 변환 출력**합니다. | [구문 강조 (-s)](s) |
| **`-v`** | **Version Info** - PHP 엔진 및 젠드 가상머신, 빌드 버전 정보를 확인합니다. | [버전 확인 (-v)](v) |
| **`-w`** | **Strip Source** - 파일의 모든 주석과 불필요한 줄바꿈 공백을 제거해 압축 출력합니다. | [주석 제거 (-w)](w) |
| **`-c <dir\|file>`** | 특정 디렉터리 또는 지정한 단일 파일에서 `php.ini` 설정을 찾아 로드합니다. | - |
| **`-n`** | 시스템 전역 `php.ini` 파일을 **전혀 읽지 않고** 순수 코어 기본값으로 구동합니다. | - |
| **`-d foo[=bar]`** | 실행 시에만 임시로 특정 ini 설정을 강제 덮어쓰기 설정합니다. | 하단 참조 |
| **`--ini`** | 현재 로드되어 활성화된 `php.ini` 파일들의 파일명과 경로를 보여줍니다. | 하단 참조 |

<br>

### 3. 유용한 동적 제어 옵션 상세 실습
---

#### 1) 런타임 설정 일시 변경 (`-d`)
소스를 수정하거나 `php.ini` 파일을 열어서 직접 바꾸지 않고, 스크립트 1회 실행 동안만 특정 환경값을 수정하여 디버깅할 때 요긴하게 쓰입니다.
```bash
# display_errors 옵션을 On으로 덮어쓰고, max_execution_time을 60초로 변경하여 실행
php -d display_errors=1 -d max_execution_time=60 execute.php
```

#### 2) 활성화된 ini 경로 조회 (`--ini`)
서버가 어떤 설정 파일을 타겟팅하여 참조하고 있는지 헷갈릴 때, 경로를 역추적하기 위한 가장 빠른 명령입니다.
```bash
$ php --ini
Configuration File (php.ini) Path: /opt/homebrew/etc/php/8.3
Loaded Configuration File:         /opt/homebrew/etc/php/8.3/php.ini
Scan this dir for additional .ini files: /opt/homebrew/etc/php/8.3/conf.d
```