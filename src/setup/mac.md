---
layout: php
title: macOS PHP 설치 및 개발 환경 구축 가이드
description: "macOS에서 패키지 매니저인 Homebrew를 사용하여 PHP를 설치하고, brew services를 통한 백그라운드 구동, 버전 전환 및 php.ini 상세 설정 경로를 확인합니다."
keyword: "mac php 설치, 맥 php 설치, homebrew php, brew install php, mac php.ini, brew services php, m1 php 설치, mac php fpm"
breadcrumb:
- setup
- mac
---

# macOS PHP 설치 및 개발 환경 구축
---
Apple macOS 환경은 Unix 기반의 호환성 높은 파일 시스템과 터미널 환경을 제공하므로, 수많은 개발자가 웹 애플리케이션 개발 머신으로 선호하고 있습니다. macOS에서 PHP 환경을 구축하는 가장 현대적이고 편리한 표준 방식은 패키지 매니저인 **Homebrew**를 사용하는 것입니다.

이 가이드에서는 Homebrew를 통한 최신 PHP 설치부터 환경 변수 맵, 데몬 제어 및 다중 버전 관리 방법까지 체계적으로 알아봅니다.

<br>

### 1. macOS Homebrew 기반 가동 아키텍처
---
아래 다이어그램은 Homebrew가 인터넷 저장소로부터 PHP 패키지를 가져와 로컬 맥 컴퓨터의 적절한 셀러(Cellar) 경로에 적재하고, macOS 시스템 데몬 관리자인 launchd(또는 `brew services`)와 연계하여 백그라운드에서 PHP-FPM 서비스를 가동하는 흐름을 보여줍니다.

![macOS Homebrew 가동 구조도](/setup/img/mac_brew_flow.svg)

<br>

### 2. 패키지 매니저(Homebrew) 설치
---
맥에 Homebrew가 설치되어 있지 않다면, 먼저 macOS 터미널을 열고 다음 스크립트를 입력하여 Homebrew를 설치합니다.

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```
설치가 끝난 후 화면의 안내에 따라 셸 환경설정 파일(Apple Silicon 맥의 경우 `~/.zprofile` 또는 `~/.zshrc`)에 Homebrew 실행 경로를 영구 등록하고 셸을 다시 시작합니다.

```bash
# 설치 완료 후 정상 구동 확인
brew --version
```

<br>

### 3. PHP 설치하기
---
Homebrew 저장소 정보를 최신으로 갱신한 후, PHP 패키지를 설치합니다.

```bash
# 1. 패키지 리스트 최신화
brew update

# 2. PHP 최신 안정 버전 설치
brew install php
```

이 명령어 한 줄로 PHP 실행용 CLI 엔진뿐만 아니라 웹서버 연동을 위한 PHP-FPM, 데이터베이스 처리를 위한 주요 확장 모듈들이 일체형으로 빌드 및 적재됩니다.

```bash
# 3. 설치 버전 확인
php -v
```
출력 메시지에 아래와 같이 CLI 모드(cli) 및 Zend Engine 버전이 정상 표시되면 기본 설치가 정상 완료된 것입니다.
```console
PHP 8.3.x (cli) (built: ...) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.3.x, Copyright (c) Zend Technologies
```

<br>

### 4. CPU 아키텍처별 설치 및 설정 파일 경로
---
Homebrew는 맥 컴퓨터의 CPU 종류(Apple Silicon M시열 vs Intel x86)에 따라 핵심 파일들이 적재되는 루트 디렉터리가 다릅니다. 이 점을 정확히 인지해야 수동 경로 설정 시 꼬이지 않습니다.

| 항목 | Apple Silicon (M1, M2, M3 등) | Intel CPU Mac |
| :--- | :--- | :--- |
| **Homebrew 루트** | `/opt/homebrew` | `/usr/local` |
| **PHP 실행 바이너리** | `/opt/homebrew/bin/php` | `/usr/local/bin/php` |
| **PHP-FPM 실행 바이너리** | `/opt/homebrew/sbin/php-fpm` | `/usr/local/sbin/php-fpm` |
| **설정 파일 (`php.ini`)** | `/opt/homebrew/etc/php/8.3/php.ini` | `/usr/local/etc/php/8.3/php.ini` |
| **PHP-FPM 설정 (`php-fpm.conf`)** | `/opt/homebrew/etc/php/8.3/php-fpm.conf` | `/usr/local/etc/php/8.3/php-fpm.conf` |

<br>

### 5. PHP 백그라운드 서비스 관리 (`brew services`)
---
Nginx나 Apache 등의 웹 서버와 실시간으로 연동하여 로컬 웹 서비스 테스트를 하고 싶다면, 터미널 세션이 종료되어도 상시 대기하며 작동하도록 PHP를 macOS 시스템 데몬으로 가동해 두는 것이 편리합니다.

Homebrew는 macOS 내장 프로세스 관리 도구인 **launchd**를 쉽게 제어할 수 있는 `brew services` 명령을 제공합니다.

```bash
# 1. 맥 부팅 시 PHP 자동 실행 등록 및 즉시 시작
brew services start php

# 2. PHP 서비스 즉시 중단 (데몬 제거)
brew services stop php

# 3. php.ini 설정 파일 변경 적용을 위해 재시작
brew services restart php

# 4. 현재 실행 중인 모든 Homebrew 서비스 상태 확인
brew services list
```

`brew services start php`를 실행하면, PHP-FPM(FastCGI Process Manager)이 로컬 주소의 기본 9000번 포트(`127.0.0.1:9000`)로 가동을 개시하여 웹 서버의 연결 요청을 수신할 준비를 마칩니다.

<br>

### 6. 다중 PHP 버전 관리 및 스위칭 방법
---
동시에 여러 프로젝트를 진행하다 보면 레거시 프로젝트는 PHP 8.1로, 신규 프로젝트는 PHP 8.3으로 전환해야 하는 상황이 발생합니다. Homebrew 환경에서는 다음과 같이 다중 버전을 설치하고 쉽게 활성 링크를 바꿔가며 사용할 수 있습니다.

```bash
# 1. 필요한 버전 설치
brew install php@8.1
brew install php@8.3

# 2. 현재 활성화된 PHP 실행 경로 연결 해제 (unlink)
brew unlink php

# 3. 원하는 특정 버전으로 실행 경로 강제 심볼릭 링크 (link)
brew link --overwrite --force php@8.1

# 4. 변경된 실제 환경 확인
php -v
```
이후 백그라운드 FPM 데몬도 동일하게 `brew services restart php@8.1` 형태로 버전 이름을 지정하여 개별적으로 구동 및 관리해주시면 됩니다.
