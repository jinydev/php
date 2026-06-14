---
layout: php
title: "무들 설치"
keyword: "moodle, lms setup, moodledata permissions, php lms"
description: "PHP 기반의 세계 표준 오픈소스 학습 관리 시스템(LMS)인 무들의 요구사항 및 보안 권장 데이터 디렉터리 분리 설치법을 학습합니다."
breadcrumb:
- setup
- "apps"
- "moodle"
---

<jiny-book-mark>무들 설치</jiny-book-mark>

# 무들 (Moodle) 설치 가이드
---
**무들(Moodle)**은 전 세계 대학 및 교육 기관에서 가장 대표적으로 사용하는 글로벌 1위의 오픈소스 학습 관리 시스템(LMS)입니다. 온라인 동영상 강의 시청, 퀴즈 출제, 과제 제출 및 성적 피드백 시스템 등을 통합 제공하는 학습 플랫폼입니다.

<br>

## 1. 사전 요구사항 (Requirements)
---
무들은 대규모 학생 데이터와 학습 기록을 처리하므로 시스템 요구사항과 필수 PHP 확장 기능이 다소 많습니다.
* **PHP**: 8.0 버전 이상 (Moodle 4.x 이상부터는 PHP 8.1+ 권장)
* **데이터베이스**: MySQL 8.0 이상, MariaDB 10.6 이상, 또는 PostgreSQL 13 이상
* **웹 서버**: Apache 또는 Nginx
* **필수 PHP 확장 모듈**: `php-iconv`, `php-mbstring`, `php-curl`, `php-openssl`, `php-tokenizer`, `php-xml`, `php-xmlrpc`, `php-soap`, `php-ctype`, `php-zip`, `php-gd`, `php-intl`, `php-mysqli`

<br>

## 2. 데이터베이스 설정 (Database Setup)
---
무들이 학습 데이터를 보존할 전용 데이터베이스 인스턴스와 데이터 정렬 규칙(Collation)을 설정하여 생성합니다.

```sql
-- MySQL/MariaDB 접속 후 실행
CREATE DATABASE moodle DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 전용 계정 생성 및 권한 위임
CREATE USER 'moodle_user'@'localhost' IDENTIFIED BY 'moodle_password123!';
GRANT ALL PRIVILEGES ON moodle.* TO 'moodle_user'@'localhost';

-- 적용 및 종료
FLUSH PRIVILEGES;
EXIT;
```

<br>

## 3. 핵심 보안 사항: 데이터 디렉터리 격리 생성
---
무들은 학생들이 업로드한 과제물, 강의 비디오, 개인 정보 등을 안전하게 저장하기 위해 웹상에서 직접 브라우저로 접근할 수 없는 **웹 루트 외부 영역**에 별도의 데이터 디렉터리(`moodledata`)를 무조건 생성하도록 강제하고 있습니다.

```bash
# 웹 루트(/var/www/html) 외부인 /var 디렉터리에 생성
sudo mkdir /var/moodledata

# 웹 서버 소유권 지정 (Ubuntu 계열 www-data)
sudo chown -R www-data:www-data /var/moodledata

# 웹 서버 프로세스가 파일을 읽고 쓸 수 있도록 쓰기 권한 설정
sudo chmod -R 770 /var/moodledata
```

> [!CAUTION]
> **보안 위협 방지**  
> `moodledata` 폴더가 웹 루트 내부(예: `/var/www/html/moodledata`)에 위치하게 되면 외부 해커가 학생들의 제출 과제나 시스템 첨부파일 주소에 직접 접근하여 다운로드할 수 있으므로, 반드시 웹 루트 외부에 분리 적재해야 설치가 진행됩니다.

<br>

## 4. 무들 소스코드 다운로드 및 이동
---
무들 공식 릴리즈 페이지에서 최신 안정화 패키지를 다운로드해 웹 루트에 이식합니다.

```bash
# Moodle 최신 배포판 다운로드
wget https://download.moodle.org/download.php/direct/stable403/moodle-latest-403.tgz

# 압축 해제
tar -zxvf moodle-latest-403.tgz

# 웹 서비스 디렉터리로 이동
sudo mv moodle /var/www/html/

# 소유자 설정
sudo chown -R www-data:www-data /var/www/html/moodle/
```

<br>

## 5. 웹 설치 프로세스 진행
---
웹 브라우저를 열고 `http://localhost/moodle` 또는 도메인 주소로 접속합니다.

1. **언어 선택**: 한국어 또는 영어 등을 선택하고 [Next]를 클릭합니다.
2. **디렉터리 경로 확인**:
   - 웹 주소: `http://localhost/moodle`
   - 무들 디렉터리: `/var/www/html/moodle`
   - 데이터 디렉터리: 위에서 생성한 외부 경로 `/var/moodledata`를 정확히 기입합니다.
3. **데이터베이스 드라이버 선택**: `Improved MySQL (mysqli)` 또는 설치한 DB 드라이버를 선택합니다.
4. **데이터베이스 연결 정보 설정**:
   - 데이터베이스 호스트: `localhost`
   - 데이터베이스 이름: `moodle`
   - 사용자: `moodle_user`
   - 비밀번호: `moodle_password123!`
   - 테이블 접두사: `mdl_`
5. **서버 환경 검사**: 필수 PHP 확장 모듈 설치 검사가 진행됩니다. 오류가 있다면 터미널에서 해당 모듈을 활성화한 뒤 웹 서버를 재시작하고 페이지를 새로고침해야 합니다.
6. **설치 완료 및 관리자 계정 생성**: 설치 스크립트 실행이 끝나면 최고 관리자(Administrator) 정보 및 사이트 기본 설정을 입력하여 설치를 최종 마무리합니다.
