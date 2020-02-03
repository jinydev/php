---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

# 2.4 윈도우 개발환경 구축하기
---
> `넘버 PHP 1권` 보충정리 내용입니다. 원문은 도서를 참고해 주시길 바랍니다.

PHP 내장 서버 이외에도 Apache 웹 서버와 PHP, MYSQL을 설치하여 연동할 수 있습니다. 대중적인 웹 서버 Apache는 PHP 내장 서버보다 더 많은 언어와 웹 서비스를 실행할 수 있습니다. 또한 MYSQL 데이터베이스와의 연동으로 데이터베이스 관리가 가능합니다.
<br>

## 2.4.1 APM 프로그램으로 일괄 설치하기
---
APM은 Apache + PHP + MYSQL의 약자입니다. 우리가 APM이라는 약자를 사용하는 것은 이 세 가지 프로그램이 궁합이 잘 맞고, 수많은 웹 서비스의 환경들이 이런 조합으로 구동이 되고 있기 때문입니다. 요즘 들어 APM 연동 설치는 거의 표준화되는 추세입니다. 

각각의 프로그램을 설치하여 직접 환경 설정할 수도 있지만 매우 번거롭고 초보자에게는 쉽지 않은 작업입니다. 그래서 인터넷을 검색하면 수많은 APM 통합 프로그램들을 찾아볼 수 있습니다.

APM 설치 방법에 대해서는 지면상 책에서 설명하지 않고 필자의 웹 페이지 http://www.hojin.io 에서 설명하겠습니다.
<br>

## 2.4.2 PHP 버전 업그레이드
---
최신의 APM 버전으로 설치했다고 해도 PHP 버전은 최신이 아닐 수 있습니다. APM은 여러 사용자와 다양한 프레임워크 등 동작을 위해서 최신 버전보다는 약간 이전의 버전을 사용하는 경우가 많습니다.

그 예로 bitnami WAMP 5.6.30의 경우 PHP 버전을 살펴보면 PHP 5.6.30으로 설정되어 있습니다.
```
C:\Bitnami\wampstack-5.6.30-0\php>php -v
PHP 5.6.30 (cli) (built: Jan 18 2017 19:47:36)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2016, by Zend Technologies
```
이 책을 집필할 때 기준으로 PHP 최신 버전은 7.1.4입니다. www.php.net에 접속하면 최신의 버전을 다운로드할 수 있습니다.

다운로드한 파일을 ./php 폴더에 덮어쓰면 간단하게 업그레이드할 수 있습니다.

<br><br>