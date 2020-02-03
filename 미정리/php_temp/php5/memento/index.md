---
layout: default
title: Memento
subtitle: "patterns"

tree: /php
---

### 메멘토 패턴
---
메맨토의 사전적의미를 찾아보면 "사람・장소를 기억하기 위한 기념품"이라 해석할 수 있습니다. 이런 의미와 유사하게 메멘토 패턴은 객체의 상태를 다른 객체에 저장을 했다가, 다시 복원하는 패턴을 말합니다.

메멘토를 잘 이해하기 위해서는 접근제한자 protected에 대해서 알고 있어야 합니다.

메멘토 패턴을 이용하여 현재 객체의 스냅샷을 만들어 저장하고 다시 이를 undo 형태로 복원할 수 있습니다.

<br>

### 기본실습
---

기본 실습 코드를 통하여 보다 자세한 메멘토 패턴에 대해서 학습해 보기로 하겠습니다.

이번 예제는 3종류의 객체를 생성을 하도록 합니다. 첫번째 Originator 이름의 객체는 상태값을 가지고 있는 객체 있습니다.

먼저 상태값을 가지고 있는 객체 `Originator`를 생성합니다.
memento/01/Originator.php
```php
<?php
/**
 * 상태를 가지고 있는 객체입니다.
 */
class Originator
{
    // 상태를 저장하기 위해서 변수를 하나 가지고 있습니다.
    protected $_state;

    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.\n";
    }

    // 메멘토의 객체를 생성하여 반환을 합니다.
    public function createMemento()
    {
        echo "상태 = ".$this->_state."의 메멘토 객체를 생성합니다.\n";
        return new Memento($this->_state);
    }

    // 복원합니다.
    public function restoreMemento($mementoObj)
    {
        echo "상태를 복원합니다.\n";
        $this->_state = $mementoObj->getState();
    }

    // 상태를 읽어옵니다.
    public function getState()
    {
        return $this->_state;
    }

    // 상태를 설정합니다.
    public function setState($state)
    {
        echo $state." 객체의 상태를 저장합니다.\n";
        $this->_state = $state;
    }
}
```

상태값을 가지고 있는 `Originator` 클래스는 반드시 상태값을 저장할 프로퍼티를 하나 가지고 있어야 합니다.
```
protected $_state;
```


두번재 Memento 이름의 객체는 상태값을 가지고 있는 Originator 객체를 저장하는 역할역활 수행합니다.
`Memento` 클래스를 생성합니다.

memento/01/Memento.php
```php
<?php

class Memento
{
    protected $_mementoState;

    // 메멘토로 전달된 상태를 초기화 메서드로 저장합니다.
    protected function __construct($state)
    {
        $this->_mementoState = $state;
    }

    // 메멘토의 상태값을 읽어 옵니다.
    protected function getState()
    {
        return $this->_mementoState;
    }
}
```

메멘토의 메소드들은 외부에서 악의 적인 접근으로 상태값을 수정할 수 없도록 `protectd`로 선언을 합니다.

세번째 CareTaker는 객체를 저장 관리하는 Memento 객체를 관리하는 역할을 합니다. 
즉 Memento에 저장된 객체를 저장하거나 읽어 오는 역할을 수행합니다.


```php
<?php

require "Originator.php";
require "Memento.php";

echo "메멘토 패턴을 학습합니다.\n";

// 상태 객체를 생성합니다.
$obj = new Originator;

// 메멘토를 저장할 스텍 어레이를 생성을 합니다.
$mementoStack = array();

// 상태 1를 설정하고, 메멘토 객체를 생성을 합니다.
$obj->setState("객체 상태1");
$memento = $obj->createMemento();
array_push($mementoStack, $memento);

$obj->setState("객체 상태2");
$memento = $obj->createMemento();
array_push($mementoStack, $memento);

$obj->setState("객체 상태3");
$memento = $obj->createMemento();
array_push($mementoStack, $memento);

echo "===복원작업===\n";

$memento = array_pop($mementoStack);
$obj->restoreMemento($memento);
echo "복원된 상태값은 =".$obj->getState()."\n";

$memento = array_pop($mementoStack);
$obj->restoreMemento($memento);
echo "복원된 상태값은 =".$obj->getState()."\n";

$memento = array_pop($mementoStack);
$obj->restoreMemento($memento);
echo "복원된 상태값은 =".$obj->getState()."\n";
```

위의 실습코드를 에서 `Originator`의 객체를 생성을 합니다. 그리고 `setState()` 메소드를 이용하여 상태값을 변경을 합니다. 상태값이 변경된 객체에 대한 메멘토를 생성하여 Memento 객체를 관리하는 CareTaker 스택에 저장합니다. 

`createMemento()`메소드는 현재 `Originator`의 객체의 상태값을 저장할 수 있는 객체를 생성하고, 이 객체를 반환합니다. 즉, 상태값만 객체로 추출하여 스텍에 저장을 하는 것입니다.
이를 `객체 상태1`, `객체 상태2`, `객체 상태3` 반복하여 저장을 합니다.

이처럼 메멘토 패턴의 객체를 통하여 상태값을 저장을 했습니다. 이제 다시 저장된 상태값의 메멘토 객체를 읽어와 `Originator` 객체의 상태값을 복원해 보도록 하겠습니다. 
CareTaker 스택에서 메멘토 상태객체를 읽어 옵니다. 스택이기 때문에 마지막에 입력한 객체가 먼저 출력이 됩니다.

`Originator`의 `restoreMemento()`메소드는 메멘토에 저장된 객체를 읽어 올 수 있는 `getState()`를 호출하여 상태를 복원하게 됩니다. 이를 반복하면 저장된 스택의 값의 복원할 수 있습니다.


실행결과
```php
메멘토 패턴을 학습합니다.
Originator 객체가 생성이 되었습니다.
객체 상태1 객체의 상태를 저장합니다.
상태 = 객체 상태1의 메멘토 객체를 생성합니다.
객체 상태2 객체의 상태를 저장합니다.
상태 = 객체 상태2의 메멘토 객체를 생성합니다.
객체 상태3 객체의 상태를 저장합니다.
상태 = 객체 상태3의 메멘토 객체를 생성합니다.
===복원작업===
상태를 복원합니다.
복원된 상태값은 =객체 상태3
상태를 복원합니다.
복원된 상태값은 =객체 상태2
상태를 복원합니다.
복원된 상태값은 =객체 상태1
```

<br>

### 정리
---




