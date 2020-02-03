|내부함수| 날짜와 시간
```
array getdate ([ int $timestamp = time() ] )
```

내부함수 getdate()는 날짜와 시간 정보를 읽어 옵니다. 날짜와 시간의 반환 값은 배열로 받아 옵니다. 배열의 키를 통하여 각각의 값을 가지고 올 수 있습니다.

```php
<?php
	$date = getdate();

	echo "초 = ". $date['seconds'] . "<br>";
	echo "분 = ". $date['minutes'] . "<br>";
	echo "시 = ". $date['hours'] . "<br>";
	echo "달날짜 = ". $date['mday'] . "<br>";
	echo "요일(숫자) = ". $date['wday'] . "<br>";
	echo "달(숫자) = ". $date['mon'] . "<br>";
	echo "연도 = ". $date['year'] . "<br>";
	echo "일년날짜수 = ". $date['yday'] . "<br>";
	echo "요일 = ". $date['weekday'] . "<br>";
	echo "달 = ". $date['month'] . "<br>";

?>
```

화면출력)
```
초 = 38
분 = 12
시 = 7
달날짜 = 18
요일(숫자) = 0
달(숫자) = 6
연도 = 2017
일년날짜수 = 168
요일 = Sunday
달 = June
```