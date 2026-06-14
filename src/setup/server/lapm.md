---
layout: php
title: Linux LAMP / LEMP 통합 웹 서버 환경 구축 완벽 가이드
description: "리눅스(Ubuntu/Rocky)에서 Nginx 및 Apache 웹 서버와 PHP-FPM(FastCGI) 프로세스를 연동하고, SELinux 보안 해제, 502 에러 대처법 및 FPM 성능 튜닝법을 상세히 배웁니다."
keyword: "LAMP stack, LEMP stack, Nginx php-fpm 연동, 아파치 FastCGI 설정, 리눅스 php mysql 설치, SELinux httpd_can_network_connect, php-fpm 튜닝"
breadcrumb:
- setup
- server
- lapm
---

# Linux LAMP / LEMP 통합 웹 서버 구축
---
**LAMP**는 **L**inux + **A**pache + **M**ySQL + **P**HP의 약어이며, **LEMP**는 Apache 대신 가볍고 비동기 처리에 최적화된 **E**ngine-X(Nginx) 웹 서버를 활용하는 구성 방식입니다.

과거 로컬/개발 테스트용으로 배포되던 비트나미(Bitnami) 리눅스용 단독 패키지 인스톨러는 공식 중단 및 지원 종료되었습니다. 따라서 현대 리눅스 인프라 환경에서는 **운영체제 패키지 매니저(APT, DNF)를 사용하여 웹 서버와 PHP-FPM을 직접 엮고 연동**하는 방식이 글로벌 업계 표준이자 유일한 정석 방식입니다.

이 가이드에서는 Native Linux 환경에서 Apache, Nginx, MySQL, PHP-FPM 패키지를 상호 결합하고 트러블슈팅 및 튜닝하는 노하우를 깊이 있게 다룹니다.

<br>

### 1. 웹 서버 연동 모델 비교: mod_php vs PHP-FPM
---
리눅스 서버에서 PHP는 웹 서버(Nginx/Apache)와 프로세스 분리형인 **FastCGI (PHP-FPM)** 구조로 조립되는 것이 일반적입니다.

아래 다이어그램은 웹 서버 자체에 PHP 인터프리터를 내장해 쓰던 고전적인 `mod_php` 방식과, 정적 처리 및 동적 번역을 철저히 격리 통신하여 구동하는 현대적인 **PHP-FPM** 방식의 자원 효율 차이를 직관적으로 보여줍니다.

![mod_php vs PHP-FPM 연동 모델 비교](/setup/img/apache_vs_fpm.svg)

- **mod_php (내장형)**: 단순 이미지/CSS 파일 요청 시에도 웹서버가 무거운 PHP 인터프리터를 함께 메모리에 올리므로 자원 낭비가 매우 크고 병목이 심합니다.
- **PHP-FPM (독립 격리형)**: 웹 서버(Nginx/Apache)는 무겁고 느린 연산 없이 정적 파일을 다이렉트로 전송하고, 오직 `.php` 구문 요청이 왔을 때만 FastCGI 소켓 통신을 통해 백그라운드의 PHP-FPM 프로세스로 처리를 넘겨 대단히 가볍고 빠릅니다.

<br>

### 2. 패키지 설치 단계
---

#### 1) Ubuntu / Debian 계열 (APT)
```bash
sudo apt update
# Nginx 또는 Apache(apache2), MySQL, PHP-FPM 및 필수 결합 드라이버 설치
sudo apt install -y nginx apache2 mysql-server php8.3-fpm php8.3-mysql
```

#### 2) Rocky Linux / RHEL 계열 (DNF)
```bash
# EPEL 및 Remi 저장소 등록
sudo dnf install -y epel-release https://rpms.remirepo.net/enterprise/remi-release-9.rpm
sudo dnf module reset php -y
sudo dnf module enable php:remi-8.3 -y

# Nginx 또는 Apache(httpd), MariaDB, PHP-FPM 설치
sudo dnf install -y nginx httpd mariadb-server php php-fpm php-mysqlnd
```

<br>

### 3. 웹 서버별 PHP-FPM FastCGI 연동 환경설정
---
서버 설치 완료 후 웹 서버 설정 파일을 수정하여 `.php` 요청을 PHP-FPM 소켓(Socket)으로 릴레이하도록 설정합니다.

#### 1) Nginx 연동 구성 (`nginx.conf` 또는 가상 호스트)
Nginx 기본 가상 호스트 설정 파일(Ubuntu: `/etc/nginx/sites-available/default`)을 열고 아래 지시문을 작성합니다.
```nginx
server {
    listen 80;
    root /var/www/html;
    index index.php index.html;
    server_name localhost;

    location / {
        try_files $uri $uri/ =404;
    }

    # .php로 끝나는 동적 요청 감지 시 FastCGI 유닉스 소켓으로 릴레이
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        
        # PHP-FPM 버전 및 경로 매핑 확인 (Ubuntu 8.3 예시)
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
    }
}
```

#### 2) Apache 연동 구성 (Apache 2.4.x + `mod_proxy_fcgi`)
과거처럼 `mod_php`를 쓰지 않고, Apache 웹 서버에서도 백엔드에 독립 실행 중인 PHP-FPM과 소켓 통신하도록 가상 호스트 지시문 내부에 프록시 통로를 설계합니다.
```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html
    
    # Apache 웹 루트 내부의 모든 .php 요청을 PHP-FPM Unix Socket 파일로 토스
    <FilesMatch \.php$>
        SetHandler "proxy:unix:/var/run/php/php8.3-fpm.sock|fcgi://localhost"
    </FilesMatch>

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

<br>

### 4. 2대 필수 리눅스 환경 트러블슈팅 (Troubleshooting)
---

#### 1) Nginx 접속 시 `502 Bad Gateway` 오류 (소켓 권한 문제)
- **원인**: Nginx 웹 서버 프로세스(수행 계정: `www-data` 또는 `nginx`)가 PHP-FPM 소켓 파일(`.sock`)에 접근해 쓰기 작업을 할 수 있는 읽기/쓰기 권한이 결여되어 통신이 단절된 현상입니다.
- **해결책**: PHP-FPM 풀 설정 파일(예: `/etc/php/8.3/fpm/pool.d/www.conf`)을 열고 아래 소켓 권한 부여 지시어 주석을 해제하고 소유자와 그룹을 웹 서버 소유 계정명에 부합되게 수정합니다.
  ```ini
  listen.owner = www-data
  listen.group = www-data
  listen.mode = 0660
  ```
  수정 후 `sudo systemctl restart php8.3-fpm`을 가동해 권한을 갱신합니다.

#### 2) Rocky Linux / CentOS 구동 시 `503 Service Unavailable` 또는 연결 오류
- **원인**: RedHat 계열 리눅스의 내장 강력한 보안 모듈인 **SELinux (Security-Enhanced Linux)** 정책에 의해 웹 서버 프로세스가 외부 소켓이나 네트워크 통신망을 타는 행위가 사전에 격리 및 제어되어 발생하는 거부 현상입니다.
- **해결책**: 터미널에 아래 정책 승인 플래그 명령어를 입력하여 SELinux 방화벽 벽을 허용 상태로 개방합니다.
  ```bash
  # 웹 서버(httpd/nginx) 프로세스가 네트워크 연결 및 프록시 소켓을 탈 수 있도록 허용
  sudo setsebool -P httpd_can_network_connect 1

  # 웹 서버 프로세스가 백엔드 데이터베이스 포트(3306)에 원격 연결할 수 있도록 허용
  sudo setsebool -P httpd_can_network_connect_db 1
  ```

<br>

### 5. 고성능 운영을 위한 PHP-FPM 워커 풀(Worker Pool) 튜닝
---
FPM 설정 파일(`/etc/php/8.3/fpm/pool.d/www.conf`)의 프로세스 수 제어 옵션을 조정하여 동시 접속 대응 성능을 극대화합니다.

```ini
; 프로세스 관리 방식 정의 (dynamic: 접속량에 따라 유동 제어, static: 고정 개수 할당)
pm = dynamic

; 1. 서버 부하 폭증 시 동시에 떠 있을 수 있는 최대 FPM 자식 프로세스(Worker) 개수
pm.max_children = 50

; 2. FPM 마스터 프로세스 기동 시 최초에 미리 생성해 둘 예비 워커 개수
pm.start_servers = 10

; 3. 대기 상태의 최소 예비 워커 한도 (이보다 적어지면 즉시 추가 워커 가동)
pm.min_spare_servers = 5

; 4. 대기 상태의 최대 예비 워커 한도 (이보다 늘어나면 오버헤드 방지를 위해 워커 소멸)
pm.max_spare_servers = 20

; 5. 워커 개별 프로세스가 메모리 누수 방지를 위해 강제 재기동되기 전까지 처리할 최대 누적 요청 수
pm.max_requests = 500
```

> [!TIP]
> **최적 자식 프로세스(`max_children`) 개수 산정 공식**
> 서버 전체 메모리가 `8GB`이고 데이터베이스 및 시스템 점유에 `3GB`를 뺀 여유 메모리가 `5GB`일 때, 단일 `php-cgi` 워커 프로세스가 평균 `40MB`에서 `50MB` 수준의 메모리를 사용한다면 다음과 같이 최대 한도를 구성할 수 있습니다.
> $$ \text{pm.max\_children} = \frac{\text{여유 메모리 (5000MB)}}{\text{워커 평균 메모리 (50MB)}} = 100 $$

<br>

### 6. 웹 서버별 깊이 있는 세부 연동 가이드
---
기본적인 연동 패키지 구성 외에, 각 웹 서버가 가진 성능적 강점을 활용하고 가상 호스트 분리 및 세부 보안 설정을 완료하려면 아래 가이드를 활용해 추가 학습해 보시기 바랍니다.

- **[Apache 웹 서버와 PHP 연동 가이드](apache)**: Apache의 고성능 다중 스레드 구동 모델인 Event MPM 설정 방법, 여러 도메인을 하나의 서버에서 호스팅하는 가상 호스트(`VirtualHost`) 선언 요령, 그리고 `.htaccess` 파일을 활용하여 프레임워크 전용 깔끔한 라우팅 URL(Pretty URL)을 생성하는 `mod_rewrite` 기법을 상세히 설명합니다.
- **[Nginx 웹 서버와 PHP-FPM 연동 가이드](nginx)**: Nginx의 비동기 논블로킹 강점을 극대화하는 서버 블록(`server {}`) 구성 법, UNIX 도메인 소켓 vs TCP 포트 연동 통신망 선택 가이드, 그리고 업로드 파일을 이용한 우회 스크립트 실행 공격을 방지하는 `cgi.fix_pathinfo` 취약점 대응 지침을 정리합니다.
