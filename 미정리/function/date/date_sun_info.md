|내부함수|
```
array date_sun_info ( int $time , float $latitude , float $longitude )
```

```php
<?php
	$sun_info = date_sun_info(strtotime("2017-08-07"), 31.7667, 35.2333);
	foreach ($sun_info as $key => $val) {
    	echo "$key: " . date("H:i:s", $val) . "\n";
	}
?>
```

화면출력)
```
sunrise: 02:59:11 sunset: 16:30:21 transit: 09:44:46 civil_twilight_begin: 02:33:08 civil_twilight_end: 16:56:24 nautical_twilight_begin: 02:01:51 nautical_twilight_end: 17:27:41 astronomical_twilight_begin: 01:29:07 astronomical_twilight_end: 18:00:25
``` 