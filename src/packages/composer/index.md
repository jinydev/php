---
layout: php
title: "PHP composer"
breadcrumb:
- packages
- composer
---

# 컴포저 (Composer)
---
컴포저(Composer)는 현대 PHP 개발 환경에서 사실상의 표준(De facto standard)으로 자리 잡은 **의존성 관리 도구(Dependency Manager)**입니다. 과거의 파편화되고 관리하기 힘들었던 외부 라이브러리 연동 방식을 혁신하여, 프로젝트 단위의 고유한 라이브러리 버전을 고정하고 효율적인 클래스 오토로딩(Autoloading)을 보장합니다.

본 단원에서는 컴포저의 핵심 개념부터 설치, 오토로드 메커니즘, 패키지 제작 및 배포, 사설 저장소 구성까지 컴포저의 전반적인 기능을 깊이 있게 학습합니다.

<br>

## 📂 학습 목차 및 로드맵
---

### 1. [컴포저 소개](about/)
* PHP 생태계에서 외부 라이브러리를 연동할 때 겪었던 역사적 한계와 의존성 지옥(Dependency Hell)을 극복하고 컴포저가 탄생한 배경을 이해합니다.
* **[PEAR와 컴포저의 차이](about/pear.html)**: 전역 서버 기준 설치 방식인 PEAR의 한계점과 프로젝트 독립적 구조를 지향하는 컴포저의 장점을 비교 분석합니다.

### 2. [설치 및 CLI 명령어](setup/)
* Windows, macOS, Linux 운영체제별 컴포저 설치 과정을 학습합니다.
* `composer.phar`의 의미와 전역 실행 명령 등록 방법을 알아보고, 터미널에서 자주 사용하는 명령어와 옵션을 정리합니다.

### 3. [패키지 생태계와 검색](package/)
* PHP 공식 패키지 저장소인 **Packagist.org**의 역할과 Composer 2의 글로벌 CDN 작동 방식을 살펴보고, 웹사이트와 터미널 콘솔을 활용해 필요한 패키지를 검색하는 방법을 학습합니다.

### 4. [패키지 설치와 갱신](install/)
* `composer require`와 `composer install` 명령의 차이를 분석합니다.
* 개발용 패키지 지정을 위한 `--dev` 옵션, 시맨틱 버저닝(SemVer) 기반의 버전 제약 조건(`~`, `^`, `*`), 그리고 의존성을 동기화하기 위한 `composer.lock` 파일의 역할을 학습합니다.

### 5. [프로젝트 폴더 구조](folder.html)
* 컴포저를 통해 생성되는 `vendor` 디렉터리의 내부 구조와 오토로딩 부트스트랩인 `vendor/autoload.php`가 동작하는 방식을 살펴봅니다.

### 6. [오토로드 메커니즘](autoload.html)
* PHP 표준 라이브러리인 SPL의 `spl_autoload_register` 함수를 이용해 순수 PHP로 클래스 자동 로딩을 구현해 봅니다.
* 컴포저가 제공하는 `classmap`, `files`, `psr-4` 오토로드 옵션의 차이점과 특징을 정리합니다.

### 7. [PSR-4 규약](psr4.html)
* 네임스페이스(Namespace)와 물리적인 디렉터리 경로를 일치시키는 현대 PHP 표준 오토로딩 규약인 PSR-4 표준을 예제를 통해 완벽히 이해합니다.

### 8. [composer.json 스키마](json.html)
* 컴포저 설정 파일인 `composer.json`에 기록되는 다양한 구성 항목의 명세를 분석하고, 의존성을 정밀하게 고정하기 위한 버전 제약 연산자를 이해합니다.

### 9. [코드 적용 실습](code.html)
* 실제로 외부 패키지(`illuminate/support`)를 프로젝트에 설치하고, 네임스페이스를 통해 모던 PHP 도우미 클래스(`Arr::get`)를 소스 코드에 적용하고 테스트하는 과정을 연습합니다.

### 10. [커스텀 패키지 제작](make.html)
* 다른 개발자들이 사용할 수 있는 나만의 커스텀 라이브러리 패키지를 구성하고, 자체적인 `composer.json`을 통해 오토로드 방식을 정의하는 실무 과정을 실습합니다.

### 11. [패키지 배포 (Packagist)](deploy.html)
* 제작한 패키지 소스를 GitHub 공개 저장소에 등록하고 Git 태그로 버전을 정의한 후, Packagist에 최종 배포하여 전 세계 개발자들과 공유하는 과정을 학습합니다. (GitHub Webhooks 자동 동기화 포함)

### 12. [커스텀 저장소 구성](repository.html)
* 사내 비공개 프로젝트나 개별 개발 라이브러리를 동적으로 로드할 수 있도록 VCS(Version Control System) 및 로컬 디렉터리를 가리키는 Path 방식의 저장소 설정법을 익힙니다.
