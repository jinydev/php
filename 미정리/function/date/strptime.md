|내부함수|
array strptime ( string $date , string $format )

내부함수 strftime()으로 생성 된 시간/날짜를 파싱합니다. 참고로strptime()는 윈도우 환경에서는 지원하지 않습니다. 

예제파일) strptime.php
<?php
	$format = '%d/%m/%Y %H:%M:%S';
	$strf = strftime($format);

	echo "$strf\n";

	print_r(strptime($strf, $format));
?>

화면출력)
08/08/2017 15:06:04
Array ( [tm_sec] => 4 [tm_min] => 6 [tm_hour] => 15 [tm_mday] => 8 [tm_mon] => 7 [tm_year] => 117 [tm_wday] => 2 [tm_yday] => 219 [unparsed] => ) 