---
layout: php
---

# print
---
PHP는 echo 출력문 이외에 다른 언어에서 쉽게 접해볼 수 있었던 print 명령도 같이 지원합니다. print명령문 또한 화면에 출력하는 기능을 합니다. print 명령어는 echo와 같이 `()`를 사용해도 되고 생략해도 됩니다.  
 
print 실습1)
print() 함수를 이용하여 문자열을 화면에 출력할 수 있습니다. 사용법은 echo와 비슷합니다.  


예제파일: print-01.php
```php
<?php
  print "<h2>PHP is enjoy!</h2>";
  print "Hello jiny world!<br>";
  print "I'm about to learn PHP!";
?>
```

print 실습2)
변수의 값을 화면에 출력을 할 수 있습니다. 문자열 "jinyPHP.com"을 $txt변수에 저장하고, 저장된 $txt 변수의 값을 화면에 출력합니다.  

예제파일: print-02.php
```php
<?php
  $txt = "jinyPHP.com";
  print $txt;
?>
```
 
print 실습3)
문자열과 변수 값을 결합하여 화면에 출력할 수 있습니다. 직접 입력된 문자열과 변수에 저장된 문자열을 연결 연산자인 점(.)을 통하여 연결 후 화면에 출력합니다.  

예제파일: print-03.php
```php
<?php
  $txt = "jinyPHP.com";
  print "I love " . $txt . "!";
?>
```
 
print 실습4)
연산 결과 값을 화면에 출력할 수 있습니다. 변수 $x와 $y의 변수 값을 연산 후 바로 화면 출력이 가능합니다.  

예제파일: print-04.php
```php
<?php
  $x = 5;
  $y = 4;
  print $x + $y;
?>
```

## echo VS print 
---
echo와 print 명령은 서로 유사한 기능을 하는 명령어입니다. 하지만 두 기능을 엄밀히 구분해 본다면 반환 값입니다. 반환 값은 print가 함수형으로 반환 처리를 한다는 것입니다. print는 명령 실행 후 true (1) 값을 반환하지만 echo는 그냥 화면에 출력만 합니다. 함수에 대한 자세한 개념은 다음 장에서 설명합니다.  

예제 파일 print-05.php
```php
<?php
	if ($success = print("hello World!")) {
		echo "출력 성공 ".$success;
	} else {
		echo "출력 실패 ".$success;
	}
?>
```

결과)
```
hello World!출력 성공 1
```

위의 예제는 print() 함수의 반환 값 성질을 이용한 예입니다. print 내장 함수를 통해 문자열을 출력하고 반환 값을 $success 변수에 저장합니다. $success 변수의 논리 값을 비교하여 출력 성공 메시지를 함께 출력합니다. 조건 문법 if의 자세한 개념은 다음 장에서 설명합니다.  


## Quiz
---
퀴즈를 통하여 학습한 내용을 다시한번 생각해 봅니다.
<br>