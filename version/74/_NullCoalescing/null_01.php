<?php

$data = [];
$data['num'] = "123456";

// 값이 존재하는 경우
$data['num'] = $data['num'] ?? "000000";

// 값이 null인 경우
$data['name'] = $data['name'] ?? "jiny";

print_r($data);