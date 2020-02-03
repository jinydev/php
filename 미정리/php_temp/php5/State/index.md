---
layout: default
title: State
subtitle: "patterns"

tree: /php
---

### 상태패턴
---

상태 패턴은 객체를 이용하여 상태를 표현하는 패턴입니다. 이러한 상태를 분석하여 객체의 처리 동작을 구현할 수 있습니다.
상태 패턴은 객체의 상태와 직접적인 영향을 가지게 됩니다. 어떠한 동작의 상태는 공학적, 프로그램적으로 매우 중요하게 처리 되는 분야 입니다.

상태 패턴은 어떠한 객체가 상태값을 가지고 있습니다. 그리고 어떠한 동작이 이루어 질때 상태값이 변경이 될 수 있고, 이를 처리하게 됩니다.



### 연관관계
상태패턴은 스트레이트 패턴하고 같이 비교하여 학습할 필요가 있습니다.

### 분류
---
상태 패턴은 GOF의 행위 패턴으로 분류 됩니다.

### 목적
객체 내부상태에 다른 객체 행위를 변경합니다. 또는 변경된 객체로 교체합니다.


<br>

### 기본실습
---
기본 실습 코드를 통하여 상태패턴에 대해서 알아 보도록 하겠습니다.

먼저 상태 패턴에 대한 인터페이스를 생성합니다.

state/01/lightState.php
```php
<?php
/**
 * 상태 인터페이스를 선언합니다.
 */
interface LightState
{
    public function lightOn();
    public function lightOff();
    public function lightState();
}
```

상태 인터페이스는 3개의 메소드를 정의합니다. 전구를 켜는 메소드와 끄는 메소드 입니다. 그리고 전구의 상태를 가져 올 수 있는 메서드 입니다.

상태를 처리할 객체를 생성해 주도록 합니다.

state/01/LightLamp.php
```php
<?php
/**
 * 객체를 구현합니다.
 */
class LightLamp implements LightState
{
    // private 를 이용하여 외부에서 상태를 직접 접근하여
    // 알수 없도록 속성을 정의 합니다.
    private $_lightstate;

    public function __construct()
    {
        echo __CLASS__." 객체를 생성합니다.\n";
        // 전구의 초기 상태는 꺼저 있습니다.
        $this->_lightstate = FALSE;
    }

    /**
     * 전구(LED)를 on 합니다.
     */
    public function lightOn()
    {
        echo "전구를 on 합니다.\n";
        $this->_lightstate = TRUE;
        return $this;
    }

    /**
     * 전구(LED)를 off 합니다.
     */
    public function lightOff()
    {
        echo "전구를 off 합니다.\n";
        $this->_lightstate = FALSE;
        return $this;
    }

    /**
     * 전구(LED)를 상태값을 반환합니다.
     */
    public function lightState()
    {
        return $this->_lightstate;
    }
}
```

위의 객체를 이용하여 상태를 실습해 보도록 하겠습니다.

state/01/Index.php
```php
<?php

require "LightState.php";
require "LightLamp.php";

$obj = new LightLamp;
echo $obj->lightOn()->LightState()."\n";
echo $obj->lightOff()->LightState()."\n";

echo $obj->lightOn()->LightState()."\n";
echo $obj->lightOn()->LightState()."\n";
```

화면출력
```php
$ php index.php
LightLamp 객체를 생성합니다.
전구를 on 합니다.
1
전구를 off 합니다.

전구를 on 합니다.
1
전구를 on 합니다.
1
```

### 적용사례2
---

상태값을 가지고 있을 때 메소드들은 상태를 체크하는 부분을 같이 구현을 합니다. 보통 `switch`문을 많이 사용을 합니다. 하지만 다양한 메서드에서 매번 `switch`문이 만이 들어가는 것은 좋지 않습니다.


<br>

### 정리
---

상태패턴을 이용하면 다른 객체를 실행함으로써 동작 상태의 플레그를 설정할 수도 있습니다. 여러 메소드의 동작이 하나의 프로퍼티 플레그 상태를 바라보고 동작을 처리하거나 제어를 할 수도 있기 때문에 실제 코드에서도 많이 사용하게 됩니다.

상태패턴은 UML구조상 전략패턴과 매우 유사합니다. 
전략패턴은 객체를 이용하여 적용 알고리즘을 변경하는 것과 달리 상태패턴은 이벤트로 발생되는 상태를 변경해 주는 것입니다.





 
