---
layout: php
breadcrumb:
- setup
- console
---

# 콘솔
---
PHP는 웹 브라우저를 통해 실행뿐만 아니라 콘솔에서 `직접 명령`으로 PHP를 실행할 수 있습니다.  

콘솔 명령을 다른 말로는 CLI(command Line Interface)라고도 합니다.  
PHP CLI 기능은 PHP 4.3.x 버전 이후부터 적용된 기능입니다. PHP CLI는 SAPI(Server Application Programming Interface) 형식을 지원합니다.  

<br>

## 콘솔이란?
---
컴퓨터와 사용자 사이에 대화를 할 수 있는 커맨드 기반의 입출력 장치를 말합니다.  
옛날 DOS 나 리눅스의 bash shell, 윈도우 CMD 창 등이 콜솔 명령 작업을 할 수 있는 환경입니다.  

콘솔을 이용하면 명령을 통해 컴퓨터에게 직접 작업을 실행하거나 결과를 얻을 수 있습니다.

<br>

## [콘솔 실행](execute) 
---
작성한 PHP 코드는 콘솔에서 간단하게 실행을 할 수 있습니다.  
`php`명령어 뒤에 작성한 php 코드의 파일명만을 적어 주시면 됩니다.  

```console
php 실행파일
```

<br>

## [콘솔 옵션](option) 
---
php는 다양한 콘솔 동작을 위해서 몇가지 옵션들을 제공합니다. 옵션은 콘솔 창에서 php `-help 명령` 입력을 통해서 알 수 있습니다.

[옵션목록](option)  

* [-v](v)
* [-i](i)
* [-s](s)
* [-w](w)
* [-a](a)
* [-l](l)  
* [-m](m)  
* [-r](r)  

<br>

## [실행 인자](args)
---
PHP 소스를 실행할 때 외부에서 입력하는 데이터 값을 입력 받아 처리를 할 수 있습니다.

콘솔상에서 php를 실행할때 외부 입력값을 내부 코드에 전달할 수 있습니다.  

|명령|
```console
#] php 실행코드.php arg1 arg2 arg3
```

