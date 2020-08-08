---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# array_diff_uassoc
---

array array_diff_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )

내부함수 array_diff_uassoc()는 사용자 지정 콜백함수를 통하여 배열을 검사합니다. array1과 array2를 비교하여 차이를 반환합니다.

사용자가 제공하는 콜백 함수는 인덱스 비교에 사용됩니다.

예제파일) array-65.php
```php
<?php
function key_compare_func($a, $b)
{
    if ($a === $b) {
        return 0;
    }
    return ($a > $b)? 1:-1;
}

$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "yellow", "red");
$result = array_diff_uassoc($array1, $array2, "key_compare_func");
print_r($result);
?>
```

화면출력)
```
Array ( [b] => brown [c] => blue [0] => red ) 
```