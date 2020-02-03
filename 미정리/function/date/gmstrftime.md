|내부함수|
string gmstrftime ( string $format [, int $timestamp = time() ] )

내부함수 gmstrftime()는 로컬 설정에 따른 GMT / UTC 날짜 , 시간 형식을 지정합니다.

예제파일) gmstrftime.php
<?php
	setlocale(LC_TIME, 'en_US');
	echo strftime("%b %d %Y %H:%M:%S", mktime(20, 0, 0, 12, 31, 98)) . "\n";
	echo gmstrftime("%b %d %Y %H:%M:%S", mktime(20, 0, 0, 12, 31, 98)) . "\n";
?>

화면출력)
Dec 31 1998 20:00:00 Dec 31 1998 20:00:00 
