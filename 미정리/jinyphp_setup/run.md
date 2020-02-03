---
layout: default
title: 지니프레임웍
subtitle: installation

tree: /setup
---


## 실행방법
---
로컬에서 테스트 및 웹서버를 운영하기 위해서는 별도의 웹서버 프로그램이 필요합니다. PHP는 별도의 설치 도구 없이도 웹서버 실행 환경을 제공합니다.   

PHP 자체 내장된 CLI를 통하여 서버를 실행할 수 있습니다.

CLI를 통하여 실행을 하는 방법은 다음과 같습니다.
```
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
