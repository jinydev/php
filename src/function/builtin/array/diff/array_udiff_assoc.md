---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# array_udiff_assoc
---

```php
array array_udiff_assoc ( array $array1 , array $array2 [, array $... ], callable $value_compare_func )
```

내부함수 array_udiff_assoc()는 콜백 함수를 통하여 인덱스 검사하고 배열의 데이터를 비교합니다.

예제파일) array-63.php
```php
<?php
class cr {
    private $priv_member;
    function cr($val)
    {
        $this->priv_member = $val;
    }

    static function comp_func_cr($a, $b)
    {
        if ($a->priv_member === $b->priv_member) return 0;
        return ($a->priv_member > $b->priv_member)? 1:-1;
    }
}

$a = array("0.1" => new cr(9), "0.5" => new cr(12), 0 => new cr(23), 1=> new cr(4), 2 => new cr(-15),);
$b = array("0.2" => new cr(9), "0.5" => new cr(22), 0 => new cr(3), 1=> new cr(4), 2 => new cr(-15),);

$result = array_udiff_assoc($a, $b, array("cr", "comp_func_cr"));
print_r($result);
?>
```

화면출력)
```
Array ( [0.1] => cr Object ( [priv_member:cr:private] => 9 ) [0.5] => cr Object ( [priv_member:cr:private] => 12 ) [0] => cr Object ( [priv_member:cr:private] => 23 ) ) 
]
```