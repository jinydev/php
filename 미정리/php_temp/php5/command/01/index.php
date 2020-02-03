<?php

require "Command.php";

$cmdList = [];

/**
 * Command 인터페이스를 적용한 익명함수를 저장합니다.
 */
array_push($cmdList, new class implements Command {
    public function execute()
    {
        echo "명령1 을 실행합니다.\n";
    }
});

array_push($cmdList, new class implements Command {
    public function execute()
    {
        echo "명령2 을 실행합니다.\n";
    }
});

array_push($cmdList, new class implements Command {
    public function execute()
    {
        echo "명령3 을 실행합니다.\n";
    }
});

foreach ($cmdList as $obj) $obj->execute();

