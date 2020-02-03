
|내부함수|
mixed str_ireplace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )

내부함수 str_ireplace()는 str_replace ()의 대소 문자를 구별하지 않는 버전입니다.

|내부함수|
mixed substr_replace ( mixed $string , mixed $replacement , mixed $start [, mixed $length ] )

내부함수 substr_replace()는 문자열의 일부분 내에서 텍스트 바꾸기 합니다.

예제파일) substr_replace.php
<?php
	$var = 'ABCDEFGH:/MNRPQR/';
	echo "원본: $var<hr/>\n";

	/* 전제 문자열을 'bob'으로 변경합니다. */
	echo substr_replace($var, 'bob', 0) . "<br />\n";
	echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";

	/* 문자열 앞에 'bob'을 추가합니다. */
	echo substr_replace($var, 'bob', 0, 0) . "<br />\n";

	/* 'MNRPQR' 부분을 'bob'으로 바꾸기 합니다. */
	echo substr_replace($var, 'bob', 10, -1) . "<br />\n";
	echo substr_replace($var, 'bob', -7, -1) . "<br />\n";

	/* 'MNRPQR' 부분을 삭제합니다. */
	echo substr_replace($var, '', 10, -1) . "<br />\n";
?> 

화면출력)
원본: ABCDEFGH:/MNRPQR/________________________________________bob
bob
bobABCDEFGH:/MNRPQR/
ABCDEFGH:/bob/
ABCDEFGH:/bob/
ABCDEFGH://