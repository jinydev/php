<?php
// 출력 버퍼 저장시작
ob_start();

echo "hello world\n";
ob_flush();

echo "jinyphp\n";
ob_flush();

ob_clean();