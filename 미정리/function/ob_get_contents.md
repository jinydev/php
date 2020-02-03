---
layout: post
permalink: /function/ob_get_contents
---

# ob_get_contents
(PHP 4, PHP 5, PHP 7)


ob_get_contents — Return the contents of the output buffer

## Description ¶

```php
ob_get_contents ( void ) : string
```

Gets the contents of the output buffer without clearing it.

## Return Values ¶
This will return the contents of the output buffer or FALSE, if output buffering isn't active. 

## Examples ¶
Example #1 A simple ob_get_contents() example
<?php

ob_start();

echo "Hello ";

$out1 = ob_get_contents();

echo "World";

$out2 = ob_get_contents();

ob_end_clean();

var_dump($out1, $out2);
?> 
The above example will output:
string(6) "Hello "
string(11) "Hello World"