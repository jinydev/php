|내부함수| 기준날짜
string gmdate ( string $format [, int $timestamp = time() ] )

내부함수 gmdate() 는 CMT / CUT 기준의 날짜와 시간을 반환합니다. 
기존 date() 함수와의 차이점은 기준날짜를 GMT 로 사용한다는 것입니다.

```php
<?php

	echo date("Y-m-d H:i:s");
	echo "<br>";

	echo "GMT(greenwich Mean Time) 기준 = ".gmdate("Y-m-d H:i:s");

?>
```

화면출력)
```
2017-06-18 06:31:56
GMT(greenwich Mean Time) 기준 = 2017-06-18 06:31:56
```