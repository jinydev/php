---
layout: php
---

# PHP 명령행 실행 -w
---
-w 옵션은 소스의 주석과 공백을 제거한 소스를 다시 출력합니다.  

```
C:\php-7.1.4-Win32-VC14-x86>php -w index.php
<?php
echo "PHP LocalServer Test"; phpinfo(); ?>
```

* PHP 명령행 실행 -r
-r 옵션은 php 콘솔상에서 PHP의 명령어를 직접 입력하여 실행할 수 있습니다.  

```
C:\php-7.1.4-Win32-VC14-x86>php -r "echo 'hello world!';"
hello world!
```

위의 콘솔 예제처럼 스크립트 파일을 작성하지 않고도 직접 간단한 명령을 php 입력으로 실행할 수 있습니다.  