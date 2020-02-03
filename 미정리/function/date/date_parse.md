|내부함수|
```
array date_parse ( string $date )
```

지정한 날짜에 대해서 상세정보를 배열로 반환합니다.

```php
<?php
	print_r(date_parse("2017-08-07 10:00:00.5"));
?>
```

화면출력)
```
Array ( 
    [year] => 2017 
    [month] => 8 
    [day] => 7 
    [hour] => 10 
    [minute] => 0 
    [second] => 0 
    [fraction] => 0.5 
    [warning_count] => 0 
    [warnings] => Array ( ) 
    [error_count] => 0 
    [errors] => Array ( ) 
    [is_localtime] => 
) 
```