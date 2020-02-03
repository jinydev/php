|내부함수|
int idate ( string $format [, int $timestamp = time() ] )

내부함수 idate()는 정수로 현지 시간 / 날짜 형식 지정

```php
<?php
	$timestamp = strtotime('1st January 2017');

	// this prints the year in a two digit format
	// however, as this would start with a "0", it
	// only prints "4"
	echo idate('y', $timestamp);
?>
```

화면출력)
```
17
```