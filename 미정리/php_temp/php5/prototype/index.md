---
layout: default
title: Prototype
subtitle: "patterns"

tree: /php
---

### 프로토타입 패턴
---

프로토타입 패턴은 복사 패턴입니다.

프로토타입의 사전적 뜻은 ‘원형’이라는 의미를 가지고 있습니다. 프로토타입 패턴은 복잡한 인스턴스들을 복사할 때 사용을 합니다.

일반적으로 우리가 새로운 객체를 생성하는 방법은 상속을 받아 처리하는 것과, 객체를 합성하여 만드는 방법입니다.  프로토타입 패턴은 프레임워크가 객체를 합성후 클래스 인턴스를 만들 때 인스턴스를 파리미터화 하는 문제점을 보완합니다.


생산비용이 많이 들어가는 인스턴스의 경우 생성 보다는 복사를 통하여 쉽게 생성이 가능합니다.

프로토타입 패턴을 이용하면 기본적인 객체를 하나 만들어 놓고, 필요할때 마다 복사해서 사용할 수 있기 때문에, 처음 객체를 만드는 과정에서 초기화 작업들의 반복을 하지 않아도 됩니다.

<br>

### 패턴의 특징
---
프로토타입 패턴은 객체를 생성하고 유지하는 과정에서 생산비용이 높은 경우 유용합니다.

여기서 생산비용이 높다는 말은 무엇일까요?
클래스로부터 직접 인스턴스를 생성하기 어렵운 경우 또는 클래스가 정리되지 않는 종류종 많을 때 입니다.

PHP는 클래스 내부에 매직 메서드 형태로 복제를 할 수 있는 명령어와 매직 메서드가 존재합니다.

게임에서 캐릭터가 단계별로 업그레이드 가 된다고 생각해 봅시다.
새로운 객체를 생성하여 해당 값을 저장하는 것과 달리, 기존 것을 복사하여 추가된 설정값만 넣으면 편리합니다.

자바와 같은 객체지향언어는 객체를 복제하기 위해서 별도의 Cloneable 인터페이스를 명시적으로 적용받아야 합니다.

<br>

### 실습1
---
객체를 복사합니다. 복잡한 클래스의 인스턴스 생성보다 복사로 쉽게 처리를 합니다.

<br>

### 실습2

깊은복사, 얖은 복사

10.3.1 얖은복사

```php
$obj = new object;
$obj2 = $obj;
```

10.3.2 깊은복사

```php
$obj = new object;
$obj2 = clone $obj;
```



Index.php
```php
<?php
require "shape.php";
require "Circle.php";

$cir = new Circle(1 ,1, 2);
echo $cir;

echo "객체를 복사해 봅니다.<br>";

$cir2 = clone $cir;
echo $cir2;

circle.php
<?php

class Circle extends Shape
{
    private $_x, $_y, $_r;

    public function __construct($x, $y, $r)
    {
        echo __CLASS__." 객체를 생성합니다.<br>";
        $this->_x = $x;
        $this->_y = $y;
        $this->_r = $r;
    }

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function getX($x)
    {
        return $this->_x;
    }

    public function setY($y)
    {
        $this->_y = $y;
    }

    public function getY($y)
    {
        return $this->_y;
    }

    public function setR($r)
    {
        $this->_r = $r;
    }

    public function getR($r)
    {
        return $this->_r;
    }

    public function __toString()
    {
        return "가로=".$this->_x. " 세로=".$this->_y. "지름=".$this->_r. " 입니다.<br>";
    }

    public function copy()
    {
      
    }

    public function __clone()
    {
        echo "객체가 복제가 됩니다.<br>";

    }
}
```

<br>

### 정리
---
프로토 타입 패턴은 여러 패턴들과 연관 응용됩니다.

추상 팩토리 패턴은 프로로토타입 패턴들의 집합들을 저장하고 있는 상태에서 필요한 경우 기존 것을 복제하여 객체를 반환할 수도 있습니다.

프로토타입 패턴을 이용하여 유사한 명령들을 복제하여 커멘트패턴에도 적용할 수 있습니다.


프로토타입 패턴은 최근 `인터프리터`방식의 언어들에서 프로토타입 패턴의 응용을 자주 볼 수 있습니다. 이는 인터프리터 언어가 컴파일과 달리 객체를 정의하는 단계에서 객체 인스턴스를 메로리에 할당하기 때문입니다. 프로토타입 패턴을 적용하여 기존의 인스턴스를 복사하여 새로운 메모리 영역을 할당하게 됩니다.


