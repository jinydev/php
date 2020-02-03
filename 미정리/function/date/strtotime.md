|내부함수|
```php
int strtotime ( string $time [, int $now = time() ] )
```

영어 텍스트 datetime을 Unix 타임 스탬프로 구문 분석합니다.

```php
<?php
	echo strtotime("now"), "<br>";
	echo strtotime("10 September 2000"), "<br>";
	echo strtotime("+1 day"), "<br>";
	echo strtotime("+1 week"), "<br>";
	echo strtotime("+1 week 2 days 4 hours 2 seconds"), "<br>";
	echo strtotime("next Thursday"), "<br>";
	echo strtotime("last Monday"), "<br>";
?>
```

화면출력)
```
1502097067
968544000
1502183467
1502701867
1502889069
1502323200
1501459200
```