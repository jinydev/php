---
layout: php
title: "프레스타숍 설치"
keyword: "prestashop, symfony based shop, php e-commerce, install prestashop"
description: "Symfony 프레임워크 기반의 글로벌 대표 오픈소스 이커머스 솔루션인 프레스타숍의 요구사항 및 설치 단계를 학습합니다."
breadcrumb:
- setup
- "apps"
- "prestashop"
---

<jiny-book-mark>프레스타숍 설치</jiny-book-mark>

# 프레스타숍 (PrestaShop) 설치 가이드
---
**프레스타숍(PrestaShop)**은 유럽 및 글로벌 시장에서 큰 인기를 끌고 있는 오픈소스 이커머스(쇼핑몰) 플랫폼입니다. 최신 버전들은 PHP의 모던 프레임워크인 **Symfony(심포니)**를 베이스 커널로 차용하여 결합함으로써 아키텍처적 안정성과 개발자 친화적인 확장 구조를 제공합니다.

<br>

## 1. 사전 요구사항 (Requirements)
---
쇼핑몰의 안전한 상품 결제, 영수증 PDF 빌드, 다국어 처리 등을 위해 다음 요구사항을 충족해야 합니다.
* **PHP**: 8.0 또는 8.1 버전 (PrestaShop 8.x 이상 기준)
* **데이터베이스**: MySQL 5.7 이상 또는 MariaDB 10.4 이상
* **웹 서버**: Apache (mod_rewrite 활성화 권장) 또는 Nginx
* **필수 PHP 확장 모듈**: `php-curl`, `php-dom`, `php-fileinfo`, `php-gd`, `php-intl`, `php-mbstring`, `php-openssl`, `php-pdo_mysql`, `php-simplexml`, `php-zip`

<br>

## 2. 데이터베이스 설정 (Database Setup)
---
쇼핑몰의 상품, 회원, 주문 및 결제 내역을 보존할 데이터베이스와 계정을 생성합니다.

```sql
-- MySQL/MariaDB 서버 접속 후 실행
CREATE DATABASE prestashop DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 전용 유저 생성 및 스키마 권한 위임
CREATE USER 'ps_user'@'localhost' IDENTIFIED BY 'ps_password123!';
GRANT ALL PRIVILEGES ON prestashop.* TO 'ps_user'@'localhost';

-- 데이터 정합성 적용 및 종료
FLUSH PRIVILEGES;
EXIT;
```

<br>

## 3. 프레스타숍 다운로드 및 준비
---
공식 배포본 Zip 파일을 다운로드하여 압축을 해제합니다. 프레스타숍의 배포본은 더블 Zip 구조로 되어 있는 것이 특징입니다.

```bash
# PrestaShop 최신 릴리즈 패키지 다운로드
wget https://github.com/PrestaShop/PrestaShop/releases/download/8.1.2/prestashop_8.1.2.zip

# 압축 해제
unzip prestashop_8.1.2.zip -d /var/www/html/

# 압축을 푼 폴더 내부 소유권 설정
sudo chown -R www-data:www-data /var/www/html/
```

웹 루트 디렉터리로 이동하면 `prestashop.zip` 파일과 `index.php` 인스톨 게이트웨이 파일이 존재하게 되며, 최초 접속 시 자동으로 나머지 코어 파일들의 압축 해제가 내부적으로 이루어집니다.

<br>

## 4. 웹 페이지 인스톨러 구동
---
웹 브라우저로 `http://localhost/` 또는 도메인 주소에 접근하면 자동으로 프레스타숍 설치 마법사가 실행됩니다.

1. **설치 언어 선택**: 한국어 또는 영어 등을 선택하고 [Next]를 클릭합니다.
2. **라이선스 승인**: 조건에 동의함을 선택하고 다음으로 넘어갑니다.
3. **시스템 환경 검사**: 웹 서버 권한이나 필수 PHP 모듈이 올바른지 진단합니다. 경고가 있는 부분을 보강해야 설치를 계속할 수 있습니다.
4. **상점 정보 입력**: 쇼핑몰 이름, 주요 카테고리, 관리자 이메일 주소 및 백오피스 로그인 비밀번호를 설정합니다.
5. **데이터베이스 설정 입력**:
   - 데이터베이스 서버 주소: `localhost`
   - 데이터베이스 이름: `prestashop`
   - 데이터베이스 사용자 계정: `ps_user`
   - 데이터베이스 패스워드: `ps_password123!`
   - 테이블 접두사: `ps_`
   - [Test your database connection now!] 버튼을 눌러 연결 상태가 정상인 것을 확인한 후 다음 단계로 진입합니다.
6. **설치 진행**: 자동으로 데이터베이스 테이블이 생성되고 상점 기본값 설정이 이행됩니다.

<br>

## 5. 중요 보안 수칙: 설치 완료 후 사후 작업
---
설치가 성공적으로 완료된 후, 상점 보안 유출을 방지하기 위해 서버 터미널에서 반드시 다음 보안 조치를 수행해야 합니다.

### install 폴더 영구 삭제
웹 루트 경로에 남아 있는 설치 전용 폴더를 삭제해야만 브라우저를 통한 중복 설치 시도나 내부 스키마 탈취 시도를 차단할 수 있습니다.
```bash
sudo rm -rf /var/www/html/install/
```

### admin 관리자 폴더명 확인
프레스타숍은 설치 완료 후 보안 강화를 위해 기존 `/var/www/html/admin/` 폴더를 임의의 이름(예: `/var/www/html/admin832xqy/`)으로 자동 변경합니다. 따라서 쇼핑몰의 관리자 백오피스 페이지로 진입하려면 바뀐 임의의 폴더명 주소(`http://yourdomain.com/admin832xqy`)로 접속해야 합니다.
