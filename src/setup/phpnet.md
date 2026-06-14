---
layout: php
title: PHP 공식 사이트 및 다운로드 아키텍처 선택 가이드
description: "PHP 공식 웹사이트(php.net)에서 최신 버전을 다운로드하고 개발 환경에 맞는 Thread Safe(TS) 및 Non-Thread Safe(NTS) 버전을 선별하는 기준을 설명합니다."
keyword: "php 공식 사이트, php.net, php 다운로드, php nts ts 차이, non-thread safe, thread safe, php 윈도우 다운로드"
---

# PHP 공식 사이트 및 다운로드 가이드
---
PHP의 소스코드 및 플랫폼별 공식 빌드 파일은 공식 웹사이트인 **[php.net](https://www.php.net/)**을 통해 배포되고 있습니다. 공식 사이트에서는 최신 릴리즈 정보, 공식 한글 메뉴얼, 보안 업데이트 내역 등을 확인할 수 있으며, 다양한 운영체제와 아키텍처 사양에 맞춘 패키지를 제공합니다.

title: PHP 공식 사이트 활용 및 다운로드 아키텍처(NTS vs TS) 완벽 가이드
description: "PHP 공식 웹사이트(php.net)의 구조와 문서 검색 꿀팁을 알아보고, 최신 버전 선택 시 필수적인 Thread Safe(TS)와 Non-Thread Safe(NTS) 아키텍처 차이 및 결정 흐름도를 학습합니다."
keyword: "php 공식 사이트, php.net, php 다운로드, php nts ts 차이, non-thread safe, thread safe, php 윈도우 다운로드, php.net 꿀팁, php 버전 수명"
---

# PHP 공식 사이트 활용 및 다운로드 가이드
---
PHP의 소스코드, 공식 문서, 그리고 플랫폼별 빌드 바이너리는 공식 웹사이트인 **[php.net](https://www.php.net/)**을 통해 관리 및 배포되고 있습니다. 공식 사이트는 단순한 다운로드 창구를 넘어 전 세계 PHP 개발자들이 가장 신뢰하는 공식 메뉴얼 허브이기도 합니다.

이 가이드에서는 공식 사이트의 핵심 구조와 검색 단축키 팁, 최신 버전 선택 가이드, 그리고 다운로드 시 직면하는 **NTS vs TS 아키텍처**에 대해 상세히 배웁니다.

<br>

### 1. PHP 공식 사이트(`php.net`) 핵심 구조
---
공식 웹사이트는 크게 세 가지 핵심 섹션으로 나누어져 개발자를 지원합니다.

1. **다운로드 (Downloads)**:
   - 일반 리눅스/Unix 배포판을 위한 소스 코드(`tar.gz`) 및 윈도우 빌드를 제공합니다.
   - [windows.php.net](https://windows.php.net/) 서브도메인을 통해 윈도우용 실행 바이너리(`.zip`)를 별도 배포합니다.
2. **공식 메뉴얼 (Documentation)**:
   - [php.net/manual](https://www.php.net/manual/ko/) 경로를 통해 한국어를 포함한 다국어 번역 매뉴얼을 제공합니다.
   - 각 내장 함수의 인수(Parameter), 반환값(Return value), PHP 버전에 따른 스펙 변화 및 전 세계 개발자들이 직접 남긴 예제 코드 댓글(User Notes)이 포함되어 있어 학습 효과가 뛰어납니다.
3. **릴리즈 내역 및 변경록 (Releases & Changelogs)**:
   - [php.net/releases](https://www.php.net/releases/)에서 역대 릴리즈 정보를 대조해 볼 수 있습니다.
   - 보안 취약점 패치 내역과 신규 기능 변경 내역은 `ChangeLog`를 통해 릴리즈마다 꼼꼼히 기록됩니다.

> [!TIP]
> **주소창 직접 검색 단축키 (Developer Tip)**
> 브라우저 주소창에 `php.net/` 뒤에 원하는 함수나 클래스명을 적고 엔터를 누르면, 공식 사이트 내부 검색을 거치지 않고 **해당 함수의 메뉴얼 웹페이지로 즉각 리다이렉트**됩니다.
> - 예: 주소창에 **`php.net/strlen`** 기입 ➡️ `strlen()` 공식 레퍼런스 페이지로 즉시 이동
> - 예: 주소창에 **`php.net/pdo`** 기입 ➡️ PDO 데이터베이스 클래스 설명 페이지로 즉시 이동

<br>

### 2. PHP 버전 선택 요령과 제품 수명(Lifecycle)
---
PHP는 의미론적 버전 명명법(Semantic Versioning)을 준수하며, 크게 세 가지 버전 그룹으로 나누어 관리됩니다.

```text
  [ Major Version ] . [ Minor Version ] . [ Release (Patch) ]
       예: 8        .        3        .        6
```
- **Major (예: 8)**: 언어 전체의 패러다임이 바뀌거나 하위 호환성이 깨지는 대규모 갱신입니다.
- **Minor (예: 3)**: 신규 기능 및 문법이 대거 추가되는 중요 릴리즈입니다.
- **Release (예: 6)**: 기능 변화 없이 버그 수정 및 보안 취약점 보완만 처리된 안전 패치 버전입니다.

#### PHP 릴리즈 수명 관리 규칙 (Release Support)
PHP Core 개발 그룹은 버그와 보안 사고에 대응하기 위해 각 마이너 버전에 대해 다음과 같은 유효 수명을 책정합니다.
1. **Active Support (Active 지원 - 2년)**: 기능 결함 및 일반 버그가 식별되는 즉시 엔진을 수정하여 정기 패치 버전을 릴리즈합니다.
2. **Security Support (보안 지원 - 1년 추가)**: 일반 버그 패치는 중단되나, 시스템 침투 위험이 있는 중대한 보안 취약점이 감지되면 긴급 패치를 단행합니다.
3. **EOL (End of Life - 수명 종료)**: 3년이 지나 EOL 처리된 버전(예: PHP 7.x 이전 버전 전체 및 8.0 등)은 더 이상 어떤 패치도 제공되지 않으므로, **신규 프로젝트 구축 시에는 무조건 Active Support 상태인 최신 버전(예: PHP 8.2 ~ 8.4)을 다운로드**해야 보안 사고를 막을 수 있습니다.

<br>

### 3. 다운로드 아키텍처 선택: Thread Safe(TS) vs Non-Thread Safe(NTS)
---
윈도우 환경 등에서 다운로드할 때 가장 까다로운 조건인 **Thread Safe(TS)**와 **Non-Thread Safe(NTS)**의 결정 경로와 기술 차이점을 정리합니다.

#### 1) 기술적 원리 대조

| 구분 | Thread Safe (TS - 스레드 안전형) | Non-Thread Safe (NTS - 스레드 비안전형) |
| :--- | :--- | :--- |
| **작동 개념** | 한 프로세스 내에서 여러 요청을 **스레드(Thread)** 단위로 분할하여 동시에 연산 및 처리하는 구조입니다. | 요청마다 독립된 개별 **프로세스(Process)**가 직접 실행되어 메모리 영역을 철저히 격리 처리하는 구조입니다. |
| **메모리 보호** | 각 스레드가 전역 데이터를 오염시키는 것을 막기 위해 별도의 락(Lock) 검증 로직인 TSRM(Thread Safe Resource Manager) 계층이 개입합니다. | 프로세스 단위 격리이므로 다른 요청의 메모리 간섭 우려가 없어 자원 관리를 위한 락(Lock) 연산 오버헤드가 발생하지 않습니다. |
| **추천 웹서버** | - **Apache + `mod_php`**(아파치 모듈 통합 방식)<br>- IIS ISAPI 연동 | - **Nginx + PHP-FPM** (모던 웹서버 연동 표준)<br>- IIS + FastCGI<br>- Apache + `mod_fcgid` |
| **성능 및 안정성** | 스레드 잠금 검증 프로세스 때문에 미세하게 실행 속도가 느리며, 메모리 누수가 발생한 외부 확장 모듈이 스레드를 죽일 시 전체 프로세스가 꺼지는 취약점이 있습니다. | 락킹 작업이 생략되어 **속도가 더 빠르고 가벼우며**, 한 FPM 프로세스가 멈춰도 다른 동시 접속자들은 영향받지 않아 가장 안정적입니다. |

> [!TIP]
> **모던 웹 인프라의 권장사항**
> 현대 웹 서버 구성(특히 **Nginx + PHP-FPM** 또는 **Apache + PHP-FPM FastCGI** 환경)에서는 프로세스 격리 구조인 **Non-Thread Safe (NTS)**를 내려받는 것이 기본이자 업계 표준 권장사항입니다.

<br>

### 3. 컴파일러 버전 및 Visual C++ 재배포 패키지 확인
---
윈도우용 빌드 목록 오른편을 보면 `VS16 x64` 등 빌드 시 사용된 컴파일러 명칭이 표기되어 있습니다.
- **x64 vs x86**: 윈도우 운영체제가 64비트이면 당연히 **x64**를 고르는 것이 메모리 주소 할당 및 속도 측면에서 유리합니다.
- **Visual C++ Redistributable**: PHP 실행 파일이 기계어로 정상 번역되려면 사용된 컴파일러 버전과 일치하는 **Visual C++ 재배포 가능 패키지(MSVC)**가 윈도우 OS 시스템에 사전 설치되어 있어야 합니다. 예를 들어 VS16 빌드는 **Visual Studio 2015-2022용 VC++ 재배포 패키지**가 깔려 있어야 `VCRUNTIME140.dll` 오류 없이 잘 실행됩니다.
