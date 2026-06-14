---
layout: php
title: "넥스트클라우드 설치"
keyword: "nextcloud, private cloud setup, self-hosted web drive, mysql"
description: "PHP 기반의 자체 구축형 클라우드 드라이브 및 협업 플랫폼인 넥스트클라우드의 설치 및 최적화 단계를 학습합니다."
breadcrumb:
- setup
- "apps"
- "nextcloud"
---

<jiny-book-mark>넥스트클라우드 설치</jiny-book-mark>

# 넥스트클라우드 (Nextcloud) 설치 가이드
---
**넥스트클라우드(Nextcloud)**는 구글 드라이브, 드롭박스 등 상용 클라우드 서비스를 대체할 수 있는 자가 설치형(Self-Hosted) 웹 드라이브 솔루션입니다. 파일 동기화 외에도 일정 공유, 연락처, 온라인 문서 공동 편집 및 화상 채팅 등의 풍부한 플러그인 생태계를 보유하고 있습니다.

<br>

## 1. 사전 요구사항 (Requirements)
---
대용량 파일 읽기/쓰기를 처리하기 때문에 파일 핸들링 및 암호화 처리를 위한 필수 모듈이 요구됩니다.
* **PHP**: 8.0 버전 이상 (PHP 8.2+ 권장)
* **데이터베이스**: MySQL 8.0+ / MariaDB 10.6+ 또는 PostgreSQL 12+
* **웹 서버**: Apache 또는 Nginx (경로 변조 취약점 차단 규칙 적용 필요)
* **필수 PHP 확장 모듈**: `php-ctype`, `php-curl`, `php-dom`, `php-gd`, `php-iconv`, `php-json`, `php-libxml`, `php-mbstring`, `php-posix`, `php-simplexml`, `php-xmlreader`, `php-xmlwriter`, `php-zip`, `php-zlib`, `php-pdo_mysql`

<br>

## 2. 데이터베이스 설정 (Database Setup)
---
넥스트클라우드가 저장할 파일의 메타데이터 및 권한, 로그 정보를 저장할 전용 데이터베이스를 구축합니다.

```sql
-- MySQL/MariaDB 접속 후 실행
CREATE DATABASE nextcloud DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 전용 계정 생성 및 모든 제어 권한 인계
CREATE USER 'nc_user'@'localhost' IDENTIFIED BY 'nc_password123!';
GRANT ALL PRIVILEGES ON nextcloud.* TO 'nc_user'@'localhost';

-- 즉시 적용 및 종료
FLUSH PRIVILEGES;
EXIT;
```

<br>

## 3. 넥스트클라우드 다운로드 및 권한 설정
---
공식 웹사이트에서 최신 아카이브를 받아 웹 서버 디렉터리에 배포합니다.

```bash
# Nextcloud 공식 Zip 아카이브 다운로드
wget https://download.nextcloud.com/server/releases/latest.zip

# 압축 해제 프로그램이 없다면 설치 (Ubuntu 기준)
sudo apt update && sudo apt install unzip -y

# 압축 해제
unzip latest.zip

# 웹 서버 디렉터리로 이동
sudo mv nextcloud /var/www/html/

# 데이터 및 임시 폴더 소유권 부여
sudo chown -R www-data:www-data /var/www/html/nextcloud/
sudo chmod -R 755 /var/www/html/nextcloud/
```

<br>

## 4. 웹 페이지 설정 마법사 구동
---
브라우저에서 `http://localhost/nextcloud`로 진입합니다.

1. **관리자 계정 생성**:
   - 사용할 관리자의 아이디와 비밀번호를 새로 설정합니다.
2. **데이터 및 데이터베이스 폴더 지정**:
   - 데이터 폴더: 기본값은 `/var/www/html/nextcloud/data`로 설정되어 있으나, 보안을 위해 무들과 마찬가지로 웹 루트 외부 경로(예: `/var/nextcloud_data`)로 설정하는 것을 적극 권장합니다.
3. **데이터베이스 설정 입력**:
   - 사용자: `nc_user`
   - 암호: `nc_password123!`
   - 데이터베이스 이름: `nextcloud`
   - 호스트: `localhost`
4. **설치 완료**: [설치 완료(Finish Setup)] 버튼을 클릭하면 메인 클라우드 파일함 대시보드로 이동합니다.

<br>

## 5. 최적화를 위한 필수 추가 권장 조치
---
성공적인 설치 완료 이후, 안정적이고 빠른 상용 서비스를 가동하기 위해 서버단에 다음 설정을 필수로 진행해야 합니다.

### HTTPS 필수 강제화
사용자의 로그인 패스워드와 기밀 파일들이 평문으로 중간에 가로채 지는 것을 막기 위해, 웹 서버에 SSL 인증서(Let's Encrypt 등)를 탑재하고 HTTPS 주소로만 접속할 수 있도록 조치해야 합니다.

### 메모리 캐시 연동 (Redis / APCu)
동시 접속자 수가 많아질 때 로딩 속도 저하와 데이터베이스 락(Lock)을 방지하기 위해 `php.ini` 및 Nextcloud의 `config/config.php` 파일에 Redis를 캐시 엔진으로 연동해 성능을 튜닝합니다.

### 시스템 크론(Cron) 작업 적용
기본 상태에서는 사용자가 웹 페이지를 요청할 때마다 백그라운드 청소 작업이 이루어지는 `AJAX` 방식으로 동작합니다. 이는 서버 성능을 낭비하므로, OS 자체의 `crontab` 스케줄러에 등록하여 5분마다 작업이 백그라운드 실행되도록 세팅해야 합니다.
```bash
# www-data 계정의 crontab 설정 열기
sudo crontab -u www-data -e

# 아래 내용 추가
*/5 * * * * php -f /var/www/html/nextcloud/cron.php
```
