|내부함수| 타임스템프 생성

```php
int gmmktime ([ int $hour = gmdate("H") [, int $minute = gmdate("i") [, int $second = gmdate("s") [, int $month = gmdate("n") [, int $day = gmdate("j") [, int $year = gmdate("Y")]]]]]] )
```

내부함수 gmmktime()는 GMT 기준으로 타임스탬프를 생성합니다.

```php
<?php
	// Prints: jun 18, 2017 
	echo "jun 18, 2017 is on a " . date("l", gmmktime(0, 0, 0, 6, 18, 2017));
?>
```

화면출력)
```
jun 18, 2017 is on a Sunday
```