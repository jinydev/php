
내부함수 strstr()는 문자열안에서 찾을 문자의 첫 번째 위치를 구하고, 이후의 문자열을 데이터를 반환합니다. 문자를 검색할때는 대소문자를 구별을 하는 점을 주의 하셔야 합니다.

|내부함수|
string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )

strchr() 함수는 strstr() 함수의 별칭으로 동일한 작업을 수행합니다.

예제파일) strstr.php
<?php
	$str = "abcdeghijklem-abcdeghijklem-1234567";
	echo "원본 : " . $str . "<br>";

	// 문자열에서 em- 으로 시작하는 위치를 찾아
	// 이후의 문자열을 반환합니다.
	$a = strstr($str,"em-");
	echo $a; 
?>

화면출력)
원본 : abcdeghijklem-abcdeghijklem-1234567
em-abcdeghijklem-1234567

|내부함수|
string stristr ( string $haystack , mixed $needle [, bool $before_needle = false ] )

내부함수 stristr()은 strstr() 함수와 동일한 동작을 하는 함수입니다. 하지만 차이점으로는 대소문자를 구별하지 않습니다.
