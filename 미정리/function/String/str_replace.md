|내부함수|
mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )

내부함수 str_replace()는 문자열 내의 특정 문자열을 검색하여 다른 문자열로 대체하여 줍니다.

예제파일) str_replace.php
<?php
	$string = "abcdefg";
	$keyword = "cde";

	$body = str_replace($keyword, " 111111 ", $string);
	echo $body;
?>

화면출력)
ab 111111 fg