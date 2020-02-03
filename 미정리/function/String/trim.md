
문자열 변수는 공백도 문자로 취급을 합니다. 문자열을 가공하다가 보면 문자열 앞에 또는 뒤에 쓸모가 없는 공백문자들이 있는 경우가 있습니다. 이러한 경우 공백을 자동적으로 제거할 수 있는 내부함수를 제공하고 있습니다.

PHP는 공백을 제거하고 처리할 수 있는 3개의 함수를 제공합니다. trim(), ltrim(), rtrim() 함수는 문자열의 공백을 제거합니다.

|내부함수| 양쪽공백 제거
string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )

내부함수 trim()는 문자열의 앞/뒤에 존재하는 공백문자를 제거합니다.

|내부함수| 우측공백 제거
string rtrim ( string $str [, string $character_mask ] )
string chop (string str);

내부함수 rtrim(), chop()는 문자열 뒤쪽에 있는 공백문자를 제거합니다. chop() 함수는 rtrim() 함수의 별칭입니다.

|내부함수| 좌측공백 제거
string ltrim ( string $str [, string $character_mask ] )

내부함수 ltrim()는 문자열의 오른쪽 공백문자를 제거합니다.

예제파일) trim.php
<?php
	$string = "   jiny   ";
	echo "안녕하세요!".$string."입니다.<br>";

	// 앞뒤 공백 문자열을 삭제합니다.
	echo "안녕하세요!".trim($string)."입니다.<br>";

	// 오른쪽 공백을 제거합니다.
	echo "안녕하세요!".chop($string)."입니다.<br>";
	echo "안녕하세요!".rtrim($string)."입니다.<br>";

	// 왼쪽 공백을 제거합니다.
	echo "안녕하세요!".ltrim($string)."입니다.<br>";
?>

화면출력)
안녕하세요! jiny 입니다.

안녕하세요!jiny입니다.
안녕하세요! jiny입니다.
안녕하세요! jiny입니다.
안녕하세요!jiny 입니다.
