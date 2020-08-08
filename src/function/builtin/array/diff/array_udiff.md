---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

|내부함수|
array array_udiff ( array $array1 , array $array2 [, array $... ], callable $value_compare_func )

내부함수 array_udiff()는 콜백 함수를 사용하여 배열의 차이를 계산합니다. 데이터 비교를위한 내부 함수를 사용하는 array_diff ()와는 차이가 있습니다.

예제파일) array-61.php
<?php
// Arrays to compare
$array1 = array(new stdclass, new stdclass,
                new stdclass, new stdclass,
               );

$array2 = array(
                new stdclass, new stdclass,
               );

// Set some properties for each object
$array1[0]->width = 11; $array1[0]->height = 3;
$array1[1]->width = 7;  $array1[1]->height = 1;
$array1[2]->width = 2;  $array1[2]->height = 9;
$array1[3]->width = 5;  $array1[3]->height = 7;

$array2[0]->width = 7;  $array2[0]->height = 5;
$array2[1]->width = 9;  $array2[1]->height = 2;

function compare_by_area($a, $b) {
    $areaA = $a->width * $a->height;
    $areaB = $b->width * $b->height;
    
    if ($areaA < $areaB) {
        return -1;
    } elseif ($areaA > $areaB) {
        return 1;
    } else {
        return 0;
    }
}

print_r(array_udiff($array1, $array2, 'compare_by_area'));
?>

화면출력)
Array ( [0] => stdClass Object ( [width] => 11 [height] => 3 ) [1] => stdClass Object ( [width] => 7 [height] => 1 ) ) 
