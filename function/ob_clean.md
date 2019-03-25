# ob_clean
(PHP 4 >= 4.2.0, PHP 5, PHP 7)

출력 버퍼로 임시로 저장된 모든 내용을 삭제합니다.

## 설명

```php
ob_clean ( void ) : void
```
This function discards the contents of the output buffer. 
This function does not destroy the output buffer like ob_end_clean() does. 

The output buffer must be started by ob_start() with PHP_OUTPUT_HANDLER_CLEANABLE flag. 
Otherwise ob_clean() will not work. 

## 반환값
No value is returned. 

