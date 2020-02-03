---
layout: default
title: Factory
subtitle: "patterns"

tree: /php
---


### 팩토리 패턴
---

팩토리 패턴은 다른말로 `단순 팩토리`패턴 이라고도 말합니다. 팩토리는 사전적인 의미로 "공장"을 말합니다. 여기서의 공장은 클래스의 인스턴스를 생성하는 역할을 하기 때문에 공장이라는 단어를 패턴 이름으로 사용을 하였습니다. 즉, 팩토리 패턴은 클래스의 인스턴스를 생성하는 디자인 패턴입니다. 

단순 팩토리 패턴은 생성자 패턴 중에서도 가장 많이 사용을 하는 생성자 패턴중의 하나입니다. 이는 매우 간단한 형태라서 자신도 모르게 무의식 적으로 이미 사용을 하고 있을 지도 모릅니다.

최신 모던한 스타일의 코딩 스타일은 단연코 객체지향 프로그래밍 이라 말 할 수 있습니다. 클래스를 설계하고, 설계된 클래스를 실제로 사용가능한 객체로 인스턴스화 작업후 메모리로 올리는 것은 객체지향 프로그램의 시작입니다. 또한, 실제로 객체를 생성하는 방법과 시점은 객체지향 프로그래밍을 효율적으로 하는데 매우 중요합니다.

<br>

### 인스턴스 생성
---
인스턴스는 설계된 클래스를 기반으로 실제 동작하는 객체를 생성하여 메모리에 생성하는 작업을 말합니다. 

우리는 전형적으로 객체를 생성할 때 `new` 키워드를 사용합니다. `new` 키워드는 지정한 객체의 인스턴스를 생성하여 반환을 합니다.

```php
$변수 = new 객체명(인자, 인자, 인자);
```

이 방식으로 우리가 오랫동안 직접적으로 객체지향 코드를 생성을 합니다. 또한 매우 간결하고 편리합니다.

다음 예제는 클래스를 하나 선언하고, `new` 키워드를 통하여 인스턴스를 생성합니다.
Fatory/01/index.php
```php
<?php

class Product
{
    public function __construct()
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
    }
}

$obj = new Product();
```

코드를 실행해 보면 다음과 같습니다.

결과
```php
Product 객체를 생성합니다.
```

<br>

### 문제점 분석
---
직접적으로 `new`키워드를 이용하여 인스턴스를 생성하는 것을 우리는 당연하다고 생각합니다. 하자만, 디자인 패턴에서는 항상 사용하던 객체의 인스턴스 생성 방법에 대해서 연구를 하였습니다. 
인스턴스의 생성은 객체지향에서 코드들이 대화를 하는 객체이기 때문에 중요한 부분이기 때문입니다. 

수많은 객체지향 코드들 분석으로 우리는 기존 프로젝트에서 인스턴스를 생성하고 만드는 과정에 약간의 의문점을 발견하였습니다. 코드를 유지 보수 하다보면 직접적으로 객체 인스턴스를 생성하는 것은 코드간의 의존성을 증가시킨다는 것입니다.

그래서 디자인 패턴 측면에서 `new` 키워드를 이용하여 직접 객체를 생성하는 것은 유지보수 측면에서 좋은 작성법이 아니라는 것입니다.

예제를 통하여 알아 보도록 하겠습니다. 다음 코드는 제품 클래스와 제품을 사용하는 사용자 클래스입니다. UserA, UserB는 product 클래스를 공통적으로 사용하고 있습니다.

Factory/02/Product.php
```php
<?php

class Product
{
    protected $_name;

    public function __construct($name=NULL)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_name = $name;
    }

    public function getName()
    {
        echo "제품명은 ". $this->_name. "입니다. <br>";
    }

}
```

클래스 UserA는 작업을 하기 위해서 Product 클래스의 기능이 필요로 합니다. 내부 동작 메서드에서 product 클래스의 인스턴스를 직접 생성하여 작업을 합니다.

Factory/02/UserA.php
```php
<?php
class UserA
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.

        return new Product($this->_product);
    }    
}
```

클래스 UserB 또한 Product 클래스의 기능을 필요로 합니다.

Factory/02/UserB.php
```php
<?php
class UserB
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.

        return new Product($this->_product);
    }    
}
```

UserA, UserB는 객체를 사용하기 위해서 `new` 키워드를 이용하여 인스턴스를 생성하게 됩니다.

생성된 객체를 적용하여 출력 코드를 작성해 보도록 하겠습니다.

Factory/02/index.php
```php
<?php

require "Product.php";
include "UserA.php";

$job = new UserA("S-822");
$product = $job->doSomthing();

$product->getName();
```

위의 코드를 실행한 결과 입니다.

결과
```php
UserA 객체를 생성합니다.
Product 객체를 생성합니다.
제품명은 S-822입니다.
```

객체는 필요한 다른 클래스를 직접 불러와서 사용을 할 수 있습니다. 위의 예제처럼 클래스가 다른 클래스를 직접 읽어와서 사용하는 방법것을 연관관계가 강한다 `strong relationship` 라고 말합니다.

클래스간의 연관관계가 강하게 되면 유지보수 하는데 힘이 듭니다. 만일 product 클래스의 인스턴스 생성방법이 변경되었다고 생각해 봅시다. 또는 클래스의 이름이 변경이 될 수도 있습니다.

이처럼 클래스의 변경이 발생하게 되면 product 클래스를 사용하는 모든 관련 클래스 파일을 찾아 수정해야 합니다.

Factory/03/goods.php
```php
<?php

class Good
{
    protected $_name;
    protected $_location;

    public function __construct($name=NULL, $location="kr")
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_name = $name;
        $this->_location = $location;
    }

    public function getName()
    {
        echo "제품명은 ". $this->_name. "입니다. <br>";
    }
}
```

Product 클래스가 위와 같이 good 클래스와 초기방법이 변경이 되었다고 생각해 봅니다. 그럼 이전에 product 클래스를 사용하던 UserA도 변경을 해야 합니다.

Factory/03/UserA.php
```php
<?php
class UserA
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.

        return new Good($this->_product);
    }    
}
```

Product 클래스의 이름을 Good 클래스 이름으로 변경을 합니다.

Factory/03/index.php
```php
<?php

require "good.php";
include "UserA.php";

$job = new UserA("S-822");
$product = $job->doSomthing();

$product->getName();
```

다음은 출력한 코드 결과 입니다.

결과
```php
UserA 객체를 생성합니다.
Good 객체를 생성합니다.
제품명은 S-822입니다.
```

유지보수 적인 측면을 고려하면 이처럼 강하게 결합된 클래스 관계를 유연하게 변경하 필요성이 있습니다.
<br>

### 팩토리 패턴적용
---
디자인 패턴에서 이를 해결하는 방법을 제시합니다. 디자인 패턴은 이렇게 강하게 연관관계를 가지고 있는 클래스들을 `유연한 관계`로 바꾸어 주는 역할을 합니다.

디자인 패턴에서 제안하는 해결방식은 인스턴스를 생성을 다른 클래스로 `위임`을 처리하는 것입니다. 위임이란 메소드를 통하여 처리하는 것을 말합니다. 
다른 클래스로 인스턴스 생성을 위임하는 패턴을 팩토리 패턴이라고 합니다.

팩토리 패턴은 패턴 중에서도 간결하고 이해가 상대적으로 쉬운 디자인 패턴입니다. 

기존 Product <-> UserA 관계 에서 인스턴스를 생성관리 하는 Factory 클래스를 추가합니다. Product <-> Factory <-> UserA 관계로 변경합니다.

Factory 클래슨 UserA로부터 호출되며, product의 인스턴스를 생성하여 반환을 합니다.


factory/04/Factory.php
```php
<?php

class Factory
{
    static public function getInstance()
    {
        echo "팩토리:인스턴스를 생성하여 반환합니다.<br>";
        return new Product();
    }
}
```

Factory 클래스의 getInstance() 매서드는 Product의 인스턴스를 생성하여 반환을 합니다.
그리고 UserA 클래스는 다음과 같이 변경을 합니다.

Factory/04/UserA.php
```php
<?php
class UserA
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.
        echo "팩토리를 호출합니다.<br>";
        return Factory::getInstance();
    }
}
```

이처럼 객체생성을 담당하는 전용클래스를 만들어 인스턴스 생성을 위임하는 패턴이 팩토리 패턴 입니다.

Factory/04/index.php
```php
<?php

require "factory.php";
require "Product.php";
include "UserA.php";

$job = new UserA("S-822");
$product = $job->doSomthing();
```

결과
```php
UserA 객체를 생성합니다.
팩토리를 호출합니다.
팩토리:인스턴스를 생성하여 반환합니다.
Product 객체를 생성합니다.
```
즉 팩토리 패턴은 인스턴스를 생성을 해야 되는 과정에서, 어떠한 객체의 인스턴스를 만들어 반환을 할지 정의할 수 없을 때 사용하면 매우 유용한 패턴입니다.

<br>

### 장단점
---

팩토리 패턴은 인스턴스를 생성하고 관리하는데 매유 유용한 패턴입니다. 하지만, 인스턴스를 생성하기 위해서 하나의 추가 클래스를 하나 더 만들어 사용을 해야 되기 때문에 코드의 양과, 관리가 늘어날 수 있습니다.

만일 별도의 클래스를 하나더 만들기가 부담스러운 경우 다음과 같은 방식도 있습니다.

Factory/05/Product.php
```php
<?php

class Product
{
    protected $_name;

    public function __construct($name=NULL)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_name = $name;
    }

    public function getName()
    {
        echo "제품명은 ". $this->_name. "입니다. <br>";
    }

    static public function factory()
    {
        return new Product();
    }
}
```

Product 클래스 안에 정적 형태로 자신의 인스턴스를 생성하는 메소드를 추가하는 것입니다.

Factory/05/UserA.php
```php
<?php
class UserA
{
    protected $_product;

    public function __construct($product)
    {
        // 초기화 합니다.
        echo __CLASS__. " 객체를 생성합니다.<br>";
        $this->_product = $product;
    }

    public function doSomthing()
    {
        // 제품을 사용하기 위해서
        // 인스턴스를 생성합니다.
        echo "팩토리를 호출합니다.<br>";
        return Product::factory();
    }
}
```

UserA 에서는 Product::factory()를 호출하여, 인스턴스를 생성 반환합니다.

Factory/05/index.php
```php
<?php

require "Product.php";
include "UserA.php";

$job = new UserA("S-822");
$product = $job->doSomthing();
```

결과
```php
UserA 객체를 생성합니다.
팩토리를 호출합니다.
Product 객체를 생성합니다.
```

이 방식은 라라벨과 같은 프레임워크에서도 자주 사용하는 팩토리 디자인 패턴입니다.

<br>

### 정리
---
90년대초 프로그래밍 디자인패턴 관련 서적중에서는 팩토리 패턴이 디자인 패턴이 아니라는 이야기도 있습니다. 하지만 단순 팩토리 패턴은 객체를 생성을 관리하는데 매우 유용한 방법입니다.

팩토리 패턴은 특정 클래스를 생성하고 접근을 하는데 직접 접근을 방지할 수 있습니다. 이는 보완이나 권환등의 처리를 하여 접근할 때 매우 유용하기도 합니다.

단순 팩토리 패턴은 가장 간단하고 깔끔합니다. 또한 의존적인 클래스의 생성 연관 관계를 해소할 수 있습니다.

팩토리 패턴은 `new` 키워드를 통하여 객체를 생성하는 방법의 문제점을 해결하고, 좀더 복잡한 클래스의 인스턴스도 쉽게 처리할 수 있는 방법입니다.

팩토리 패턴은 생성해야 하는 객체를 정의할 수 없을 때 사용합니다.





