---
layout: default
title: FactoryMethod
subtitle: "patterns"

tree: /php
---

### 팩토리 메소드
---

팩토리 메소드 패턴은 기존 단순 팩토리 패턴의 확장된 패턴입니다. 팩토리 매소드 패턴은 생성자패턴 중에서 이해하기 좀 어려운 패턴중의 하나 입니다.

단순 팩토리에서 처럼 인스턴스의 생성을 다른 클래스의 하나의 메서드에서 처리하는 것과 달리, 위임된 클래스를 상속받은 있는 서브클레스에서 인스턴스를 생성하여 반환하는 패턴입니다.

```
객체 <->팩토리 클래스 <-> 서브 팩토리 클래스
```

이렇게 객체의 메소드를 다시 상속받아 처리하는 이유는 하위 서브클래스로 객체의 생성을 위임함으로써, 좀더 갭슐화를 통하여 정보도 위임을 할 수있는 장점이 있습니다.

이전에 학습한 팩토리 패턴은 인스턴스의 객체의 생성을 다른 클래스의 메소드에서 생성을 하도록 위임하는 패턴이었습니다.

<br>

### 목적
---
객체 생성에 필요한 인터페이스를 제공합니다. 실제 객체의 인스턴스를 생성하는 작업은 팩토리 클래스를 상속하는 서브 클래스에서 구현을 합니다.

### 기본실습
---

기본실습 코드를 이용하여 팩토리 메소드 패턴에 대해서 좀더 알아 보도록 하겠습니다.

자동차 회사가 있습니다. 자동차 회사에서는 여러 종류의 차량을 생산을 합니다. 승용차, 승합차, 버스, 트럭등 다양한 차종을 만들어 냅니다.
이와 유사한 동작을 팩토리 매소드 패턴으로 코드를 작성해 봅니다.


먼저 공용적으로 적용할 추상클래스를 하나 만들어 줍니다.

FactoryMethod/study2/product/CarProduct.php
```php
<?php
/**
 * 자동차 제작을 위한 
 * 추상클래스를 하나 선언합니다.
 */
abstract class CarProduct
{
    // 차량을 조립 생산합니다.
    abstract function makeAssemble();

}
```

추상클래스는 클래스에서 `makeAssemble()` 메소드를 하나 구현을 해야 합니다. 위의 추상 클래스를 상속받는 2개의 클래스를 선언 합니다.

FactoryMethod/study2/product/SedanProduct.php
```php
<?php
/**
 * 추상화 클래스를 상속받습니다.
 */
class SedanProduct extends CarProduct
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    // 추상 클래스에서 선언한 매서드를 구현합니다.
    public function makeAssemble()
    {
        echo "세단 승용차를 생산합니다.<br>";
    }
}
```
`SedanProduct` 클래스는 추상화 클래스 `CarProduct`를 적용받습니다.

이번에는 `BusProduct` 클래스를 선언합니다.
FactoryMethod/study2/product/BusProduct.php
```php
<?php
/**
 * 추상화 클래스를 상속받습니다.
 */
class BusProduct extends CarProduct
{
    public function __construct()
    {
        echo __CLASS__."를 생성합니다.<br>";
    }

    // 추상 클래스에서 선언한 매서드를 구현합니다.
    public function makeAssemble()
    {
        echo "버스 자동차를 생산합니다.<br>";
    }
}
```

한 개의 추상클래스와 이를 적용한 2개의 기능 클래스를 만들어 보았습니다.

이번에는 생성된 클래스의 객체 인스턴스를 반환하는 팩토리를 만들어 봅니다. `팩토리` 메소드 패턴은 객체의 인스턴스를 반환하는 역할을 합니다. 

팩토리 메서드 패턴에서는 단순 팩토리와 달리 직접적으로 인스턴스를 생성하여 반환 하지 않습니다. 

FactoryMethod/study2/Factory/Factory.php
```php
<?php
/**
 * 팩토리 메서드 추상화 선언
 */
abstract class Factory
{
    abstract public function createProduct($type);
}
```

먼저 팩토리에 대한 인터페이스 또는 추상 클래스를 하나를 생성합니다. 이를 상속/구현한 실제 인스턴를 만드는 클래스를 하나 더 만들게 됩니다.

FactoryMethod/study2/Factory/MakeFactory.php
```php
<?php
/**
 * 팩토리를 구현/상속받습니다.
 */
class MakeFactory extends Factory
{
    // 추상 클래스에서 선언한 매서드를 구현합니다.
    public function createProduct($product)
    {
        echo "팩토리 인스턴스를 생성하여 반환합니다.<br>";
        switch($product){
            case 'Sedan':
                return new SedanProduct;
            case 'Bus':
                return new BusProduct; 
            default:
                echo "일치된 객체가 없습니다.";
                return NULL;
        }
    }
}
```

객체를 생성하는 실제적인 기능의 구현은 추상클래스를 적용한 서브 클래스에서 담당을 합니다.
팩토리 메서드 패턴은 이처런 선언부와 구현부를 구별하여 클래스를 만들게 됩니다.이렇게 단계를 나눔으로서 클래스는 갭슐화 처리 됩니다.

이번 예제에는 전달되는 객체에 따라서 다른 각각의 클래스의 인스턴스를 생성 반환을 합니다.

작성한 팩토리 매서드 패턴을 코드로 작성하여 출력해 보도록 합니다.

FactoryMethod/study2/index.php
```php
<?php

// 생성될 객체의 제품군을 정의
require "./product/CarProduct.php";
require "./product/SedanProduct.php";
require "./product/BusProduct.php";

// 팩토리 매소드 패턴 정의
require "./factory/Factory.php";
require "./factory/MakeFactory.php";

echo "팩토리 메소드 패턴을 실습합니다.\n";

// 팩토리 매소드 패턴의 객체를 생성합니다.
// 팩토릴 메소드 객체는 서브클래스로 주상클래스 Factory를 적용 
$factory = new MakeFactory;

// 세단 자동차의 클래스 객체생성을 위임합니다.
$product = $factory->createProduct("Sedan");
if (is_object($product)) {
    $product->makeAssemble();
}

// 버스 자동차의 클래스 객체생성을 위임합니다.
$product = $factory->createProduct("Bus");
if (is_object($product)) {
    $product->makeAssemble();
}

// 트럭 자동차의 클래스 객체생성을 위임합니다.
$product = $factory->createProduct("Truck");
if (is_object($product)) {
    $product->makeAssemble();
}
```

먼저 팩토리 매서드 클래스의 객체를 하나 생성합니다. `createProduct()` 메서드를 호출하여 객체를 생성합니다.
생성된 객체를 전달받아 내부 `makeAssemble()` 메서드를 실행합니다.

출력 결과는 다음과 같습니다.

출력결과
```php
팩토리 메소드 패턴을 실습합니다.
________________________________________
팩토리 인스턴스를 생성하여 반환합니다.
SedanProduct를 생성합니다.
세단 승용차를 생산합니다.
팩토리 인스턴스를 생성하여 반환합니다.
BusProduct를 생성합니다.
버스 자동차를 생산합니다.
팩토리 인스턴스를 생성하여 반환합니다.
일치된 객체가 없습니다.
```

<br>

### 정리
---
디자인 패턴의 구조를 응용하여 작어하는 방식은 구조와 구현을 서로 분리하는 것입니다. 이러한 원칙은 팩토리 메소드 패턴 또한 같습니다.

팩토리 메소드 패턴은 템플릿 메소드 패턴을 응용됩니다. 템플릿 매소드 패턴을 같이 학습하여 개념을 알아 두면 보다 유용합니다.
또한 어떤 알고리즘을 처리할 때 알고리즘을 프로세스별로 구별하고 프로세스를 별도로 구현하는 것이 유사합니다.

 