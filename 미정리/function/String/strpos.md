내부함수 strpos()는 문자열에서 검색하고자 하는 글자를 찾아 첫번째 위치를 반환합니다. 만일 글자를 찾게 되면 문자열의 시작 위치를 정수값으로 반환합니다.

|내부함수|
mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )

예제파일) strpos.php
<?php
	$string = "abcdefg";
	$keyword = "cde";
	if (($pos = strpos($string, $keyword)) === false) {
		echo "Err] 찾는 문자열이 없습니다.";
		
	} else {
		echo "문자열 시작위치 $pos 존재<br>";
	}
?>

화면출력)
문자열 시작위치 2 존재

|내부함수|
mixed stripos ( string $haystack , string $needle [, int $offset = 0 ] )

내부함수 stripos()는 strpos()와 동일한 동작을 합니다. 차이점으로는 검색시 대소문자를 구분하지 않고 처리를 합니다.