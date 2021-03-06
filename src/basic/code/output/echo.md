---
layout: php
---

# ECHO
---
PHP에서는 강력하면서 간단하게 사용할 수 있는 echo 명령이 있습니다. echo 명령은 이후에 표시되는 값을 화면에 출력하는 명령입니다. echo는 명령어도 될 수 있고 함수도 될 수 있습니다. echo는 `()`를 사용해도 되고 생략해도 됩니다.  
 
명령어 문법)
```php
echo 출력한내용;
echo (출력할내용);
```

위의 두 가지 표현을 모두 사용을 할 수 있습니다. echo 명령문은 상수 값, 직접 입력되는 문자열 및 각종 변수의 값을 출력할 수 있습니다. 또한 여러 개의 출력 내용을 연결하고 연산된 값을 바로 출력하는 등 강력한 화면 출력 기능을 제공합니다.  
 
echo 실습1)
문자열을 화면에 출력할 수 있습니다. echo 뒤에 직접 문자열 값을 입력하여 화면에 출력할 수 있습니다.  

예제파일: echo-01.php
```php
<?php
  echo "I love PHP!";
?>
```

echo 실습2)
변수의 값을 화면에 출력할 수 있습니다. 문자열 `jinyPHP.com`을 $txt 변수에 저장하고 저장된 $txt 변수의 값을 화면에 출력합니다. 변수의 자세한 개념은 다음 장에서 설명합니다.  

예제파일: echo-02.php
```php
<?php
  $txt = "jinyPHP.com";
  echo $txt;
?>
```

echo 실습3)
문자열과 변수 값을 결합하여 화면에 출력할 수 있습니다. 직접 입력된 문자열과 변수에 저장된 문자열을 연결하는 연산자인 점(.)을 통해 연결 후 화면에 출력합니다. 연산자에 대한 자세한 개념은 다음 장에서 설명합니다.  

예제파일: echo-03.php
```php
<?php
  $txt = "jinyPHP.com";
  echo "I love " . $txt . "!";
?>
```

echo 실습4)
연산 결과 값을 화면에 출력할 수 있습니다. 변수 $x와 $y의 변수 값을 연산 후 바로 화면 출력이 가능합니다.  

예제파일: echo-04.php
```php
<?php
  $x = 5;
  $y = 4;
  echo $x + $y;
?>
```
<br>

## 단축표기
---
php 5.4 버전으로 올라오면서 단축표시 기능을 사용할 수 있게 되었습니다. 


## Quiz
---
퀴즈를 통하여 학습한 내용을 다시한번 생각해 봅니다.
<br>