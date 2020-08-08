---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# array_diff_key
---

```php
array array_diff_key ( array $array1 , array $array2 [, array $... ] )
```
내부함수 array_diff_key()는 키를 사용하여 배열의 차이점을 계산합니다.

array1의 키와 array2의 키를 비교하여 차이를 배열로 반환합니다. 이 함수는 array_diff ()와 비슷하지만 비교값이 키에서 수행된다는 점이 다릅니다.
 
예제파일) array-66.php
```php
<?php
$array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
$array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8);

var_dump(array_diff_key($array1, $array2));
?>
```

화면출력)
```
array(3) { 
    ["blue"]=> int(1) 
    ["red"]=> int(2) 
    ["purple"]=> int(4) 
} 
```