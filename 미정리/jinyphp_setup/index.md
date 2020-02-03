---
layout: default
title: 지니프레임웍
subtitle: installation

tree: /setup
---

## 설치방법
---

지니는 PHP 언어로 개발된 웹프레임워크 입니다. 설치를 하기 위해서는 먼저 컴퓨터에 PHP언어와 페키지 의존관리인 컴포저가 같이 설치가 되어 있어야 합니다.
PHP언어는 직접 php.net 에서 다운로드 받아 설치 또는 비트나미(bitnami) 패키지를 통하여 통합 설치 하시면 편리합니다.
컴포저 프로그램은 getcomposer.org 사이트에서 무료로 다운로드 받을 수 있습니다.

* PHP 설치하기
* 컴포저 설치하기
  
<br>

## 설치진행
---
지니PHP는 빠르게 설치 및 프로젝트를 진행할 수 있도록 다양한 여러 유형의 방식을 지원합니다. 

* [인스톨러 방식](./setup/install)
* [컴포저 프로젝트](./setup/composer)
* [깃허브](./setup/git)

<br>

## 실행방법
---
로컬에서 테스트 및 웹서버를 운영하기 위해서는 별도의 웹서버 프로그램이 필요합니다. PHP는 별도의 설치 도구 없이도 웹서버 실행 환경을 제공합니다.   

PHP 자체 내장된 CLI를 통하여 서버를 실행할 수 있습니다.

CLI를 통하여 실행을 하는 방법은 다음과 같습니다.

```php
php -S localhost:8000
```

특정 도큐먼트 폴더에서 시작을 할때는 `-t`옵션을 사용할 수 있습니다.
```
php -S localhost:8000 -t ./public
```

서버가 실행하게 되면 다음과 같은 메시지가 출력됩니다.
```
PHP 7.1.15 Development Server started at Thu Jun 14 13:59:53 2018
Listening on http://localhost:8000
Document root is D:\htdocs\jinyphp\public
Press Ctrl-C to quit.
```

웹 브라우저에서 `http://localhost:8000`와 같이 입력을 하게되면 실행된 웹사이트를 보실 수 있습니다.
웹 서버 실행을 중단할려면 `Ctrl + C`를 입력하면 됩니다.


<br>

## 업그레이드
---

지니 프래임워크의 모든 소스는 공개되어 있습니다. 필요한 기능을 추가하여 사용이 가능하며, 변경된 소스코드를 저희쪽에 기여해 주실 수도 있습니다.



