---
layout: php
title: PHP 보안 환경 설정 및 운영(Production) 전환 가이드
description: "PHP 가동 시 발생할 수 있는 보안 위협(RCE, RFI, XSS, 정보 누출)을 방어하기 위한 php.ini 보안 지시어 설정 방법과 개발용(Development) vs 운영용(Production) 구성 차이를 해설합니다."
keyword: "php 보안 설정, php.ini 보안, open_basedir 설정, disable_functions 권장, expose_php 끄기, session.cookie_secure, php 개발 운영 차이"
breadcrumb:
- setup
- env
- security
---

# PHP 보안 환경 설정 및 운영 전환 가이드
---
PHP 애플리케이션을 외부 공용 인터넷망에 배포하여 운영할 때는 성능 최적화만큼이나 **인프라 보안 통제 장벽(Security Hardening)**을 견고히 세우는 것이 중요합니다. 

PHP의 설정 파일인 `php.ini`는 외부 침투 세력이 악성 쉘 코드를 주입하거나 디렉터리 구조를 횡단하는 공격을 할 때, 이를 운영체제 및 컴파일러 레벨에서 차단할 수 있는 다양한 강력한 제어 옵션들을 기본 제공하고 있습니다.

이 문서에서는 모드별 환경설정의 차이점을 시각적으로 비교하고, 실제 서비스 배포 시 적용해야 할 핵심 보안 파라미터들의 세부 설정법을 학습합니다.

<br>

### 1. 개발(Dev) vs 운영(Prod) 설정 프로필 아키텍처
---
아래 다이어그램은 디버깅 편의를 위해 느슨하게 열어두는 개발 환경과, 정보 유출 차단 및 권한 격리에 집중하여 굳건히 걸어 잠그는 운영 환경의 주요 옵션 대조를 나타냅니다.

![PHP 환경 모드별 php.ini 설정 비교](img/security_dev_vs_prod.svg)

<br>

### 2. 운영 서버 배포 시 필수 수립할 6대 보안 설정
---

#### 1) 에러 은닉 및 디바이스 격리 로그 저장
실서버에서 발생하는 에러 메시지는 서버 절대 경로 및 데이터베이스 쿼리를 포함하므로 일반 접속자에게 절대 보여주어서는 안 됩니다.
- **권장 설정**:
  ```ini
  display_errors = Off
  display_startup_errors = Off
  log_errors = On
  error_log = /var/log/php/php_errors.log
  ```
- **효과**: 사용자 웹 화면에는 에러가 노출되지 않으며, 관리자는 디스크 내부 로그 파일(`/var/log/php/php_errors.log`)을 열어 안전하게 디버깅할 수 있습니다.

#### 2) expose_php 비활성화 (버전 은닉)
- **위험**: 기본 설정이 `On`인 경우, 서버 응답 헤더에 `X-Powered-By: PHP/8.3.1`과 같이 PHP 구동 여부와 상세 빌드 정보가 상시 출력됩니다. 해커는 특정 버전에 알려진 보안 취약점(CVE) 정보를 수집해 맞춤형 공격을 가할 수 있습니다.
- **권장 설정**:
  ```ini
  expose_php = Off
  ```
- **효과**: 응답 헤더에서 PHP 관련 버전 정보 노출이 완벽히 마스킹됩니다.

#### 3) allow_url_include 차단 (RFI 공격 방어)
- **위험**: `allow_url_include = On` 설정 시, 외부 원격 서버에 위치한 악성 스크립트 파일(`http://attacker.com/malware.txt`)을 `include`나 `require` 문을 통해 내 서버 메모리에 강제 탑재하여 실행시킬 수 있는 **원격 파일 포함(RFI, Remote File Inclusion)** 공격에 직면합니다.
- **권장 설정**:
  ```ini
  allow_url_fopen = On    ; 외부 API 통신(http 요청)용 오픈은 유지 가능
  allow_url_include = Off ; 원격 파일 인클루드는 절대 불가로 차단
  ```

#### 4) open_basedir 디렉터리 접근 범위 격리 (LFI & Traversal 방어)
- **위험**: 웹 서버 권한을 획득한 악성 스크립트가 리눅스의 상위 경로를 뒤져 시스템 민감 정보(`/etc/passwd` 등)를 탈취하는 파일 탐색 공격을 감행할 수 있습니다.
- **권장 설정**:
  ```ini
  open_basedir = "/var/www/html:/tmp"
  ```
- **효과**: PHP 프로세스가 파일 읽기/쓰기/포함 연산을 실행할 때, 지정된 `/var/www/html` 폴더와 임시 저장소인 `/tmp` 폴더 이외의 상위 경로 디렉터리는 시스템 권한이 있더라도 접근 시도를 즉시 거부(Permission Denied) 처리합니다.

#### 5) disable_functions 위험 시스템 함수 차단
- **위험**: 파일 업로드 취약점 등으로 인해 웹셸(WebShell)이 침투했을 때, 운영체제 시스템 터미널 제어 함수(`exec`, `system` 등)가 살아있으면 해커가 루트 권한 획득 시도 및 원격 쉘 장악(RCE)을 실행할 수 있습니다.
- **권장 설정**:
  ```ini
  disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
  ```
- **효과**: 지정한 위험한 운영체제 연동 계열 함수들을 PHP 코드가 호출 시 실행을 막고 엔진 레벨에서 강제 무력화합니다.

#### 6) 세션 쿠키 탈취 차단 및 암호화 전송 강제 (Session Hijacking 예방)
- **위험**: 세션 식별자가 자바스크립트나 일반 네트워크 스니핑을 통해 해커에게 넘어갈 경우, 해커가 로그인 단계를 거치지 않고 타인의 권한을 즉시 탈취하는 세션 하이재킹이 발생합니다.
- **권장 설정**:
  ```ini
  session.cookie_secure = On    ; 오직 HTTPS 보안 암호화 웹 연결 상에서만 쿠키 전송 허용
  session.cookie_httponly = On  ; 자바스크립트(document.cookie)를 통한 쿠키 접근 차단 (XSS 탈취 방지)
  session.cookie_samesite = Lax ; 교차 사이트 요청 위조(CSRF) 공격 경로 완화
  ```

<br>

### 3. 개발 vs 운영 주요 설정값 한눈에 비교하기
---

| 지시어 옵션명 (Directive) | 개발 환경 권장 (Development) | 운영 환경 권장 (Production) | 보안적 의의 및 방어 취약점 |
| :--- | :---: | :---: | :--- |
| **`display_errors`** | `On` | `Off` | 내부 시스템 물리 경로 및 DB 쿼리 은닉 |
| **`expose_php`** | `On` | `Off` | 엔진 버전 숨김 (버전 취약점 타겟 타격 방지) |
| **`allow_url_include`** | `Off` | `Off` | 원격지 악성 코드 실행 차단 (RFI 대응) |
| **`open_basedir`** | `None` | `/var/www/html` | 지정 디렉터리 외 파일 접근 봉쇄 (LFI 대응) |
| **`disable_functions`** | `None` | `exec,system...` | OS 쉘 탈취 및 임의 명령어 실행 차단 (RCE 대응) |
| **`session.cookie_secure`** | `Off` (HTTP 허용) | `On` (HTTPS Only) | 일반 네트워크 스니핑 차단 (Session Hijack 방지) |
| **`session.cookie_httponly`** | `Off` | `On` | 크로스 사이트 스크립팅을 통한 쿠키 탈취 차단 |
