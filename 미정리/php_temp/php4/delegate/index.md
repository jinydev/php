---
layout: default
title: Delegate
subtitle: "patterns"

tree: /php
---

### 델리게이트(delegate)
---
객체지향 프로그래밍에서 알아두어야 할 내용중에 델리게이트(delegate)가 있습니다. 델리게이트(delegate)는 두개의 객체간의 관계에서 위임을 말합니다. 
즉, 두 객체간 관계가 있을 경우에 델리게이트 한다라고 말합니다.

프로젝트를 여러 개발자들과 협업하여 개발을 할때, 구현해야 되는 기능과 코드들을 분담하게 됩니다. 그리고 나서 각각의 개발자는 자신의 맡은 코드를 개발할 것입니다.
자신의 코드만으로 맡은 기능을 마무리를 할 수도 있겠지만, 어떠한 경우에는 다른 개발자가 분담한 코드를 사용해야 되는 경우도 발생합니다.

이렇게 개발자A와 개발자B 사이에 기능과 코드를 이용하여 프로젝트를 진행해야 하는 경우는 많이 발생을 합니다. 프로젝트를 진행하면서 개발자A가 개발자B의 필요한 구현기능을 만들어 줄때까지 멈추고 있을 수 없습니다. 이런경우 델리게이트(delegate) 위임처리가 필요합니다.


먼저 개발자A와 개발자B간에 필요한 기능을 인터페이스로 정의를 합니다. 그리고 각자 개발을 하게 됩니다. 이렇게 서로간의 기능이 연관된 개발작업을 할 때 기능을 다른곳에 위임하는 것을 델리게이션이라고 합니다.

즉 다른 객체의 기능을 호출하는 것을 델리션이션이라고 합니다.

<br>

### 기본실습
---
실제 코드를 통하여 인터페이스의 동작을 이해해 보도록 하겠습니다.

A개발자가 다음과 같이 `AObject`를 개발하고 있습니다.

```php
<?php

class AObject
{
    public function funcAA()
    {
        echo "AObject의 기능AA 호출입니다.";
    }
}
```

B개발자는 자신의 코드에서 A개발자가 작성한 코드의 일부 기능을 사용해야 합니다.

```php
<?php

class BObject 
{
    private static $_delegate;

    function __construct()
    {
        self::$_delegate = new AObject;
    }

    public function funcB()
    {
        self::$_delegate->funcAA();
    }
}
```

위와 같이 A개발자의 클래스를 내부 프로퍼티로 생성하여 놓고, 내부 코드에서는 자기 코드를 작성할 수가 있습니다.

이렇게 딜리게이트한 프로젝트를  출력해 보도록 합니다.

```php
<?php

    require_once("objectA.php");
    require_once("objectB.php");

    $obj = new BObject;
    $obj->funcB();
```

