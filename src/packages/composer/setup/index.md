---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 설치 및 CLI 명령어
---
PHP는 이제 리눅스 서버뿐만 아니라 Windows, macOS 등 다양한 크로스 플랫폼 개발 환경을 완벽하게 지원합니다. 이에 발맞춰 PHP 패키지 관리 도구인 컴포저 또한 여러 운영체제에서 간편하게 설치하여 사용할 수 있습니다.

이 장에서는 운영체제별 컴포저 설치 절차와 글로벌(전역) 명령 등록법, 그리고 자주 사용하는 핵심 CLI 커맨드 및 옵션을 알아봅니다.

<br>

## 1. 컴포저 공식 사이트
---
컴포저의 공식 사이트는 **[getcomposer.org](https://getcomposer.org)**입니다. 
공식 홈페이지의 다운로드 페이지에는 각 운영체제별 세부 설치 프로세스 및 릴리스 노트가 최신 상태로 유지되고 있습니다.

> [!IMPORTANT]
> **전제 조건**: 컴포저를 설치하기 전에 시스템에 PHP CLI 실행기가 미리 설치되어 있고, 환경 변수(Path)가 등록되어 있어야 합니다. 터미널 혹은 명령 프롬프트에서 `php -v`를 입력해 정상 출력되는지 먼저 확인해 주십시오.

<br>

## 2. 운영체제별 설치 가이드
---

### 2.1 Windows 환경 설치
Windows 환경에서는 별도의 설치 바이너리(`.exe`) 파일을 제공하므로 클릭 몇 번으로 손쉽게 환경 구성을 할 수 있습니다.
1. 공식 홈페이지에서 **`Composer-Setup.exe`** 파일을 다운로드합니다.
2. 다운로드한 실행 파일을 더블 클릭하여 설치 마법사를 시작합니다.
3. 설치 도중 시스템 내 설치된 `php.exe` 경로를 지정해야 하는 화면이 나옵니다. (설치기는 보통 자동으로 찾지만 찾지 못할 경우 `C:\php\php.exe` 등 실제 설치 폴더를 수동 지정해 줍니다.)
4. 설치가 완료되면 명령 프롬프트(cmd) 창을 새로 열어 `composer -V` 명령어로 설치가 완료되었는지 검증합니다.

---

### 2.2 macOS & Linux 환경 설치 (터미널)
macOS 및 Linux 환경에서는 터미널 창을 열어 명령어로 직접 설치 파일을 생성하고 전역으로 옮겨 설정하는 것이 표준적인 방법입니다.

#### [단계 1] 설치 스크립트 다운로드
```bash
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
위 명령어를 터미널에 입력하면 현재 작업 디렉터리에 `composer-setup.php` 설치 파일이 임시 복사됩니다.

#### [단계 2] 인스톨러 무결성 검증 (해시값 대조)
공식 홈페이지에서 다운로드한 파일이 해킹되거나 깨지지 않았는지 최신 해시 코드로 검증합니다. (해시 코드는 릴리스에 따라 주기적으로 바뀌므로 홈페이지 다운로드 페이지의 코드를 그대로 복사해 오기를 권장합니다.)
```bash
$ php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
* 무결성 검사가 성공하면 `Installer verified`가 화면에 표시됩니다.

#### [단계 3] 컴포저 빌드 및 phar 실행기 생성
```bash
$ php composer-setup.php
```
이 단계를 진행하면 컴포저 자체 실행 압축 아카이브 파일인 **`composer.phar`**가 정상 생성됩니다.

#### [단계 4] 임시 설치 파일 삭제
```bash
$ php -r "unlink('composer-setup.php');"
```

---

### 2.3 cURL을 이용한 빠른 단축 설치
시스템에 `curl` 패키지가 깔려 있다면 아래의 한 줄짜리 파이프 명령어를 사용하여 단계 1~3을 원스톱으로 처리할 수도 있습니다.
```bash
$ curl -sS https://getcomposer.org/installer | php
```

---

### 2.4 전역(Global) 실행 파일 등록
방금 생성한 `composer.phar` 파일은 현재 폴더에서만 `php composer.phar` 형태로 구동되므로 사용하기 번거롭습니다. 운영체제 어디서든 단축어 `composer`로 바로 실행하려면 시스템 실행 경로(`/usr/local/bin/`)로 파일을 옮겨야 합니다.
```bash
$ sudo mv composer.phar /usr/local/bin/composer
$ sudo chmod +x /usr/local/bin/composer
```
위 처리를 마친 뒤에는 터미널에서 아래와 같이 즉각 버전 검증을 할 수 있습니다.
```bash
$ composer -V
Composer version 2.6.5 2026-06-14 ...
```

<br>

## 3. 컴포저 CLI 명령어 & 옵션 명세
---
컴포저는 터미널 창에서 명령어를 입력받는 CLI(Command Line Interface) 환경의 유틸리티입니다.

### 3.1 CLI 기본 구문
```bash
$ composer [명령어] [옵션] [인자]
```

### 3.2 자주 쓰는 전역 옵션
* `-h`, `--help`: 입력한 명령어에 대한 사용 안내서 및 서브 명령 종류를 출력합니다.
* `-V`, `--version`: 설치된 컴포저 프로그램의 버전과 빌드 날짜를 표시합니다.
* `-q`, `--quiet`: 에러 메시지를 제외한 어떤 표준 출력 정보도 터미널에 내보내지 않습니다.
* `-n`, `--no-interaction`: 사용자 질문 창을 차단하고 모두 기본 설정값(default)으로 지정해 작동시킵니다.
* `-d`, `--working-dir=WORKING-DIR`: 현재 디렉터리가 아닌 지정한 특정 작업 경로를 기준으로 작업을 수행합니다.
* `-v|vv|vvv`, `--verbose`: 터미널 출력 수준을 조절하여 상세 로그(vvv는 디버깅 모드)를 제공합니다.

### 3.3 핵심 명령어 요약

| 명령어 | 설 명 |
| :--- | :--- |
| **`init`** | 현재 폴더에 대화식(interactive) 가이드를 실행하여 기본 `composer.json`을 생성합니다. |
| **`require`** | 새로운 외부 패키지를 검색 후 프로젝트에 다운로드 설치하고 `composer.json`에 기록합니다. |
| **`install`** | `composer.lock` 또는 `composer.json` 목록에 명시된 모든 패키지를 다운로드해 `vendor/`에 설치합니다. |
| **`update`** | 프로젝트 내 이미 깔린 모든 패키지를 버전을 조회하여 허용 범위의 최신 버전으로 일괄 업그레이드합니다. |
| **`remove`** | 지정한 패키지를 `vendor/` 디렉터리와 `composer.json` 설정에서 삭제하고 오토로드를 갱신합니다. |
| **`search`** | Packagist에 등록된 공개 패키지 중 검색 키워드에 매칭되는 소스를 검색합니다. |
| **`show`** / **`info`** | 현재 프로젝트에 설치된 패키지들의 상세 버전 및 설명 리스트를 화면에 표시합니다. |
| **`dump-autoload`** / **`dumpautoload`** | 변경된 오토로드 경로(PSR-4, classmap) 설정에 의거해 캐시 맵을 재작성하여 갱신합니다. |
| **`create-project`** | 지정한 패키지 구조를 뼈대로 삼아 로컬 디렉터리에 새로운 PHP 프로젝트 골격을 생성합니다. (예: Laravel 설치 시 사용) |
| **`diagnose`** | 시스템 환경 및 네트워크 접속 여부를 체크해 컴포저 구동 시 발생할 수 있는 일반 오류를 자체 진단합니다. |
| **`validate`** | `composer.json` 및 `composer.lock` 파일에 JSON 문법 오류나 어긋난 의존 설정이 없는지 확인합니다. |
