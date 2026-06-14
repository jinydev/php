---
layout: php
title: Rocky Linux / RHEL 환경의 PHP 설치 완벽 가이드
description: "Rocky Linux 9 환경에서 패키지 매니저(DNF)와 Remi 공식 저장소를 활용하여 최신 PHP 8.x 버전을 모듈 스트림 방식으로 안전하고 완성도 높게 안착시키는 전 과정을 설명합니다."
keyword: "록키리눅스 php 설치, rocky linux php setup, remi 저장소 php, dnf php install, rocky linux 9 php-fpm, 리눅스 php"
breadcrumb:
- setup
- linux
- rocky
---

# Rocky Linux / RHEL 환경의 PHP 설치 가이드
---
**Rocky Linux**는 Red Hat Enterprise Linux(RHEL)의 100% 버그 호환을 실현하는 오픈소스 운영체제로서, 뛰어난 안정성과 장기 지원 주기를 지녀 기업용 프로덕션 인프라 구축에 표준적으로 널리 쓰이고 있습니다.

이 가이드에서는 RPM 패키지 관리자(`DNF`)와 공식 커뮤니티 저장소인 **Remi**를 등록하여 최신 PHP 8.x 컴파일러 및 FPM 데몬을 정석대로 탑재하고 구동하는 법을 학습합니다.

<br>

### 1. Remi 저장소를 사용하는 아키텍처적 장점
---
Rocky Linux의 기본 내장 AppStream 저장소는 엔터프라이즈 서버 운영의 보수성 때문에 PHP 8.0 등 구버전에 머무르는 경우가 많습니다.

이를 극복하기 위해 공식 서명된 **Remi 저장소**를 활성화하면 다음과 같은 강점을 얻습니다.
- **모듈러 스트림(Modular Streams)**: `dnf module enable` 구문을 사용해 기존 내장 PHP를 덮어쓰고 원하는 특정 버전(예: 8.3)의 패키지 스트림만 선택 활성화할 수 있어 패키지간 의존성 충돌이 없습니다.
- **기업 표준 호환**: RHEL 아키텍처에 완벽하게 부합되도록 컴파일 및 검증된 안정성을 보장받습니다.

<br>

### 2. 단계별 PHP 설치 절차
---

#### 단계 1: 시스템 업데이트 및 EPEL 저장소 등록
Red Hat 계열 리눅스의 필수 부속 패키지 저장소인 **EPEL(Extra Packages for Enterprise Linux)**을 활성화하고 패키지 리스트를 최신화합니다.
```bash
sudo dnf update -y
sudo dnf install -y epel-release
```

#### 단계 2: Remi 공식 릴리즈 저장소 등록
Rocky Linux 버전(여기서는 Rocky 9)에 매칭되는 Remi RPM 저장소 링크를 다운로드 및 자동 셋업합니다.
```bash
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm
```

#### 단계 3: 기본 PHP 모듈 리셋 및 Remi 8.3 활성화
시스템이 기본 제공 저장소의 구식 PHP 버전을 검색하지 않도록 모듈 상태를 초기화한 뒤, Remi의 PHP 8.3 스트림을 독점 가동합니다.
```bash
# 기본 PHP 모듈 스트림 해제
sudo dnf module reset php -y

# PHP 8.3 Remi 모듈 스트림 활성화
sudo dnf module enable php:remi-8.3 -y
```

#### 단계 4: PHP 핵심 패키지 및 확장 팩 설치
CLI 스크립트 실행기, 독립 웹 릴레이어(FPM), 데이터베이스 드라이버(`mysqlnd`) 및 자주 사용되는 핵심 라이브러리를 일괄 이식합니다.
```bash
sudo dnf install -y php php-cli php-fpm php-mysqlnd php-xml php-mbstring php-gd php-curl php-zip php-opcache
```

#### 단계 5: 서비스 데몬 시작 및 부팅 시 자동 시작 활성화
설치가 끝나면 PHP-FPM 서비스를 즉시 구동하고, 서버가 재부팅되더라도 백그라운드 프로세스가 자동 기동되도록 강제합니다.
```bash
# FPM 서비스 활성화 및 즉각 시작 (--now 플래그)
sudo systemctl enable --now php-fpm

# FPM 가동 상태 모니터링
systemctl status php-fpm
```

<br>

### 3. Rocky Linux 환경 내 주요 파일 및 경로
---
Rocky Linux의 설정과 프로세스는 데비안 계열과 디렉터리 레이아웃이 다소 다릅니다.
- **공통 php.ini 설정 파일**: `/etc/php.ini` (CLI와 FPM 공용)
- **FPM 풀 설정**: `/etc/php-fpm.d/www.conf` (수행 사용자 계정이 기본적으로 `apache`로 잡혀 있으므로, Nginx 연동 시 `nginx`로 수정 필요)
- **FPM 통신용 TCP 소켓 주소**: 기본적으로 `/etc/php-fpm.d/www.conf` 내부 `listen` 항목이 `127.0.0.1:9000` (TCP 포트 방식)으로 바인딩되어 있으며, 필요 시 Unix 소켓(`listen = /run/php-fpm/www.sock`)으로 커스텀 변경하여 사용합니다.

<br>

### 4. 트러블슈팅: SELinux 보안 차단 처리
---
Rocky Linux는 강력한 파일 보호 아키텍처인 **SELinux(Security-Enhanced Linux)** 정책이 기본 강제로 켜져 있습니다. 웹서버가 PHP-FPM 소켓이나 DB 연결망을 타려고 할 때 Permission Denied(503 또는 502 에러)가 뜬다면 다음의 SELinux 보안 해제 플래그를 내려주어야 합니다.

```bash
# 1. 웹 서버가 네트워크 및 프록시 소켓을 탈 수 있도록 허용
sudo setsebool -P httpd_can_network_connect 1

# 2. 웹 서버가 MySQL/MariaDB 포트(3306)에 아웃바운드 연결을 탈 수 있도록 허용
sudo setsebool -P httpd_can_network_connect_db 1
```
이 구문들을 셸에 입력하면 SELinux 수준의 통제 방화벽 규칙이 풀려 안전하게 서비스 연동이 활성화됩니다.
