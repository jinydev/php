---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# array_diff_assoc
---

```php
array array_diff_assoc ( array $array1 , array $array2 [, array $... ] )
```

내부함수 array_diff_assoc()는 인덱스를 기준으로 배열의 차이를 계산합니다.

array1과 array2를 비교하여 차이를 반환합니다. 비교후에 array1에 있고 다른 배열에는 없는 값들을 반환합니다. array_diff ()와 달리 배열 키도 비교에 사용합니다.

예제파일) array-62.php
```php
<?php
$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "yellow", "red");
$result = array_diff_assoc($array1, $array2);
print_r($result);
?>
```

화면출력)
```
Array ( [b] => brown [c] => blue [0] => red ) 
```