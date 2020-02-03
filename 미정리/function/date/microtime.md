|내부함수| 마이크로초

```php
mixed microtime ([ bool $get_as_float = false ] )
```

내장함수 microtime()는 현재의 1/1000 초 단위로 출력합니다.

```php
<?php
	$mtime = microtime();
	echo $mtime;
?>
```

화면출력)
```
0.14970800 1497771297
```
