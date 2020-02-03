---
layout: default
title: Command
subtitle: "patterns"

tree: /php
---

### 커멘드 패턴
---

커멘드 패턴은 명령어 처리에 대한 패턴입니다. 즉, 커멘트패턴을 이용하여 명령을 객체화 합니다.

명령의 순서나 명령들을 객체로 하여 전달합니다.

<br>

### 분류
---
명령 패턴은 GOF의 행위 패턴으로 분류 됩니다.

### 기본실습
---
간단한 기본코드를 통하여 커멘드 패턴에 대해서 좀더 알아 보도록 하겠습니다.

커멘트 패턴은 매우 간단한 패턴중의 하나입니다. 커멘트 인터페이스 하나만의 구현으로 커멘트 패턴을 사용할 수 있습니다.

command/01/Command.php
```php
<?php
interface Command
{
    public function execute();
}
```

해당 인스턴스가 명령의 구현체가 됩니다.

command/01/index.php
```php
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
```

커멘드 인터페이스를 구현한 익명 클래스 명령 객체를 배열에 저장합니다. 배열의 각각의 명령 객체는 호출할 수 있는 `execute()` 메소드를 가지고 있습니다. 
객체로 저장된 배열을 반복하여 객체 명령을 호출합니다.

이를 실해하면 다음과 같이 출력이 됩니다.

출력화면
```php
$ php index.php
명령1 을 실행합니다.
명령2 을 실행합니다.
명령3 을 실행합니다.
```
<br>

### 정리
---

