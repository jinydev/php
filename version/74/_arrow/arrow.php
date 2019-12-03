<?php
echo "Arrow Function Test";

$factor = 10;
$data = [1,2,3,4];
$num = array_map(fn($n)=> $n * $factor, $data);

print_r($num);