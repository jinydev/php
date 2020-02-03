|내부함수|
```php
array localtime ([ int $timestamp = time() [, bool $is_associative = false ]] )
```

내부함수 localtime()는 현지 시간을 반환합니다

```php
<?php
	$localtime = localtime();
	$localtime_assoc = localtime(time(), true);
	print_r($localtime);
	print_r($localtime_assoc);
?>
```

화면출력)
```php
Array ( 
    [0] => 24 
    [1] => 6 
    [2] => 9 
    [3] => 7 
    [4] => 7 
    [5] => 117 
    [6] => 1 
    [7] => 218 
    [8] => 0 
)

Array ( 
    [tm_sec] => 24 
    [tm_min] => 6 
    [tm_hour] => 9 
    [tm_mday] => 7 
    [tm_mon] => 7 
    [tm_year] => 117 
    [tm_wday] => 1 
    [tm_yday] => 218 
    [tm_isdst] => 0 
) 
```