---
layout: php
breadcrumb:
- setup
- env
---

# 환경 설정
---
PHP의 동작에 관련한 환경 설정은 php.ini에 의존합니다.  
php.ini 설정을 통해 PHP의 패키지 설치 및 환경 설정으로 php 실행의 `제한`을 설정할 수 있습니다.  

<br>

## 정보 출력하기
---
현재 PHP의 환경 설정 정보를 웹에서 간단하게 확인할 수 있습니다.  
phpinfo(); 함수는 현재 php의 설정 사항을 웹 화면으로 출력합니다.

예제 파일 phpinfo.php
```php
<?php
	phpinfo();
?>
```

<br>

## php.ini 위치
---
위의 환경 정보 index.php 를 실행하면 전반적인 PHP 환경 정보를 확인할 수 있습니다.  
출력 화면 첫 번째 블록에 보면 `php.ini`가 설치된 경로를 확인할 수 있습니다.


## [ini 파일](ini)
---
ini 파일의  주요 설정 기능에 대해서 알아 봅니다.

* [파일업로드](upload)
* [오류표시](error)