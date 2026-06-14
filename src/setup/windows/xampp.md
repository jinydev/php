---
layout: php
title: XAMPP 통합 개발 환경 구축 및 관리 상세 가이드
description: "Apache Friends의 XAMPP 패키지를 활용해 Windows 환경에 Apache, MySQL/MariaDB, PHP를 통합 설치하고, 포트 충돌 및 php.ini 연동 관리를 상세 해설합니다."
keyword: "xampp 설치, 윈도우 xampp php, apache friends xampp, 로컬 웹서버 구축, phpmyadmin 사용법, xampp 포트 변경"
breadcrumb:
- setup
- windows
- xampp
---

# XAMPP 통합 개발 환경 구축 및 관리
---
과거 많은 개발자들이 애용하던 비트나미(Bitnami) 로컬 WampStack 인스톨러 패키지가 서비스 개편으로 공식 폐지 및 지원 중단되었습니다. 현재 Windows 환경에서 Apache, MySQL/MariaDB, PHP가 한데 묶인 APM 개발 서버를 구축할 수 있는 가장 대표적인 업계 표준 및 대안은 **[Apache Friends](https://www.apachefriends.org/)**의 **XAMPP** 패키지입니다.

이 가이드에서는 XAMPP 패키지를 이용해 로컬 개발 서버를 안정적으로 런칭하고 관리하는 전체 과정을 상세히 다룹니다.

<br>

### 1. XAMPP 통합 스택 아키텍처 및 설정 맵
---
아래 다이어그램은 XAMPP 컨트롤 패널(Control Panel)이 로컬 시스템의 개별 모듈(Apache, MariaDB)을 어떻게 제어하고 웹 포트를 바인딩하는지, 그리고 소스 파일 위치 및 환경설정 파일 경로의 맵 구조를 보여줍니다.

![XAMPP 로컬 스택 구조도](/setup/img/xampp_flow.svg)

<br>

### 2. XAMPP 다운로드 및 설치 단계
---

#### Step 1. 인스톨러 다운로드
공식 웹사이트인 **[apachefriends.org](https://www.apachefriends.org/)**에 접속하여 **`XAMPP for Windows`** 항목을 클릭해 설치 파일을 다운로드합니다. 사용하는 PHP 버전에 맞춘 릴리즈 패키지(현재 PHP 8.x 이상 탑재 버전 권장)를 자유롭게 선택할 수 있습니다.

#### Step 2. UAC (사용자 계정 컨트롤) 경고 처리
Windows OS의 UAC 보안 정책으로 인해 다운로드받은 설치 파일을 실행하면 "C:\Program Files 아래에 설치 시 쓰기 권한 부족 에러가 발생할 수 있다"는 경고 팝업이 출력될 수 있습니다. 
- **대처법**: 경고 팝업을 가볍게 [확인]하여 넘기고, 설치 위치 지정 단계에서 Windows 기본값인 **`C:\xampp`**를 목적지로 지정하면 쓰기 권한 충돌 없이 매끄럽게 가동됩니다.

#### Step 3. 구성 요소 (Components) 선별
기본 탑재 도구 중 불필요한 것들은 체크 해제하여 시스템 디스크 용량을 절약할 수 있습니다.
- **필수 선택**: **`Apache`**, **`MySQL`**, **`PHP`**, **`phpMyAdmin`** (이 4가지는 실제 서비스 구동 및 관리에 절대 필요합니다.)
- **선택 해제 가능**: FileZilla FTP Server, Mercury Mail Server, Tomcat, Perl, Webalizer, Fake Sendmail (일반적인 웹 개발 실습 용도로는 사용률이 극히 낮으므로 체크 해제해도 무방합니다.)

#### Step 4. 설치 완료 및 컨트롤 패널 가동
인스톨러 진행이 완료되면 마침 버튼을 누르고 **`XAMPP Control Panel`**을 켭니다.

<br>

### 3. XAMPP 컨트롤 패널 작동 및 포트 충돌 대처 요령
---
컨트롤 패널 창을 열면 설치된 서비스 모듈 목록이 열거되어 표시됩니다.

- **서비스 구동**: Apache와 MySQL 오른편의 **[Start]** 버튼을 각각 누릅니다. 포트 바인딩에 성공하면 모듈 이름 배경이 **초록색**으로 변환되며 가동 상태를 유지합니다.
- **브라우저 확인**: 웹 브라우저를 열고 `http://localhost/`를 입력해봅니다. XAMPP 대시보드가 성공적으로 렌더링되면 가동이 완료된 것입니다.

#### ⚠️ 아파치(Apache)가 초록색으로 켜지지 않고 꺼지는 경우 (포트 충돌 해결)
윈도우 환경에서는 기본 웹 포트인 **`80`** 또는 SSL 보안 포트인 **`443`**이 이미 실행 중인 타사 백그라운드 프로세스(Skype, VMware, Windows IIS 웹 등)에 의해 선점당해 아파치가 기동을 멈추는 일이 빈번하게 일어납니다.

이를 해결하기 위해 XAMPP 아파치가 참조하는 가상 포트를 변경해주어야 합니다.

1. Apache 모듈 오른쪽의 **[Config]** 버튼을 클릭하고 **`Apache (httpd.conf)`** 파일을 엽니다.
2. 텍스트 내에서 **`Listen 80`** 구문을 찾은 뒤, 포트를 다른 대역(예: **`Listen 8080`** 또는 **`8081`**)으로 수정하고 저장합니다.
3. 다시 **[Config]** 버튼을 클릭하고 이번엔 **`Apache (httpd-ssl.conf)`** 파일을 엽니다.
4. **`Listen 443`** 구문을 검색해 보안 포트를 임의의 다른 포트(예: **`Listen 4433`**)로 수정하고 저장합니다.
5. 아파치 **[Start]** 버튼을 다시 누르면 바뀐 포트로 충돌 없이 정상 기동됩니다. (이때 브라우저 접속 주소는 변경된 포트를 붙여서 **`http://localhost:8080/`** 로 접근해야 합니다.)

<br>

### 4. 내장 데이터베이스 GUI 관리 도구 (phpMyAdmin)
---
XAMPP는 웹 상에서 간편하게 MySQL/MariaDB 데이터베이스를 튜닝할 수 있는 **phpMyAdmin** 웹 애플리케이션을 기본 빌드에 내장해 줍니다.

- **접속 경로**: 브라우저 주소창에 `http://localhost/phpmyadmin/` 을 입력하여 접속합니다. (포트를 8080으로 바꾼 경우 `http://localhost:8080/phpmyadmin/` 으로 진입)
- **접속 정보**: 로컬 XAMPP의 기본 최고 관리자 데이터베이스 계정명은 **`root`** 이며, **비밀번호(Password)는 등록되어 있지 않은 빈 문자열(Null)** 상태입니다. 따라서 별도의 비밀번호를 적지 않아도 즉각 대시보드가 기동하여 데이터베이스 테이블을 손쉽게 조작할 수 있습니다.

<br>

### 5. XAMPP 주요 파일 및 설정 경로 디렉터리
---
개발 코드 이식 및 환경 튜닝 시 사용되는 핵심 디렉터리는 아래와 같습니다.

- **개발용 소스코드 폴더 (웹 루트)**: `C:\xampp\htdocs\`
  - 이 디렉터리 하위에 작성한 소스(예: `index.php`)를 집어넣으면 웹 브라우저 주소창 `http://localhost/index.php` 경로로 연동됩니다.
- **PHP 환경 파일 (`php.ini`)**: `C:\xampp\php\php.ini`
- **Apache 서버 환경설정**: `C:\xampp\apache\conf\httpd.conf`
- **MySQL 데이터베이스 설정**: `C:\xampp\mysql\bin\my.ini`
