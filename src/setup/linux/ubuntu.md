---
layout: php
title: Ubuntu Linux 환경의 PHP 설치 완벽 가이드
description: "Ubuntu Server에서 데비안/우분투 공식 PHP 아키비스트인 Ondřej Surý PPA 저장소를 연동하여 최신 PHP 8.x 버전을 패키지 매니저(APT)로 안전하고 신속하게 설치하고 관리하는 방법을 상세히 설명합니다."
keyword: "우분투 php 설치, ubuntu php setup, ondrej ppa php, php-fpm 우분투, apt php install, 리눅스 php"
breadcrumb:
- setup
- linux
- ubuntu
---

# Ubuntu Linux 환경의 PHP 설치 가이드
---
**Ubuntu Linux**는 높은 편의성과 강력한 데비안 패키지 생태계(APT)를 갖추어 전 세계 개발자 및 기업의 프로덕션/클라우드 환경에서 가장 많이 도입하고 있는 표준 오픈소스 운영체제입니다.

이 가이드에서는 Ubuntu Server 환경에서 공식 저장소의 노후화된 버전을 극복하고, 가장 신뢰성 높은 외부 저장소를 등록하여 최신 PHP 8.x 컴파일러와 FPM(FastCGI) 프로세스를 안착시키는 전 과정을 입증된 단계별 명령어로 해설합니다.

<br>

### 1. Ondřej Surý PPA 저장소 추가의 필요성
---
우분투 기본 공식 리포지토리(`apt`)에 내장된 PHP 버전은 OS 배포 버전이 확정된 시점의 고정된 빌드이므로 최신 PHP 8.x의 핵심 보안 패치 및 최적화가 누락되어 있기 쉽습니다.

데비안 공식 PHP 패키지 메인테이너인 **Ondřej Surý(온드레이 수리)의 PPA 저장소**를 활성화하면 다음과 같은 이점이 있습니다.
- **항상 최신 빌드 유지**: 신규 PHP 마이너/메이저 릴리즈가 나오는 즉시 신속하게 APT 패키지로 수급할 수 있습니다.
- **다중 버전 공존 (Multi-version)**: 한 서버 내에 PHP 8.1, 8.2, 8.3 등 여러 버전을 동시에 패키지로 설치하고 개별 소켓으로 프로세스를 격리 구동할 수 있습니다.

<br>

### 2. 단계별 PHP 설치 절차
---

#### 단계 1: 시스템 패키지 최신화 및 유틸리티 설치
설치를 진행하기 전 호스트 패키지 인덱스를 동기화하고, 외부 PPA 저장소를 등록하는 데 필요한 환경 지원 유틸리티(`software-properties-common`)를 확보합니다.
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y software-properties-common ca-certificates lsb-release apt-transport-https
```

#### 단계 2: Ondřej Surý PPA 저장소 추가
터미널에서 아래 명령을 내려 공식 서명키가 포함된 PHP PPA 저장소를 시스템 리스트에 반영합니다.
```bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
```

#### 단계 3: PHP 8.3 엔진 및 확장 라이브러리 설치
웹 연동에 핵심이 되는 PHP CLI, FastCGI 데몬(FPM), 데이터베이스 결합 모듈 및 다채로운 기능 처리를 돕는 필수 익스텐션 세트를 일괄 이식합니다.
```bash
sudo apt install -y php8.3-cli php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl php8.3-gd php8.3-zip php8.3-opcache
```
> **💡 필요에 따른 추가 익스텐션 목록**
> - Redis 연동 필요 시: `php8.3-redis`
> - 암호화 모듈 지원: `php8.3-bcmath`

#### 단계 4: 설치 검증 및 서비스 동작 상태 체크
설치 완료 후 설치된 컴파일러 버전을 조회하고, 백그라운드에서 상시 실행 중인 FPM 프로세스의 활성 상태를 모니터링합니다.
```bash
# PHP 버전 확인
php -v

# PHP-FPM 서비스 상태 점검
systemctl status php8.3-fpm
```

<br>

### 3. Ubuntu 환경 내 주요 경로 안내
---
우분투에 등록된 PHP 설정은 아래와 같이 완벽히 모듈화되어 격리 보관됩니다.

- **FPM 설정 파일 (웹서비스용)**: `/etc/php/8.3/fpm/php.ini`
- **CLI 설정 파일 (콘솔 실행용)**: `/etc/php/8.3/cli/php.ini`
- **FPM 프로세스 풀 설정**: `/etc/php/8.3/fpm/pool.d/www.conf` (FPM의 수행 사용자 계정 및 생성할 워커 수 제어)
- **FastCGI 통신용 유닉스 소켓 경로**: `/var/run/php/php8.3-fpm.sock` (Nginx/Apache와 데이터 송수신을 위한 파일 통로)

<br>

### 4. 트러블슈팅 및 팁
---

#### PPA 추가 시 `add-apt-repository: command not found` 오류 발생
- **원인**: 최소화 빌드(Minimal Install)된 클라우드 우분투 이미지에서 자주 발생합니다.
- **조치**: `sudo apt install -y software-properties-common`을 수행하여 저장소 관리 명령 도구를 탑재한 후 재시도하십시오.

#### 로컬 타임존 변경 필요성
PHP가 시스템 내부 날짜 함수를 처리할 때 기준 시각 에러를 뿜는 경우가 있습니다. `/etc/php/8.3/fpm/php.ini` 파일을 편집기(Nano 등)로 열어 `date.timezone` 설정을 서울 기준으로 변경 후 재시작합니다.
```ini
; php.ini 수정
date.timezone = Asia/Seoul
```
```bash
# FPM 프로세스 재가동
sudo systemctl restart php8.3-fpm
```
