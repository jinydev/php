---
layout: php
---

# PHP 정보 확인 -i
---
-i 옵션은 PHP의 환경 설정 정보를 확인할 수 있습니다. 웹에서 phpinfo() 함수를 실행하는 것과 동일합니다.

|명령|
```
#] php -i
C:\php-7.1.4-Win32-VC14-x86>php -i
phpinfo()
PHP Version => 7.1.4

System => Windows NT LAPTOP-M0820HEF 10.0 build 14393 (Windows 10) i586
Build Date => Apr 11 2017 19:53:44
Compiler => MSVC14 (Visual C++ 2015)
Architecture => x86
Configure Command => cscript /nologo configure.js  "--enable-snapshot-build" "--enable-debug-pack" "--with-pdo-oci=c:\php-sdk\oracle\x86\instantclient_12_1\sdk,shared" "--with-oci8-12c=c:\php-sdk\oracle\x86\instantclient_12_1\sdk,shared" "--enable-object-out-dir=../obj/" "--enable-com-dotnet=shared" "--with-mcrypt=static" "--without-analyzer" "--with-pgo"
Server API => Command Line Interface
Virtual Directory Support => enabled
Configuration File (php.ini) Path => C:\Windows
….
….
….
….
```