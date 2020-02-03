사용자로 직접 날짜를 입력을 받는 경우 유효성을 체크하여 데이터를 처리하면 보다 안전한 처리를 할 수 있습니다.

|내부함수|
bool checkdate ( int $month , int $day , int $year )

내부함수 checkdate()는 입력한 날짜정보가 유효한지를 검사할 수 있습니다. 날짜 유효성을 체크하여 결과를 논리값을 반환 합니다.

예제파일) checkdate.php
<?php

	$year = "2017";
	$month = "06";
	$day = "33";

	if (checkdate($day,$month,$year)){
		echo "$year - $month - $day ";
		echo "유효한 날짜 입니다.<br>";
	} else {
		echo "$year - $month - $day ";
		echo "정확하지 않은 날짜입니다.<br>";
	}
?>

화면출력)
2017 - 06 - 33 정확하지 않은 날짜입니다.