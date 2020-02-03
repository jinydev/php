---
layout: default
title: Floxy
subtitle: "patterns"

tree: /php
---

### 프록시 패턴
---

프록시 패턴은 무슨일을 직접 처리 하지 않고, 대신할 클래스에게 처리를 맡기겨서 처리하는 패턴입니다. 즉, 프로시 패턴을 통하여 작업들을 나누어 구현할 수 있습니다.

먼저 작업 내용을 원래의 클래스 객체와 프록시 객체로 처리를 분할 합니다.

원래는 프록시 클래스가 처리 먼저 해야 하나, 요청한 작업을 프록시로 대신 처리할 수 있도록 전달하는 것입니다. 만일 프록시가 전달 받은 일을 하지 못할 경우 원래의 클래스로 객체에서 해당 작업을 하게 됩니다.

<br>
### 분류
---
프록시 패턴은 GOF의 구조적 패턴으로 분류 됩니다.

### 목적
---
다른 객체에 접근을 통제, 동작을 하는 대리 객체를 생성합니다.
또한 특정한 객체의 일을 수행전, 수행후에 처리해야 되는 일이 있다면 프록시 패턴을 응용할 수 있습니다.

### 기본실습
---
간단한 기본코드를 통하여 프록시 패턴에 대해서 좀더 알아 보도록 하겠습니다.

처리해야 하는 작업에 대한 인터페이스를 정의합니다.

proxy/01/Subject.php
```php
<?php

interface Subject
{
    // 간단한 작업
    public function action1();

    //복잡한 작업
    public function action2();

}
```

실제 작업에 대한 클래스를 선언합니다.
proxy/01/RealSubject.php
```php
<?php

class RealSubject implements Subject
{

    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
    }

    public function action1()
    {
        echo __METHOD__."를 호출합니다.<br>";
        echo "action1 작업을 처리합니다.<br>";
    }

    public function action2()
    {
        echo __METHOD__."를 호출합니다.<br>";
        echo "action2 작업을 처리합니다.<br>";
    }
}
```

프록시 클래스를 만듭니다.
proxy/01/Proxy.php
```php
<?php

class Proxy implements Subject
{
    private $_object;

    public function __construct($real)
    {
        echo __CLASS__." 객체가 생성이 되었습니다.\n";
        $this->_object = $real;
    }

    public function action1()
    {
        echo __METHOD__."를 호출합니다.\n";
        echo "action1 작업을 처리합니다.\n";
    }

    public function action2()
    {
        echo __METHOD__."를 호출합니다.\n";
        $this->_object->action2();
    }
}
```

기본적인 처리는 프록시 클래스에서 처리를 합니다. 다만, 프록시에서 처리하지 못하는 동작은 프록시에서 설정한 `RealSubject`로 위임을 처리합니다.

프록시를 처리하여 동작을 출력해 보도록 하겠습니다.

```php
<?php

require "Subject.php";
require "Proxy.php";
require "RealSubject.php";

// 의존성 주입으로 실제 객체를 전달합니다.
$proxy = new Proxy(new RealSubject);

// 호출합니다.
$proxy->action1();

// 호출합니다.
$proxy->action2();
```

실행결과는 다음과 같습니다.

출력화면
```php
$ php index.php
RealSubject 객체가 생성이 되었습니다.
Proxy 객체가 생성이 되었습니다.
Proxy::action1를 호출합니다.
action1 작업을 처리합니다.
Proxy::action2를 호출합니다.
RealSubject::action2를 호출합니다.
action2 작업을 처리합니다.
```
`action1`은 프록시 클래스의 메소드가 실행되는 것을 확인할 수 있습니다. 하지만 `action2`의 경우에는 프록시가 처리할 수 없기 때문에 `RealSubject`로 위임한 클래스 객체가 처리하는 것을 보실 수 있습니다.

<br>

### 적용사례2
---
프록시 패턴은 구조를 확장하는 용도로도 사용을 할 수 있습니다.

기존에 동작을 처리하는 객체, 메소드가 있습니다. 이 객체가 동작을 수행전, 수행후에 로그기록을 하도록 추가하고자 합니다. 이런경우 기본 객체를 수정하는 것이 아니라 프록시 패턴을 통하여 프록시 메서드에서 이를 대신 처리 작업을 하도록 할 수 있습니다.


### 정리
---



