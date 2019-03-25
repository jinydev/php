# ob_start
(PHP 4, PHP 5, PHP 7)
Turn on output buffering

## Description

```php
ob_start ([ callable $output_callback = NULL [, int $chunk_size = 0 [, int $flags = PHP_OUTPUT_HANDLER_STDFLAGS ]]] ) : bool
```

This function will turn output buffering on. 
While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer. 

The contents of this internal buffer may be copied into a string variable using ob_get_contents(). To output what is stored in the internal buffer, use ob_end_flush(). Alternatively, ob_end_clean() will silently discard the buffer contents. 
Warning
Some web servers (e.g. Apache) change the working directory of a script when calling the callback function. You can change it back by e.g. chdir(dirname($_SERVER['SCRIPT_FILENAME'])) in the callback function. 
Output buffers are stackable, that is, you may call ob_start() while another ob_start() is active. Just make sure that you call ob_end_flush() the appropriate number of times. If multiple output callback functions are active, output is being filtered sequentially through each of them in nesting order. 
Parameters ¶
output_callback
An optional output_callback function may be specified. This function takes a string as a parameter and should return a string. The function will be called when the output buffer is flushed (sent) or cleaned (with ob_flush(), ob_clean() or similar function) or when the output buffer is flushed to the browser at the end of the request. When output_callback is called, it will receive the contents of the output buffer as its parameter and is expected to return a new output buffer as a result, which will be sent to the browser. If the output_callback is not a callable function, this function will return FALSE. This is the callback signature: 
handler ( string $buffer [, int $phase ] ) : string
buffer
Contents of the output buffer. 
phase
Bitmask of PHP_OUTPUT_HANDLER_* constants. 
If output_callback returns FALSE original input is sent to the browser. 
The output_callback parameter may be bypassed by passing a NULL value. 
ob_end_clean(), ob_end_flush(), ob_clean(), ob_flush() and ob_start() may not be called from a callback function. If you call them from callback function, the behavior is undefined. If you would like to delete the contents of a buffer, return "" (a null string) from callback function. You can't even call functions using the output buffering functions like print_r($expression, true) or highlight_file($filename, true) from a callback function. 
Note: 
ob_gzhandler() function exists to facilitate sending gz-encoded data to web browsers that support compressed web pages. ob_gzhandler() determines what type of content encoding the browser will accept and will return its output accordingly. 
chunk_size
If the optional parameter chunk_size is passed, the buffer will be flushed after any output call which causes the buffer's length to equal or exceed chunk_size. The default value 0 means that the output function will only be called when the output buffer is closed. 
Prior to PHP 5.4.0, the value 1 was a special case value that set the chunk size to 4096 bytes. 
flags
The flags parameter is a bitmask that controls the operations that can be performed on the output buffer. The default is to allow output buffers to be cleaned, flushed and removed, which can be set explicitly via PHP_OUTPUT_HANDLER_CLEANABLE | PHP_OUTPUT_HANDLER_FLUSHABLE | PHP_OUTPUT_HANDLER_REMOVABLE, or PHP_OUTPUT_HANDLER_STDFLAGS as shorthand. 
Each flag controls access to a set of functions, as described below: 
Constant
Functions
PHP_OUTPUT_HANDLER_CLEANABLE
ob_clean(), ob_end_clean(), and ob_get_clean(). 
PHP_OUTPUT_HANDLER_FLUSHABLE
ob_end_flush(), ob_flush(), and ob_get_flush(). 
PHP_OUTPUT_HANDLER_REMOVABLE
ob_end_clean(), ob_end_flush(), and ob_get_flush(). 
Return Values ¶
Returns TRUE on success or FALSE on failure. 
Changelog ¶
Version
Description
7.0.0
In case ob_start() is used inside an output buffer callback, this function will no longer issue an E_ERROR but instead an E_RECOVERABLE_ERROR, allowing custom error handlers to catch such errors. 
5.4.0
The third parameter of ob_start() changed from a boolean parameter called erase (which, if set to FALSE, would prevent the output buffer from being deleted until the script finished executing) to an integer parameter called flags. Unfortunately, this results in an API compatibility break for code written prior to PHP 5.4.0 that uses the third parameter. See the flags example for an example of how to handle this with code that needs to be compatible with both. 
5.4.0
A chunk size of 1 now results in chunks of 1 byte being sent to the output buffer. 
4.3.2
This function was changed to return FALSE in case the passed output_callback can not be executed. 
Examples ¶
Example #1 User defined callback function example
<?php

function callback($buffer)
{
  // replace all the apples with oranges
  return (str_replace("apples", "oranges", $buffer));
}

ob_start("callback");

?>
<html>
<body>
<p>It's like comparing apples to oranges.</p>
</body>
</html>
<?php

ob_end_flush();

?> 
The above example will output: