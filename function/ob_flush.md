# ob_flush
(PHP 4 >= 4.2.0, PHP 5, PHP 7)

ob_flush — Flush (send) the output buffer

## Description

```php
ob_flush ( void ) : void
```

This function will send the contents of the output buffer (if any). 

If you want to further process the buffer's contents you have to call ob_get_contents() before ob_flush() as the buffer contents are discarded after ob_flush() is called. 

This function does not destroy the output buffer like ob_end_flush() does. 

## Return Values
No value is returned. 