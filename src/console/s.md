---
layout: php
---

# PHP 강조 표시 -s
-s 옵션은 PHP 소스의 문법을 강조하여 HTML 파일 형태로 출력합니다.

예제 파일 index.php
```
<?php
echo "PHP LocalServer Test";
phpinfo();
?>
```

```
C:\php-7.1.4-Win32-VC14-x86>php -s index.php
<code><span style="color: #000000">
<br /></span><span style="color: #007700">echo&nbsp;</span><span style="color: #DD0000">"PHP&nbsp;LocalServer&nbsp;Test"<br /></span><span style="color: #0000BB">?&gt;fo</span><span style="color: #007700">();
</span>
</code>
```

