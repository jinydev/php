<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world";

$out = ob_get_clean();
$out = strtoupper($out);
echo $out;
