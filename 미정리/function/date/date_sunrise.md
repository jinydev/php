|내부함수|
mixed date_sunrise ( int $timestamp [, int $format = SUNFUNCS_RET_STRING [, float $latitude = ini_get("date.default_latitude") [, float $longitude = ini_get("date.default_longitude") [, float $zenith = ini_get("date.sunrise_zenith") [, float $gmt_offset = 0 ]]]]] )

내부함수 date_sunrise()는 위치와 날짜에 대한 일출 시간을 계산합니다.

```php
<?php

	/* calculate the sunrise time for Lisbon, Portugal
	Latitude: 38.4 North
	Longitude: 9 West
	Zenith ~= 90
	offset: +1 GMT
	*/

	echo date("D M d Y"). ', sunrise time : ' .date_sunrise(time(), SUNFUNCS_RET_STRING, 38.4, -9, 90, 1);

?>
```