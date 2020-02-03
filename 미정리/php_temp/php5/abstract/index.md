---
layout: default
title: Abstract Factory
subtitle: "patterns"

tree: /php
---

### 추상 팩토리 패턴
---


추상팩토리는 클래스를 구체적으로 알지 못하는 상태에서 인스턴스를 생성 반환할 수 있는 인터페이스를 제공하기 위함입니다.

이를 통하여 관련 있는 클래스, 독립적인 클래스 군을 생성할 수 있습니다.

몇몇 개발자들은 추상팩토리 패턴을 단순 팩토리 패턴하고 혼동하여 이해를 하고 있는 경우도 많이 있습니다.


06.1 정의
객체의 생성을 가상화 합니다.


이전에 학습한 팩토리 메서드 패턴과 비교하여 생각을 해보도록 합니다. 팩토리 메소드 패턴의 경우 한 개의 공장에서 다양한 제품을 생산을 할 때 사용할 수 있는 유용패턴입니다.

하지만 추상 팩토리는 여러공장 또는 여러 종류의 클래스 인스턴스를 생성하는데 유용합니다.


<br>

### 기본실습
---

이제 회사가 좀더 커져서 국내 공장 외에 해외 공장을 하나 더 만들었다고 생각해 봅시다.

한국의 공장은 koreaFactory, 미국에 있는 공장은 stateFactory 라고 합니다.

```php
<?php

abstract class TireProduct
{
    abstract public function makeAssemble(); 
}
```

```php
<?php

class KoreaTireProduct extends TireProduct
{
    public function __construct()
    {
        echo "Product =".__CLASS__."객체를 생성합니다.<br>";
    }

    public function makeAssemble()
    {
        echo "메소드 호출 ".__METHOD__."<br>";
        echo "한국형 타이어 장착<br>";
    }
}
```

```php
<?php

class StateTireProduct extends TireProduct
{
    public function __construct()
    {
        echo "Product =".__CLASS__."객체를 생성합니다.<br>";
    }

    public function makeAssemble()
    {
        echo "메소드 호출 ".__METHOD__."<br>";
        echo "미국형 타이어 장착<br>";
    }
}
```

```php
<?php

abstract class DoorProduct
{
    abstract public function makeAssemble(); 
}
```

```php
<?php

class KoreaDoorProduct extends DoorProduct
{
    public function __construct()
    {
        echo "Product =".__CLASS__."객체를 생성합니다.<br>";
    }

    public function makeAssemble()
    {
        echo "메소드 호출 ".__METHOD__."<br>";
        echo "한국형 도어장착<br>";
    }
}
```

```php
<?php

class StateDoorProduct extends DoorProduct
{
    public function __construct()
    {
        echo "Product =".__CLASS__."객체를 생성합니다.<br>";
    }

    public function makeAssemble()
    {
        echo "메소드 호출 ".__METHOD__."<br>";
        echo "미국형 도어장착<br>";
    }
}
```

추상 팩토리 클래스를 생성합니다.

```php
<?php

abstract class Factory
{
    abstract public function createTire();
    abstract public function createDoor();
}
```

```php
<?php

class KoreaFactory extends Factory
{
    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }

    public function createTire()
    {
        return new KoreaTireProduct;
    }

    public function createDoor()
    {
        return new KoreaDoorProduct;
    }
}
```

```php
<?php

class StateFactory extends Factory
{
    public function __construct()
    {
        echo __CLASS__."객체를 생성합니다.<br>";
    }
    
    public function createTire()
    {
        return new StateTireProduct;
    }

    public function createDoor()
    {
        return new StateDoorProduct;
    }
}
```

위의 코드를 적용하여 화면에 출력을 해보도록 합니다.

```php
<?php

// 생성될 객체의 제품군을 정의
require "./product/DoorProduct.php";
require "./product/korea/KoreaDoorProduct.php";
require "./product/state/StateDoorProduct.php";

require "./product/TireProduct.php";
require "./product/korea/KoreaTireProduct.php";
require "./product/state/StateTireProduct.php";

// 추상 팩토리 패턴 정의
require "./factory/Factory.php";
require "./factory/KoreaFactory.php";
require "./factory/StateFactory.php";

echo "추상 팩토리 패턴을 실습합니다.<hr>";

// 한국공장
$korea = new KoreaFactory;

$ham = $korea->createTire();
$ham->makeAssemble();

$bread = $korea->createDoor();
$bread->makeAssemble();

echo "<br>";

// 미국공장
$state = new StateFactory;

$ham = $state->createTire();
$ham->makeAssemble();

$bread = $state->createDoor();
$bread->makeAssemble();
```

화면출력
```php
추상 팩토리 패턴을 실습합니다.
________________________________________
KoreaFactory객체를 생성합니다.
Product =KoreaTireProduct객체를 생성합니다.
메소드 호출 KoreaTireProduct::makeAssemble
한국형 타이어 장착
Product =KoreaDoorProduct객체를 생성합니다.
메소드 호출 KoreaDoorProduct::makeAssemble
한국형 도어장착

StateFactory객체를 생성합니다.
Product =StateTireProduct객체를 생성합니다.
메소드 호출 StateTireProduct::makeAssemble
미국형 타이어 장착
Product =StateDoorProduct객체를 생성합니다.
메소드 호출 StateDoorProduct::makeAssemble
미국형 도어장착
```

이처럼 여러 공장처럼 복수의 클래스가 존재합니다. 또한 각각의 공장들은 자신에 맞는 부품을 생성하는 것과 같이 종속된 서브 클래스 군을 가지고 있습니다. 이를 잘 조합하여 클래스의 인스턴스를 생성하여 반환하는 패턴을 추상 팩토리 패턴이라고 할 수 있습니다.





<br>

### 장단점
---
추상팩토리를 사용하면 클래스를 구체적으로 구별을 할 수 있습니다. 또한 클래스의 군을 쉽게 변경을 할 수도 있습니다.

그리고 클래스 군에 따른 일관성도 좋게 개선을 할 수 있습니다.

단점으로는 새로운 클래스 제품군을 추가하기 어렵습니다. 새로운 클래스 제품군이 추가될때 클래스 제품에 대한 구조를 설계하고, 이를 다시 추상 팩토리에 등록을 해야 합니다. 일이이 추가해 주는 작업은 확장성이 좋지 않습니다.

<br>

### 정리
---
추상 팩토리를 이용하면 생성되는 제품군 전체를 쉽게 변경을 할 수 있습니다. 이는 패토리 처리가 추상화 되어 있기 때문입니다.

하지만, 추상팩토리는 공정적인 방식에 의존을 해야만 되는 단점이 있습니다.

