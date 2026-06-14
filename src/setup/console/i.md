---
layout: php
title: PHP CLI 정보 확인 옵션 (-i) 활용 가이드
description: "PHP CLI 환경의 -i 옵션을 활용해 웹의 phpinfo() 기능을 터미널에서 구동하고, 파이프 라인(grep, findstr)을 연결해 특정 지시어를 검색하는 팁을 다룹니다."
keyword: "php -i, phpinfo CLI, php 환경 정보, php ini 확인, php 모듈 검색, php grep 연동"
breadcrumb:
- setup
- console
- option
- i
---

# PHP 정보 확인 옵션 (`-i`)
---
웹 서비스 환경에서는 브라우저 화면에 PHP의 빌드 스펙과 활성화된 모듈 목록을 띄우기 위해 `phpinfo()` 함수를 선언해 호출합니다.

```php
<?php
// 웹 브라우저용 환경 정보 출력
phpinfo();
```

터미널 CLI 환경에서는 이 함수를 직접 코드 파일로 작성해 띄울 필요 없이, 커맨드 단독 옵션인 **`-i`**를 사용하여 터미널 화면에 직접 동일한 상세 설정 보고서를 표준 출력할 수 있습니다.

<br>

### 1. 기본 작동 원리
---
터미널 창에 `php -i`를 입력하면 컴파일러 버전, 시스템 아키텍처, 전역 변수 세팅값, 로드된 각 모듈별 지시문 정보가 길게 텍스트 양식으로 출력됩니다.

```console
$ php -i
phpinfo()
PHP Version => 8.3.6

System => Darwin MacBook.local 23.4.0 ...
Build Date => Apr 15 2026 18:22:10
Compiler => Clang 15.0.0
Configure Command => ...
```

<br>

### 2. 실무 팁: 셸 파이프라인(`grep` / `findstr`) 연동 검색
---
`php -i` 출력문은 텍스트 분량이 수백~수천 행에 달하므로, 눈으로 직접 읽어가며 설정값을 찾는 것은 거의 불가능합니다. 따라서 원하는 특정 설정 키워드를 찾기 위해 **파이프(`|`) 기호**를 사용해 검색 명령어에 연결하는 것이 정석입니다.

#### 1) Linux / macOS 환경 (`grep` 연계)
```bash
# 1. 시스템이 실제로 읽은 php.ini 로딩 위치 추적
php -i | grep "Configuration File"

# 2. 실행 메모리 할당 제한값(memory_limit) 조회
php -i | grep "memory_limit"

# 3. Opcache 가속 엔진 및 JIT 탑재 여부 필터링
php -i | grep -i "opcache"
```

#### 2) Windows 명령 프롬프트 환경 (`findstr` 연계)
```cmd
# 윈도우 환경에서 특정 ini 확장 모듈 로드 여부 검사
php -i | findstr /I "pdo_mysql"
```

<br>

### 3. devops 및 인프라 진단에서의 활용 가치
---
- **실 서비스 진단**: 웹 브라우저에 `phpinfo()` 파일을 퍼블릭하게 띄워두면 해커가 서버 빌드 버전과 내부 경로 정보를 수집하는 보안 위협(정보 노출 취약점)이 생깁니다. 따라서 점검 시에는 소스 생성 없이 안전한 `php -i` 명령어를 SSH 상에서만 사용하여 서버 사양을 점검하고 보완하는 습관을 들여야 합니다.
- **CI/CD 스크립트 검증**: 도커 컨테이너 빌드 과정이나 배포 파이프라인 단계에서 필요한 드라이버 패키지가 맞게 이식되었는지 빌드 자동 스크립트 내에서 `php -i` 출력값을 스캔 및 대조하는 자동화 용도로 요긴하게 사용됩니다.
