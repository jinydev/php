내부함수 strrpos() 는 문자열에서 검색하고자 하는 글자의 마지막 위치의 값을 정수 값으로 반환을 합니다.

|내부함수|
int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )

예제파일) strrpos.php
<?php
	$str = "abcdeghijklem-abcdeghijklem-1234567";
	echo "원본 : " . $str . "<br>";
	$a = strrpos($str,"em-");
	echo $a; 
?>

화면출력)
원본 : abcdeghijklem-abcdeghijklem-1234567
25

|내부함수|
int strripos ( string $haystack , string $needle [, int $offset = 0 ] )

내부함수 strripos()는 strrpos() 함수와 동일하게 동작을 합니다. 차이점으로는 문자열에서 대소 문자를 구분하지 않고 문자열의 마지막 위치를 찾습니다.