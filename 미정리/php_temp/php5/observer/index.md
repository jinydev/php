---
layout: default
title: Observer
subtitle: "patterns"

tree: /php
---

### 옵저버 패턴
---

옵저버 패턴은 이벤트 발생에 대한 처리를 하는 동작들 입니다. 이벤트가 발생이 되면 연계된 외부의 객체를 통하여 처리를 하게 됩니다.

객체들의 서로 협력하면서 처리동작 행위를 처리할 경우 한개의 객체 변화를 다른 객체에서 참조를 하는 경우가 있을 수 있습니다. 

보통 하드웨어에서는 상태값이 변경이 되면, 인터럽트 등의 신호를 통하여 통보를 하는 형태로 동작하였습니다. 하지만 소프트웨어 적인 방법은 다릅니다. 이렇게 참조를 할 경우 이를 계속 모니터링 하는 방법과 상태를 통보하는 방법이 있습니다.


객체에 동작을 통보하는 패턴을 옵저버 패턴이라고 합니다.

<br>

### 분류
---
옵저버 패턴은 GOF의 행위 패턴으로 분류 됩니다.

### 기본실습
---

Manager.php
```php
<?php
/**
 * 추상 클래스
 */
abstract class Manager
{
    private $_name;

    abstract public function message();
}
```

UserA.php
```php
<?php
/**
 * 구현체
 */
class UserA extends Manager
{
    public function __construct($name)
    {
        echo __CLASS__."객체를 생성합니다.<br>";
        $this->_name = $name;
    }

    public function message()
    {
        echo $this->_name." 환영합니다.<br>";
    }
}
```

UserB.php
```php
<?php
/**
 * 구현체
 */
class UserB extends Manager
{
    public function __construct($name)
    {
        echo __CLASS__."객체를 생성합니다.<br>";
        $this->_name = $name;
    }

    public function message()
    {
        echo $this->_name." 환영합니다.<br>";
    }
}
```

Observerble.php
```php
<?php

class Employee
{
    public $_subs = [];

    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }

    // 관찰자 목록을 등록합니다.
    public function subscribeNotification(Manager $sub)
    {
        array_push($this->_subs, $sub);
    }


    public function update()
    {
        foreach ($this->_subs as $observer) {
            $observer->message();
        }
    }
}
```

index.php
```php
<?php

// Observer
require "Manager.php";
require "UserA.php";
require "UserB.php";

//Obserbable
require "Obserable.php";

echo "옵저버 패턴에 대해서 학습을 합니다.<br>";

$em = new Employee;

// 옵저버블에 등록을 합니다.
$a = new UserA("Jiny");
$em->subscribeNotification($a);

$b = new UserB("Eric");
$em->subscribeNotification($b);

$em->update();
```

출력화면
```php
```

<br>

### 정리
---



