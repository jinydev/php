---
layout: php
title: Vultr VPS 가상 서버를 이용한 PHP 환경 구축 가이드
description: "Vultr 클라우드 가상 서버(VPS) 인스턴스를 배포하고, 전용 방화벽(Firewall Group) 보안 설정, SSH 원격 접속 및 단일 인스턴스 내에 Nginx + PHP-FPM + MariaDB 스택을 결합하여 가볍고 견고한 가상 서버 환경을 구축하는 방법을 설명합니다."
keyword: "Vultr php, vultr vps 설치, vps php setup, vultr 방화벽 설정, 가상 서버 php, 리눅스 vps nginx, vultr ubuntu"
breadcrumb:
- setup
- server
- vultr
---

# Vultr VPS 가상 서버 환경의 PHP 구축 가이드
---
**Vultr(벌처)**는 전 세계 주요 도시에 고성능 SSD 기반의 가상 사설 서버(VPS, Virtual Private Server) 인스턴스를 초 단위로 신속히 프로비저닝할 수 있는 대표적인 클라우드 호스팅 서비스입니다. 

AWS가 복잡한 인프라 제어(VPC, 서브넷 등)를 동반하는 반면, Vultr는 비교적 가볍고 비용 효율적인 단일 인스턴스(One-Box) 구조로 웹 서버, WAS, DB를 한 장비에 조밀하게 구축하려는 독립형 서비스나 소규모 스타트업 프로젝트에 매우 적합합니다.

이 가이드에서는 Vultr 콘솔에서 인스턴스를 배포하고, 방화벽 규칙을 수립한 후 단일 리눅스 서버 내에 안전하게 PHP 환경을 안착시키는 전 과정을 설명합니다.

<br>

### 1. Vultr VPS 구축 아키텍처 개요
---
소규모 예산의 단일 VPS 환경에서는 웹 서버(Nginx), WAS(PHP-FPM), 데이터베이스(MariaDB)가 하나의 물리 OS 공간 내에서 함께 구동됩니다. 
이때의 핵심 보안 아키텍처는 **데이터베이스 포트(3306)를 공용 인터넷 인터페이스로 노출시키지 않고 오직 루프백(`127.0.0.1`)으로만 바인딩하여 격리 통신하는 것**입니다.

- **외부 트래픽**: 방화벽을 통과해 Nginx(80/443 포트)로만 들어옵니다.
- **내부 트래픽**: Nginx는 로컬 유닉스 소켓으로 PHP-FPM과 소통하고, PHP-FPM은 로컬 포트로 MariaDB와 쿼리를 송수신합니다.

<br>

### 2. Vultr VPS 인스턴스 생성 단계
---

#### 단계 1: 서버 배포 설정 (Deploy New Server)
1. Vultr 콘솔에 로그인 후 오른쪽 상단의 **[Deploy Server]** 버튼을 클릭합니다.
2. **Server Type**: 일반적으로 가장 저렴하고 성능이 보장되는 **Cloud Compute** (Shared vCPU) 또는 고성능 High Frequency 인스턴스를 선택합니다.
3. **Server Location**: 사용자와 지연 시간(Latency)이 가장 가까운 **Seoul (서울)** 리전을 클릭합니다.
4. **Operating System (OS)**: 가장 생태계가 두텁고 안정적인 **Ubuntu 24.04 LTS** (또는 22.04 LTS)를 선별합니다.
5. **Server Size**: 프로젝트 규모에 따라 적절한 요금제 플랜을 결정합니다. (개인/테스트용 개발 단계라면 월 $5 또는 $6 플랜의 1GB RAM / 1 vCPU 사양으로도 충분히 구동 가능합니다.)

#### 단계 2: SSH Key 등록 및 서버 기동
- 보안이 취약한 루트 비밀번호 로그인 대신, 로컬 PC에서 생성한 SSH 공개키(Public Key)를 콘솔의 **SSH Keys**에 미리 등록하고 할당하여 SSH 접속의 도용 리스크를 완벽히 예방합니다.
- 설정이 끝나면 최하단의 **[Deploy Now]**를 클릭합니다. 수 초 내에 서버 배포가 완료되며 공인 IP 주소(Public IP)가 부여됩니다.

<br>

### 3. Vultr 콘솔 방화벽 구성 (Firewall Group)
---
Vultr는 서버 내부에 방화벽 룰(`ufw` 등)을 기입하는 것 외에, 인프라 앞단에서 하드웨어 방화벽 차단벽인 **Firewall Group** 기능을 무료 제공합니다.
1. Vultr 메뉴 중 **[Products] -> [Network] -> [Firewall]**로 진입합니다.
2. **Add Firewall Group**을 눌러 그룹을 만듭니다.
3. 아래 수신(Inbound) 규칙들을 차례로 등록합니다.
   - **SSH (Port 22)**: 내 IP 대역(My IP)만 지정하여 허용 (무차별 대입 공격 원천 방지)
   - **HTTP (Port 80)**: 전체 개방 (`anywhere` 또는 `0.0.0.0/0`)
   - **HTTPS (Port 443)**: 전체 개방 (`anywhere` 또는 `0.0.0.0/0`)
4. 생성한 방화벽 그룹을 내가 생성한 VPS 인스턴스에 할당(Link)하여 활성화합니다. (이외의 포트는 외부에서 일체 두드릴 수 없게 격리됩니다.)

<br>

### 4. SSH 원격 접속 및 PHP LEMP 스택 구축
---
서버 구동이 완료되면 터미널을 열고 부여받은 공인 IP로 SSH 원격 접속하여 웹서버 패키지를 이식합니다.

```bash
# 1. SSH로 VPS 루트 계정 접속 (SSH Key 기반 인증)
ssh root@your_vultr_ip

# 2. OS 패키지 저장소 색인 동기화 및 갱신
apt update && apt upgrade -y

# 3. Nginx 웹서버, MariaDB 데이터베이스, PHP 8.3 엔진 및 FPM 모듈 일괄 설치
apt install -y nginx mariadb-server php8.3-fpm php8.3-mysql php8.3-cli php8.3-xml php8.3-mbstring php8.3-curl php8.3-gd php8.3-zip
```

<br>

### 5. 단일 서버 환경에서의 중요 보안 설정
---

#### 1) MariaDB 로컬 접속 독점 강제 (3306 외부 차단)
데이터베이스 설정 파일(Ubuntu: `/etc/mysql/mariadb.conf.d/50-server.cnf` 또는 `/etc/mysql/my.cnf`)을 열고 아래와 같이 바인드 주소가 로컬 루프백으로 한정되어 있는지 교차 확인합니다.
```ini
bind-address = 127.0.0.1
```
이 설정이 잡혀 있으면 외부 공인 IP 주소를 통해서는 데이터베이스 포트(3306)에 절대로 침입할 수 없으며, 오직 서버 내에서 작동 중인 PHP-FPM 프로세스만 로컬 접속할 수 있는 철통 보안이 구성됩니다.
```bash
# 설정 반영 후 DB 서비스 재시작
sudo systemctl restart mariadb
```

#### 2) 도메인 DNS A 레코드 연동
가비아, 후이즈 등 도메인 등록 대행사 네임서버 설정 페이지로 진입하여 내가 구매한 도메인(예: `myjiny.com`)의 **A 레코드 IP 타겟**으로 Vultr 콘솔에서 발급받은 **공인 IP 주소**를 매핑합니다.
이후 Nginx 서버 블록 설정 내의 `server_name` 항목에 해당 도메인을 등록하여 매치시킵니다.
```nginx
server {
    listen 80;
    server_name myjiny.com www.myjiny.com;
    ...
}
```

이제 브라우저 주소창에 내 도메인을 입력하여 접속하면 Vultr VPS 단일 장비 내에서 Nginx ➡️ PHP-FPM ➡️ MariaDB로 이어지는 고속의 격리형 트랜잭션이 수행됩니다.
