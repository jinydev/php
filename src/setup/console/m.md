---
layout: php
title: PHP CLI 모듈 출력 옵션 (-m) 활용 가이드
description: "PHP CLI의 -m 옵션을 사용하여 현재 설치 구동된 코어 및 Zend 확장 모듈 목록을 조회하고, 누락된 데이터베이스 드라이버나 캐시 모듈을 트러블슈팅하는 법을 설명합니다."
keyword: "php -m, php 모듈 목록, php extension check, php 로드 모듈, php zend extension, php 설치 모듈"
breadcrumb:
- setup
- console
- option
- m
---

# PHP 모듈 출력 옵션 (`-m`)
---
PHP는 코어 언어 스펙 외에도 다채로운 데이터베이스 연동, 이미지 처리, 압축 가공, 네트워크 통신 기능 등을 독립된 **확장 모듈(Extension)** 구조로 설계해 덧붙여 나갑니다. 

PHP **`-m`** 옵션은 현재 동작하는 PHP CLI 환경에 **어떠한 모듈들이 로드되어 실제로 기동 중인지** 그 리스트를 터미널 화면에 일목요연하게 덤프하여 보여줍니다.

<br>

### 1. 사용법 및 결과 영역 식별
---
터미널 콘솔창에 옵션을 적어 수행합니다.

```console
$ php -m
[PHP Modules]
bcmath
Core
curl
date
filter
hash
mbstring
openssl
pdo_mysql
zlib

[Zend Modules]
Zend OPcache
```

출력 내용은 크게 두 부분으로 구조화되어 나타납니다.
1. **`[PHP Modules]` (일반 모듈)**: PHP의 API 함수 및 드라이버 연결을 지원하는 일반 라이브러리들입니다. `php.ini`에 등록 시 **`extension=모듈명`** 형식으로 로드합니다.
2. **`[Zend Modules]` (젠드 모듈)**: PHP 가상 머신의 동작을 제어하거나 최적화하는 데 관여하는 기저 로우레벨 엔진 확장입니다. `php.ini`에 등록 시 **`zend_extension=모듈경로`** 형식으로 정교하게 지정해주어야 로드됩니다. (예: `Zend OPcache`, 디버거 툴인 `Xdebug` 등)

<br>

### 2. 실무 트러블슈팅에서의 필수 가치
---
개발 중 또는 서버 세팅 후 특정 모듈이 없다는 에러 메시지를 수신했을 때, 모듈 탑재 유무를 교차 검증하기 위한 1순위 진단 도구입니다.

```console
# 에러 예시
Fatal error: Uncaught Error: Call to undefined function curl_init()
```
위와 같은 에러가 발생한 경우, 우선적으로 터미널에서 모듈이 활성화되었는지 필터링합니다.

```console
$ php -m | grep -i curl
curl
```
- **검색 결과 없음**: `php.ini` 파일에서 `extension=curl` 앞에 붙은 주석 기호(`;`)를 풀지 않았거나, 서버 운영체제에 `php-curl` 패키지를 다운로드해 얹지 않은 상황이므로 이를 수정해야 합니다.
- **검색 결과에 명시됨**: CLI 터미널 환경에서는 curl이 잘 탑재되었으나, 실 가동되는 웹 프로세스(PHP-FPM 등)에서 로드하는 `php.ini` 파일이 달라 웹 브라우저 접속 환경에만 curl 모듈이 전달되지 못하고 있음을 역추적할 수 있습니다.