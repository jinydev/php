|내부함수|
int strcasecmp ( string $str1 , string $str2 )

내부함수 strcasecmp()는 Binary safe 유형으로 대 / 소문자를 구분하지 않고 문자열을 비교 합니다.

예제파일) strcasecmp.php
<?php
	$var1 = "Hello";
	$var2 = "hello";
	if (strcasecmp($var1, $var2) == 0) {
    	echo '$var1 와 $var2 은 대소문자를 구분하지 않고 동일한 문자열 입니다.';
	}
?> 

화면출력)
$var1 와 $var2 은 대소문자를 구분하지 않고 동일한 문자열 입니다. 
