---
layout: php
title: "워드프레스 설치"
keyword: "wordpress, php cms, wordpress install, mysql setup"
description: "PHP 기반의 세계 대표 콘텐츠 관리 시스템(CMS)인 워드프레스의 인프라 요구사항 및 상세 설치 단계를 학습합니다."
breadcrumb:
- setup
- "apps"
- "wordpress"
---

<jiny-book-mark>워드프레스 설치</jiny-book-mark>

# 워드프레스 (WordPress) 설치 가이드
---
**워드프레스(WordPress)**는 전 세계 웹사이트의 약 40% 이상을 구동시키고 있는 세계 점유율 1위의 PHP 기반 오픈소스 콘텐츠 관리 시스템(CMS)입니다. 수많은 플러그인과 테마 생태계를 바탕으로 단순 블로그부터 대형 기업 사이트, 쇼핑몰까지 자유롭게 구축할 수 있습니다.

<br>

## 1. 사전 요구사항 (Requirements)
---
워드프레스를 수동 설치하기 위해 필요한 서버 및 소프트웨어 권장 사양입니다.
* **PHP**: 7.4 버전 이상 (PHP 8.x 권장)
* **데이터베이스**: MySQL 5.7 이상 또는 MariaDB 10.4 이상
* **웹 서버**: Nginx 또는 Apache
* **필수 PHP 확장 모듈**: `php-mysql`, `php-curl`, `php-gd`, `php-mbstring`, `php-xml`, `php-zip`, `php-imagick`

<br>

## 2. 데이터베이스 설정 (Database Setup)
---
설치를 진행하기 전, 워드프레스가 사용할 전용 데이터베이스와 사용자 계정을 데이터베이스 서버에 접속하여 생성해야 합니다.

```sql
-- MySQL/MariaDB 서버에 루트 권한으로 접속 후 실행
CREATE DATABASE wordpress DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 전용 유저 생성 및 권한 설정
CREATE USER 'wp_user'@'localhost' IDENTIFIED BY 'wp_password123!';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wp_user'@'localhost';

-- 변경 사항 변경 적용
FLUSH PRIVILEGES;
EXIT;
```

<br>

## 3. 워드프레스 다운로드 및 압축 해제
---
서버 터미널에서 워드프레스 공식 최신 코어 파일을 다운로드하고 웹 서버의 서비스 디렉터리(Web Root)로 배치합니다.

```bash
# 최신 한글판 워드프레스 압축 파일 다운로드
wget https://ko.wordpress.org/latest-ko_KR.tar.gz

# 압축 해제
tar -zxvf latest-ko_KR.tar.gz

# 해제된 폴더의 파일들을 웹 서버의 루트 디렉터리로 이동 (예: Apache 기본값)
sudo mv wordpress/* /var/www/html/

# 다운로드한 압축 파일 정리
rm latest-ko_KR.tar.gz
```

<br>

## 4. 디렉터리 권한 부여
---
웹 서버 프로세스(Apache의 `www-data` 또는 Nginx의 `nginx`)가 워드프레스 파일들을 읽고 쓸 수 있도록 소유권과 쓰기 권한을 조절합니다.

```bash
# 웹 서버 실행 소유자를 www-data로 지정 (Ubuntu 계열)
sudo chown -R www-data:www-data /var/www/html/

# 디렉터리 권한 부여
sudo find /var/www/html/ -type d -exec chmod 755 {} \;
sudo find /var/www/html/ -type f -exec chmod 644 {} \;
```

<br>

## 5. 웹 설치 마법사 진행
---
위 과정이 정상적으로 완료되었다면, 웹 브라우저를 열고 서버의 IP 주소 또는 도메인(예: `http://localhost` 혹은 `http://yourdomain.com`)으로 접속합니다.

1. **환영 및 데이터베이스 설정 안내**: [Let's go!] 버튼을 누릅니다.
2. **데이터베이스 연결 정보 입력**:
   - 데이터베이스 이름: `wordpress`
   - 사용자명: `wp_user`
   - 비밀번호: `wp_password123!`
   - 데이터베이스 호스트: `localhost`
   - 테이블 접두사: `wp_` (보안을 위해 다른 이름으로 변경하는 것을 권장합니다. 예: `wp_secure_`)
3. **설치 실행**: 정보 검증이 끝나면 [Run the installation] 버튼을 누릅니다.
4. **사이트 기본 정보 입력**:
   - 사이트 제목 (Site Title)
   - 관리자 아이디 (Username)
   - 비밀번호 (Password)
   - 이메일 주소 (Email Address)
5. **완료**: 설치가 끝나면 설정한 관리자 아이디로 로그인을 수행하여 워드프레스 대시보드로 진입할 수 있습니다.
