|내부함수| 현재 시간배열
```
mixed gettimeofday ([ bool $return_float = false ] )
```

내부함수 gettimeofday()는 현재의 시간을 배열 형태로 반환합니다. 배열의 키를 통하여 각각의 값에 접근을 할 수 있습니다.

```php
<?php
	$time = gettimeofday();

	echo "현재 초 = " . $time['sec'] . "<br>";
	echo "마이크로 초 = " . $time['usec'] . "<br>";
	echo "서부 Greenwich 표준 = " . $time['minuteswest'] . "<br>";
	echo "섬머타임 보정 = " . $time['dsttime'] . "<br>";
?>
```

화면출력)
```
현재 초 = 1497770514
마이크로 초 = 65156
서부 Greenwich 표준 = 0
섬머타임 보정 = 0
```