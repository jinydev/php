내부함수 strrchr()는 strstr() 함수와 반대로 마지막 위치를 찾아서 문자열 데이터를 처리합니다.  검색하고자 하는 문자열에 찾을 문자들이 여러 개가 있는 경우 마지막 부분을 반환합니다.

|내부함수|
string strrchr ( string $haystack , mixed $needle )

예제파일) strrchr.php
<?php
	$str = "abcdeghijklem-abcdeghijklem-1234567";
	echo strrchr($str,"em"); 
?>

화면출력)
em-1234567

위 실험에서 원본의 문자열에서 em 글자를 찾습니다. em 글자는 원본 문자열에 2번 포함하고 있습니다. 마지막의 em 위치를 찾아서 이후의 문자열의 데이터를 반환을 합니다.