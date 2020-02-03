---
layout: default
title: Builder
subtitle: "patterns"

tree: /php
---

### 빌더 패턴
---

빌터 패턴은 인스턴스를 생성시 여러 복잡한 단계를 걸쳐야 하는 경우 빌터 패턴을 이용하여 이를 처리하는 방법입니다.

빌더패턴은 복잡한 제품을 동일한 과정의 반복으로 인스턴스를 만들 때 매우 유용합니다.

복합적인 객체를 생성할 때 생성과정들과 객체를 생성하는 과정을 분리할 수 있습니다. 이러한 과정의 조합은 실제품을 만들때나, 중간에 과정을 추가 확장할때도 매우 유용합니다.


07.1 복잡한 단계란?
여러 개의 인자값 또는 맴버변수를 가질 때 빌더 패턴은 유용합니다. 빌더 패턴을 이용하면 다수의 인자값 설정을 다른 클래스의 도움으로 처리를 합니다.

07.2 응용 사례
빌더 패턴은 처리하는 방법들이 독립적이고, 구축 공정 단계를 지원해야 하는 경우 좋은 패턴입니다.

<br>

### 기본실습
---

Index.php
```php
<?php
require "computer.php";
require "BuilderFactory.php";

require "BluePrint.php";
require "Product.php";

// 컴퓨터를 생성하는 팩토리
// Director
$factory = new BuilderFactory;

// 빌더를 적용할 객체를 설정합니다.
$factory->bluePrint(new Product);

// 빌드 생성된 컴퓨터의 인스턴스를 전달 받습니다.
$computer = $factory->build()->getInstance();

// 생성한 컴퓨터의 사양을 출력해 봅니다.
// __toString() 매직 메서드를 이용합니다.
echo $computer;
```

BuilderFactory.php
```php
<?php
class BuilderFactory
{
    // 정사진에 해당하는 설계도 객체를 담을 프로퍼티를 선언합니다.
    private $_blueprint;

    public function __construct()
    {
        echo "Direct 에 해당하는 ". __CLASS__ ."객체를 생성하였습니다.<br>";
    }

    // 청사진
    public function bluePrint(BluePrint $blueprint)
    {
        // 빌드할 객체의 인스턴스를 저장합니다.
        echo "빌드 인스턴스를 저장합니다=". get_class($blueprint). "<br>";
        $this->_blueprint = $blueprint;

        return $this;
    }

    public function build()
    {
        echo "컴퓨터를 빌드합니다.<br>";
        $this->_blueprint->setCpu();
        $this->_blueprint->setRam();
        $this->_blueprint->setStorage();
        
        echo "<br>";

        return $this;
    }

    public function getInstance(){
        return $this->_blueprint->getComputer();
    }
}
```

생산되는 제품의 빌더(builder) 추상 인터페이스를 정의합니다.
BluePrint.php
```php
<?php

// 설계도에 해당하는 청사진을 추상클래스로 선언합니다.
// 설계도에서 필요한 부품들을 메소드 형태로 선언
abstract class BluePrint
{
    abstract public function setCpu();
    abstract public function setRam();
    abstract public function setStorage();

    abstract public function getComputer();

}
```

Computer.php
```php
<?php

class Computer
{
    public $_cpu;
    public $_ram;
    public $_storage;

    public function __construct($cpu, $ram, $storage)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        $this->_cpu = $cpu;
        $this->_ram = $ram;
        $this->_storage = $storage;

    }

    public function __toString()
    {
        echo "이 컴퓨터의 사양은 CPU=". $this->_cpu. " RAM= ".$this->_ram. " Storage= ".$this->_storage. "입니다.<br>";
    }
}
```

ConcreateBuilder 부분입니다. Builder에서 추상화된 인터페이스를 적용하여 

Product.php
```php
<?php

// 청사진(bluePrint)의 추상을 적용하여
// 실제를 구현합니다.
class Product extends BluePrint
{
    private $_computer;

    public function __construct()
    {
        echo "컴퓨터 ".__CLASS__ ."객체를 생성하였습니다.<br>";
        // 초기화 매직메서드 실행시
        // 컴퓨터 객체 인스턴스를 생성하여 저장합니다.
        $this->_computer = new Computer("default", "default", "default");

    }

    public function setCpu()
    {
        echo "CPU를 설정합니다. ";
        $this->_computer->_cpu = "i7";

        return $this;
    }

    public function setRam()
    {
        echo "RAM를 설정합니다. ";
        $this->_computer->_ram = "8gb";

        return $this;
    }
    
    public function setStorage()
    {
        echo "Storage를 설정합니다. ";
        $this->_computer->_storage = "512gb";

        return $this;
    }

    public function getComputer()
    {
        return $this->_computer;
    }
}
```


화면출력
```php
Direct 에 해당하는 BuilderFactory객체를 생성하였습니다.
컴퓨터 Product객체를 생성하였습니다.
Computer객체가 생성이 되었습니다.
빌드 인스턴스를 저장합니다=Product
컴퓨터를 빌드합니다.
CPU를 설정합니다. RAM를 설정합니다. Storage를 설정합니다. 
이 컴퓨터의 사양은 CPU=i7 RAM= 8gb Storage= 512gb입니다.
```

<br>

### 정리
---

빌더는 다양한 요소들을 이용하여 하나의 완성된 객체를 생성합니다. 


빌더는 복잡한 추상팩토리 패턴과도 유사합니다. 추상 팩토리가 복잡한 경우 

빌더는 복잡한 객체를 단계별로 생성을 한 후, 마지막에 객체를 생성화여 반환을 합니다. 하지만 추상 팩토리는 만드는 즉시 개체를 생성하여 반환을 하게 됩니다. 즉, 객체를 생성 반환하는 시점이 차이가 있습니다.

빌더의 경우 만들려고 하는 부품들이 모여야 의미가 있고, 추상의 경우 각각이 부품들이 의미를 가지고 있습니다.




