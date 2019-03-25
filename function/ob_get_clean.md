# ob_get_clean
(PHP 4 >= 4.3.0, PHP 5, PHP 7)

임시 버퍼에 저장되어 있는 내용을 읽어 옵니다. 읽어온 후에는 임시 버퍼를 삭제합니다.

## 설명

```php
ob_get_clean ( void ) : string
```

Gets the current buffer contents and delete current output buffer.

`ob_get_clean()`은 `ob_get_contents()` 와 `ob_end_clean()`를 동시에 실행하는 결과를 처리합니다. 

The output buffer must be started by ob_start() with `PHP_OUTPUT_HANDLER_CLEANABLE` and `PHP_OUTPUT_HANDLER_REMOVABLE` flags. Otherwise ob_get_clean() will not work. 

## Return Values
Returns the contents of the output buffer and end output buffering. 
If output buffering isn't active then FALSE is returned. 

## Examples
Example #1 A simple ob_get_clean() example
<?php

ob_start();

echo "Hello World";

$out = ob_get_clean();
$out = strtolower($out);

var_dump($out);
?> 