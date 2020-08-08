---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# array_diff_ukey
---

```php
array array_diff_ukey ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )
```

내부함수 array_diff_ukey()는 사용자 콜백함수를 통하여 배열의 키를 비교합니다.

array1의 키와 array2의 키를 비교하여 차이를 반환합니다. 이 함수는 array_diff ()와 비슷합니다만 비교 값 대신 키에서 수행된다는 점에서 차이가 있습니다.

예제파일) array-67.php
```php
<?php
    function key_compare_func($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }

    $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
    $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);

    var_dump(array_diff_ukey($array1, $array2, 'key_compare_func'));
?>
```

화면출력)
```
array(2) { 
    ["red"]=> int(2) 
    ["purple"]=> int(4) 
} 
```
