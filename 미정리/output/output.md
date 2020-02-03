# Output Control Functions

## 출력
`echo`는 어떠한 데이터를 즉시 화면으로 출력 합니다.

예제파일 : ob1.php
```php
<?php
echo "hello world";
```

## 출력 제한
모든 출력은 버퍼를 통하여 처리됩니다. `ob_start()`는 PHP에서 출력되는 내용을 임시버퍼로 전송을 하게 됩니다.

예제파일: ob2.php
```php
<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world";
ob_clean();
```

먼저 `ob_start()`를 이용하여 출력을 버퍼로 전환합니다.
이후 모든 출력은 임시버퍼로 저장이 됩니다.

마지막에 `ob_clean()`은 임시 버퍼의 저장된 내용을 삭제합니다. 따라서 위의 코드는 아무런 내용을 출력하지 않습니다.


## 버퍼 출력
버퍼의 저장된 내용을 화면으로 출력할때는 `on_flush()`를 사용할 수 있습니다.

```php
<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world\n";
ob_flush();

echo "jinyphp\n";
ob_flush();

ob_clean();
```

`ob_flush()`는 임시 저장된 내용을 출력으로 전달을 합니다.


## 버퍼 읽기

`ob_get_contents`는 임시버퍼에 저장된 출력 내용을 읽어 옵니다.




예제파일: ob3.php
```php
<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world";
```

하지만, 위와 같이 `ob_clean()` 이 실행되지 않고 PHP 스크립트 마지막 실행되는 경우, 버퍼의 내용을 화면으로 출력을 합니다.

## 버퍼값 읽기
임시 버퍼로 출력 전횐된 내용을 읽어 올 수 있습니다.

예제파일: ob4.php
```php
<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world";

$out = ob_get_clean();
$out = strtoupper($out);
echo $out;
```

`ob_get_clean()`은 임시 버퍼의 내용을 읽어옵니다. 읽어온 후에는 버퍼는 초기화 됩니다.

화면 출력 내용을 임시 버퍼에 저장한후에, 모두 대문자로 변환하여 출력을 하는 예제 입니다.





See Also
See also header() and setcookie(). 
Table of Contents ¶
flush — Flush system output buffer
ob_clean — Clean (erase) the output buffer
ob_end_clean — Clean (erase) the output buffer and turn off output buffering
ob_end_flush — Flush (send) the output buffer and turn off output buffering
ob_flush — Flush (send) the output buffer
ob_get_clean — Get current buffer contents and delete current output buffer
ob_get_contents — Return the contents of the output buffer
ob_get_flush — Flush the output buffer, return it as a string and turn off output buffering
ob_get_length — Return the length of the output buffer
ob_get_level — Return the nesting level of the output buffering mechanism
ob_get_status — Get status of output buffers
ob_gzhandler — ob_start callback function to gzip output buffer
ob_implicit_flush — Turn implicit flush on/off
ob_list_handlers — List all output handlers in use
ob_start — Turn on output buffering
output_add_rewrite_var — Add URL rewriter values
output_reset_rewrite_vars — Reset URL rewriter values