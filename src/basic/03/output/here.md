---
layout: php
---

# here document
---
here document는 PHP 스크립트 안에서 긴 다중 라인의 문자열을 출력하거나 대입할 때 쓸 수 있는 문법입니다. 다른 말로 Newdoc 스타일이라고도 합니다.  

`<<<` 직후의 문자열은 끝을 나타내는 문자열로 터미네이션 ID라고 합니다. 터미네이션 ID로는 EOF, EOL, EOT, END 등이 있습니다.  

예제파일: newdoc-01.php
```php
<?php
$text = <<<EOL
안녕하세요
EOL;

echo $text;
?>
```

문자열을 표현하는 따옴표 없이 화면에 출력할 수 있습니다.  

예제파일: newdoc-02.php
```php
<?php
echo  <<<END
안녕하세요
END;
?>
```

변수 없이 바로 출력합니다.  

Nowdoc 스타일의 종료 문자는 앞에 공백이 있으면 안 됩니다. 이러한 스타일은 변수나 특수문자, 큰따옴표, 작은따옴표 등을 섞어서 사용할 수 있습니다.  

<br><br>