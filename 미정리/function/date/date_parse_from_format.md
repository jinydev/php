
|내부함수|
array date_parse_from_format ( string $format , string $date )

지정된 형식에 따른 날짜정보 읽어 옵니다.

예제파일) date_parse_from_format.php
<?php
	$date = "6.1.2017 13:00+01:00";
	print_r(date_parse_from_format("j.n.Y H:iP", $date));
?>

화면출력)
Array ( [year] => 2017 [month] => 1 [day] => 6 [hour] => 13 [minute] => 0 [second] => 0 [fraction] => [warning_count] => 0 [warnings] => Array ( ) [error_count] => 0 [errors] => Array ( ) [is_localtime] => 1 [zone_type] => 1 [zone] => -60 [is_dst] => ) 
