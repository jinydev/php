---
layout: php
title: PHP 설치 및 개발 환경 구축 완벽 가이드
keyword: "php설치, php setup, 윈도우 php 설치, 맥 php 설치, 리눅스 php 설치, 우분투 php, 로키 리눅스 php, 도커 php, aws php, php 로컬 서버, 아파치 nginx php-fpm"
description: "로컬 개발 환경(Windows/macOS)부터 가상화(Docker), 클라우드(AWS), 리눅스 서버(Ubuntu/Rocky) 구축 및 아파치/Nginx 웹서버 연동까지 PHP 구동 환경을 마스터합니다."
breadcrumb:
- setup
---

# PHP 설치 및 개발 환경 구축
---
PHP는 개인 개발용 PC(Windows, macOS)부터 엔터프라이즈급 고성능 리눅스 웹 서버, 컨테이너 환경(Docker), 그리고 퍼블릭 클라우드(AWS)에 이르기까지 폭넓은 환경에 유연하게 대입될 수 있는 강력한 서버사이드 언어입니다.

이 장에서는 로컬 개발 단계에서 유용한 내장 서버 실행 방법부터, 실서비스 배포 시 마주하게 되는 웹 서버 연동 및 클라우드 아키텍처 구성까지 7가지 주요 설치 및 운영 방식을 심층적으로 살펴봅니다.

<br>

### 1. PHP 인프라 가동 환경 아키텍처
---
아래 다이어그램은 PHP가 동작할 수 있는 주요 로컬 개발 및 컨테이너 가상화 환경과, 실제 가동되는 클라우드/리눅스 프로덕션 서버 환경의 관계를 전체적으로 보여줍니다.

![PHP 설치 및 운영 환경 아키텍처](/setup/img/setup_environments.svg)

<br>

### 2. Windows 설치 및 통합 환경 구축
---
윈도우 환경에서 PHP를 실행하고 테스트하는 방식은 크게 수동 파일 다운로드 방식과 통합 개발 서버 툴 설치 방식으로 나뉩니다.

#### 1) 수동 다운로드 및 환경변수(Path) 설정
1. 윈도우용 PHP 공식 빌드 사이트([windows.php.net](https://windows.php.net/download/))에 접속합니다.
2. 일반적인 웹 연동 및 개발용으로 **Thread Safe** 버전의 Zip 압축파일(x64 권장)을 다운로드합니다.
3. `C:\php` 폴더를 생성하고 압축파일을 해제합니다.
4. 윈도우 시스템 환경 변수 설정으로 이동하여 **`Path`** 시스템 변수에 `C:\php` 경로를 추가합니다.
5. 폴더 내부의 `php.ini-development` 파일을 복사하여 **`php.ini`**로 이름을 변경합니다.
6. 명령 프롬프트(cmd)를 열고 `php -v`를 입력하여 설치를 확인합니다.

#### 2) 로컬 통합 패키지 활용 (Laragon / XAMPP)
웹서버(Apache)와 데이터베이스(MySQL)가 원클릭으로 묶여 로컬 개발환경을 잡아주는 도구입니다.
- **Laragon (강력 추천)**: 현대 PHP 생태계(Composer, SSL 자동화, Pretty URLs)에 매우 친화적이며 리소스 점유가 낮아 윈도우 개발 환경에서 가장 사랑받고 있습니다.
- **XAMPP / Bitnami WampStack**: 고전적이고 안정적인 APM 통합 툴로 널리 쓰입니다.

<br>

### 3. macOS 개발 환경 구축 (Homebrew)
---
Apple macOS 환경에서는 오픈소스 패키지 매니저인 **Homebrew**를 통해 가장 깔끔하고 신속하게 최신 PHP 환경을 이식할 수 있습니다.

#### 1) Homebrew를 이용한 PHP 설치
터미널을 열고 다음 명령어를 입력합니다.
```bash
# 최신 패키지 리스트 갱신
brew update

# PHP 설치 진행 (기본적으로 최신 안정화 버전이 설치됨)
brew install php
```

#### 2) 서비스 관리 및 설정 위치
- **설치 확인**: `php -v`로 작동 여부를 체크합니다.
- **서비스 가동**: macOS 부팅 시 백그라운드 데몬으로 자동 가동시키려면 아래 명령을 씁니다.
  ```bash
  brew services start php
  ```
- **설정 파일 위치**: 애플 실리콘(M1, M2, M3 등) 맥 기준 Homebrew의 기본 패키지 및 `php.ini` 설정 경로는 다음과 같습니다.
  - PHP 실행 파일: `/opt/homebrew/bin/php`
  - 환경 설정: `/opt/homebrew/etc/php/8.x/php.ini`

<br>

### 4. Linux 프로덕션 서버 구축 (Ubuntu / Rocky Linux)
---
실제 비즈니스 환경에서 가장 압도적인 점유율을 차지하는 인프라 구조로, 리눅스 배포판 계열별 전용 패키지 관리자를 사용해 서비스를 구성합니다.

#### 1) Ubuntu / Debian 계열
우분투 서버에서는 기본 패키지 저장소(APT)를 통해 즉시 안정적인 엔진을 안착시킬 수 있습니다.
```bash
sudo apt update
# PHP CLI 엔진 및 웹서버 연동용 FPM 모듈, 주요 확장 라이브러리 일괄 설치
sudo apt install -y php php-cli php-fpm php-mysql php-xml php-mbstring php-curl
```

#### 2) Rocky Linux / RHEL 계열 (Rocky 9 기준)
레드햇 계열 리눅스에서는 기본 제공 패키지 외에 공식 PHP 컴파일 아카이브인 **Remi Repository**를 등록하여 8.x 최신 버전을 선별 설치하는 것이 정석입니다.
```bash
# 1. EPEL 및 Remi 저장소 등록
sudo dnf install -y epel-release
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm

# 2. 기본 내장 PHP 모듈 리셋 및 Remi 활성화
sudo dnf module reset php -y
sudo dnf module enable php:remi-8.3 -y # 예시: 8.3 버전 활성화

# 3. PHP 및 핵심 확장 팩 설치
sudo dnf install -y php php-cli php-fpm php-mysqlnd php-gd php-xml php-mbstring
```

<br>

### 5. Docker 컨테이너 가상화 실행 환경
---
로컬 컴퓨터 호스트 환경에 별도로 PHP 패키지를 설치하거나 운영체제 환경을 더럽히지 않고, 격리된 컨테이너 공간에서 깔끔하게 특정 PHP 버전을 기동 및 검증하는 가상화 인프라 기술입니다.

- **단일 CLI 실행**: `docker run` 명령어를 사용해 로컬 폴더를 컨테이너로 볼륨 마운트하고 1회성 스크립트 실행 후 즉각 프로세스를 파기합니다.
- **멀티 컨테이너 구성**: `docker-compose.yml` 설정을 통해 웹 서버(Nginx)와 PHP 엔진(PHP-FPM) 컨테이너를 브릿지 네트워크로 자동 엮어 로컬 풀스택 개발망을 구축할 수 있습니다.

> [!TIP]
> **Docker 기반의 세부 구성 기법을 학습하고 싶으신가요?**
> 상세한 볼륨 연동 원리, 각 포트 포워딩 구성의 흐름도, 그리고 Docker Compose 가동 명령어 모음 및 서비스 DNS 작동 규칙은 **[Docker 환경 구축 상세 가이드](docker)**에서 자세히 다루고 있으니 추가 확인해 보시기 바랍니다.

<br>

### 6. 퍼블릭 클라우드 AWS 상의 PHP 환경 구성 아키텍처
---
AWS(Amazon Web Services) 환경에서 PHP 웹 서비스를 신뢰성 있게 런칭하려면, 컴퓨팅 엔진과 데이터베이스 레이어를 독립 격리하는 3-Tier 기반 클라우드 아키텍처를 잡는 것이 표준입니다.

1. **EC2(Elastic Compute Cloud) 가상 인스턴스**: AWS 관리 콘솔에서 Linux OS(Ubuntu Server 또는 Amazon Linux 2023)를 탑재한 EC2 인스턴스를 프로비저닝합니다.
2. **보안 그룹(Security Group) 설정**:
   - 웹 서버용으로 인바운드 규칙에 **HTTP(80)** 및 **HTTPS(443)** 포트를 전 세계(`0.0.0.0/0`) 대상으로 개방합니다.
3. **RDS(Relational Database Service) 연동**: 데이터베이스는 EC2 내에 직접 설치하지 않고, 고가용성이 보장되는 AWS Managed DB인 RDS MySQL(또는 Aurora)을 별도로 생성합니다.
   - RDS 보안 그룹은 **EC2 인스턴스의 프라이빗 IP(또는 EC2 보안그룹 ID)**로부터 오는 3306 포트 접근만을 독점 허용하여 보안 통제 장벽을 높입니다.
4. **연동 패키지 구축**: EC2 서버 내부로 SSH 접속하여 `php-mysqlnd`와 `PDO` 드라이버를 이식한 뒤, RDS의 엔드포인트 도메인 주소를 PHP DB 연결 인자로 지정하여 서비스를 구동합니다.

<br>

### 7. 로컬 개발용 PHP 내장 웹 서버 실행
---
실서비스용 Apache나 Nginx를 수동 연동하려면 복잡한 가상 호스트 설정 과정이 수반됩니다. PHP 개발진은 로컬에서 즉시 단독 테스트 피드백 루프를 돌릴 수 있는 **내장 웹 서버(Built-in Web Server)** 기능을 엔진에 포함해 배포하고 있습니다.

- **실행 명령어**: 웹 소스코드가 위치한 폴더 내부에서 터미널을 열고 다음의 단 한 줄을 실행합니다.
  ```bash
  php -S localhost:8000
  ```
- **네트워크 전체 바인딩**: 외부 기기(모바일 등)나 테스트용 가상 기기에서 접속하게 하려면 루프백 주소가 아닌 전체 대역을 바인딩하여 켭니다.
  ```bash
  php -S 0.0.0.0:8000
  ```
- **동작 특징**: 가볍게 돌릴 수 있는 단일 스레드 구조로 로컬 디스크의 정적 파일 전송과 동적 PHP 스크립트 실행 처리를 동시에 소화합니다. 성능 가속화 기능이 없으므로 **절대로 실서비스 운영 환경에서는 사용하지 말고 로컬 개발/디버깅 용도로만 제한**해야 합니다. (종료는 `Ctrl + C`)

<br>

### 8. 웹서버 연동 방식 심층 비교 (Apache vs Nginx)
---
운영 서버 배포 단계에서는 웹서버가 앞단에 포진하여 클라이언트 요청을 수신하고, 뒷단의 PHP 컴파일 엔진과 데이터를 조율합니다. 이 연동 매커니즘은 웹서버 소프트웨어 종류에 따라 전혀 다르게 처리됩니다.

#### 1) Apache HTTPD + `mod_php` 방식 (프로세스 내장형)
- **원리**: Apache 웹 서버 내부 가동 프로세스 자체에 PHP 인터프리터 엔진을 **모듈(`mod_php.so`)**로 직접 적재하여 실행하는 전통적인 방식입니다.
- **장점**: 별도의 게이트웨이 데몬 없이 Apache 프로세스 내부에서 스크립트 번역이 직접 수행되므로 설정이 쉽고 조율 관리가 단순합니다.
- **단점**: 사용자의 요청(정적 이미지, CSS 파일 조회 포함)마다 무거운 PHP 엔진 메모리 덩어리가 통째로 올라가므로 **동시 접속자 폭증 시 메모리 점유율이 기하급수적으로 증가**해 서버가 다운될 위험이 큽니다.

#### 2) Nginx + `PHP-FPM` (FastCGI) 방식 (프로세스 격리형 - 모던 웹 표준)
- **원리**: 정적 콘텐츠 처리에 최적화된 초경량 이벤트 기반 웹서버 Nginx와, PHP 전 전용 프로세스 풀 매니저인 **`PHP-FPM` (FastCGI Process Manager)** 데몬을 분리 가동하여 포트 또는 유닉스 소켓(Socket) 인터페이스로 통신하게 격리 결합하는 구조입니다.
- **역할 분담**: Nginx는 단순 이미지/CSS/HTML 요청을 CPU 가용 리소스 낭비 없이 매우 민첩하게 직접 전송합니다. 오직 `.php` 동적 파일 연산 요청이 감지되었을 때만 그 내용을 **FastCGI 규격으로 포장해 PHP-FPM 프로세스로 던져 처리**하게 만듭니다.
- **장점**: 부하 분산(Load Balancing)과 자원 효율성이 월등하여 트래픽 대비 최적의 가용성과 메모리 점유 제어력을 실현할 수 있습니다. 현재 대규모 모던 PHP 서비스 인프라 구성의 **절대적인 기술적 표준**으로 자리 잡았습니다.

<br>

> [!TIP]
> **웹 서버 환경설정 세부 실무가 궁금하신가요?**
> 각 웹 서버의 실제 서비스용 지시어 구성법, 멀티 도메인 가상 호스트 설정법 및 다채로운 URL 리라이트(Rewrite) 기법을 더 심도 있게 연구하려면 아래의 독립 가이드를 참조하십시오.
> - **[Apache 웹 서버 + PHP 상세 연동법](server/apache)**: 프로세스 성능을 최적화하는 Event MPM 기법과 `.htaccess` 제어 요령을 수록했습니다.
> - **[Nginx 웹 서버 + PHP-FPM 상세 연동법](server/nginx)**: UNIX 소켓/TCP 포트 구성 비교, Nginx의 대안 `try_files` 라우팅 설정 및 파일 실행 취약점(`cgi.fix_pathinfo`) 예방 보안 옵션을 안내합니다.

<br><br>