---
layout: php
title: Linux 서버 환경의 PHP 설치 가이드
description: "Ubuntu 및 Rocky Linux 서버 환경에서 패키지 매니저(APT, DNF)와 외부 저장소(PPA, Remi)를 활용하여 최신 PHP 8.x 버전을 안정적으로 설치하고 운영하는 종합 인프라 설계를 해설합니다."
keyword: "리눅스 php 설치, linux php setup, 우분투 php 설치, Rocky linux php install, wsl php 설치, LAPM 이란, 리눅스 웹서버"
breadcrumb:
- setup
- linux
---

# Linux 서버 환경의 PHP 설치 가이드
---
웹 서비스의 성능과 안정성이 최우선시되는 프로덕션(실제 서비스) 서버 환경에서 가장 압도적인 비율로 사용되는 운영체제는 단연 **Linux**입니다. 

리눅스는 윈도우와 달리 GUI 자원 오버헤드 없이 온전히 서버 프로세스 자원만을 활성화할 수 있어 대량의 접속자를 신속하게 서빙하는 데 매우 유리합니다. 이 문서에서는 리눅스 개발 및 구동을 위한 기본 지식과 함께, 각 용도별로 대폭 보강된 세부 가이드 리스트를 안내합니다.

<br>

### 1. Linux 환경의 웹 요청 연동 아키텍처
---
리눅스 서버에서 PHP는 웹 서버(Nginx/Apache)와 프로세스 분리형인 **FastCGI (PHP-FPM)** 구조로 조립되는 것이 일반적입니다. 아래 아키텍처는 클라이언트 요청이 소켓(Socket) 통신을 거쳐 PHP-FPM 워커 풀로 라우팅되는 관계를 나타냅니다.

![Linux PHP-FPM 연동 아키텍처](/setup/img/linux_fpm_flow.svg)

<br>

### 2. Windows에서 Linux 구동하기 (WSL2 설정)
---
Windows 10/11 환경에서 추가적인 가상 머신(VirtualBox 등) 없이 가볍고 완벽하게 Ubuntu 리눅스를 실행하여 개발 환경을 매칭할 수 있습니다.

1. **WSL 설치**: 윈도우 시작 버튼을 우클릭하고 **[터미널(관리자)]** 또는 **[PowerShell(관리자)]**을 켭니다. 다음 명령어로 리눅스 커널 패키지를 내려받습니다.
   ```powershell
   wsl --install
   ```
2. **리눅스 실행**: 설치가 끝나고 컴퓨터를 재부팅하면 Microsoft Store에서 자동으로 다운로드된 **Ubuntu** 셸 창이 열립니다. 최초 실행 시 사용할 계정 아이디와 비밀번호를 생성해 줍니다.
3. **WSL 작동 점검**: 윈도우 CMD나 파워셸에서도 `wsl` 명령을 입력하면 바로 우분투 리눅스 셸에 접속하여 리눅스 전용 패키지 명령들을 구동할 수 있습니다.

<br>

### 3. LAPM 이란 무엇인가?
---
**LAPM**은 **L**inux + **A**pache + **P**HP + **M**ySQL의 각 머리글자를 결합한 기술 조합 단어입니다. (보통 데이터베이스 MySQL의 M이 뒤로 가 `LAMP` 스택으로 불리는 경우가 많으며, Apache 대신 **E**ngine-X(Nginx)를 사용하면 `LEMP` 스택이 됩니다.)

리눅스 서버 환경에서 웹서비스를 기동하기 위해 반드시 갖춰야 하는 웹서버, 해석 엔진, 영속 데이터베이스의 4대 핵심 인프라 레이어를 의미하며, 현대 웹 개발 역사상 가장 검증되고 범용적으로 널리 활용되는 오픈소스 결합 모델입니다.

<br>

### 4. 리눅스 환경 구성 세부 가이드 목록
---
원하는 설치 배포판이나 클라우드 환경, 또는 결합 타겟 웹서버의 종류에 맞게 아래의 상세 특화 가이드를 탐색해 보시기 바랍니다.

- **[LAPM/LEMP 통합 환경 구축 가이드](../server/lapm)**: 리눅스 배포판 전체를 관통하는 패키지 설치 기본 지침, Nginx/Apache와 PHP-FPM 프로세스 간 연동 원리, UNIX 소켓 권한으로 인한 502 에러 대처법, SELinux 보안 해제 수칙 및 성능 극대화를 위한 FPM 워커 풀(Worker Pool) 튜닝 공식을 다룹니다.
- **[Ubuntu Linux 환경 PHP 설치 가이드](ubuntu)**: APT 패키지 매니저 및 Ondrej Surý PPA 외부 저장소를 등록하여 패키지 충돌 없이 최신 PHP 8.x 마이너/메이저 버전을 설치 및 업데이트하는 표준 절차를 정리합니다.
- **[Rocky Linux / RHEL 환경 PHP 설치 가이드](rocky)**: 기업 표준용 Rocky Linux 9 환경에서 Remi 저장소를 결합하여 모듈러 스트림(`dnf module enable`) 방식으로 최신 패키지를 깔끔하게 수급하고 활성화하는 가이드를 안내합니다.
- **[AWS 클라우드 환경 인프라 구축 가이드](../server/aws)**: 가상 컴퓨팅 인스턴스(EC2)와 완전 관리형 데이터베이스(RDS MySQL)를 프라이빗 네트워크(VPC) 및 보안 그룹(Security Groups)으로 긴밀히 차단 제어하는 3-Tier 기반 클라우드 구축 요령을 설명합니다.
- **[Apache 웹 서버 + PHP 상세 연동법](../server/apache)**: 프로세스 성능을 최적화하는 Event MPM 기법, 여러 사이트를 하나로 호스팅하는 VirtualHost 선언, 그리고 `.htaccess` 파일을 활용한 프런트 컨트롤러 리라이트(Rewrite) 제어 요령을 수록했습니다.
- **[Nginx 웹 서버 + PHP-FPM 상세 연동법](../server/nginx)**: UNIX 소켓 vs TCP 포트 통신망 차이 분석, Nginx의 대안 `try_files` 경로 라우팅 설정, 그리고 업로드 웹셸 공격을 방지하는 `cgi.fix_pathinfo` 취약점 대응 지침을 정리합니다.
