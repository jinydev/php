---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

|내부함수|
array array_diff ( array $array1 , array $array2 [, array $... ] )
내부함수 array_diff()는 배열의 차이를 계산합니다. array1을 다른 배열과 비교합니다. 비교후에 array1에 있고 다른 배열에는 없는 값들을 반환합니다.

예제파일) array-60.php
<?php
$array1 = array("a" => "green", "red", "blue", "red");
$array2 = array("b" => "green", "yellow", "red");
$result = array_diff($array1, $array2);

print_r($result);
?>

화면출력)
Array ( [1] => blue ) 