|내부함수| 지정날짜
```php
int mktime ([ int $hour = date("H") [, int $minute = date("i") [, int $second = date("s") [, int $month = date("n") [, int $day = date("j") [, int $year = date("Y") ]]]]]] )
```

내장함수 mktime()는 지정된 날짜의 타임스템프를 생성합니다.

```php
<?php
	$hour = date("H");
	$minute = date("i");
	$second = date("s");
	$month = date("n");
	$day = date("d");
	$year = date("Y");

	$timeStamp = mktime($hour, $minute, $second, $month, $day, $year);

	// 두번째 인자로 주어진 시간을 포맷에 맞게 출력합니다.
	echo date("Y-m-d H:i:s",$timeStamp);
?>
```

화면출력)
```
2017-06-18 07:32:17
```