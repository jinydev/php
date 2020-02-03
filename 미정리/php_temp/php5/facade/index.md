---
layout: default
title: Facade
subtitle: "patterns"

tree: /php
---

### 파사드 패턴
---

최근들어 IT 업계의 화두는 클라우드, API 와 같은 서비스입니다. 특히, API 서비스는 복작한 업무와 처리작업들을 외부에 의존하고 이를 통신할 수 있는 규약만 제공합니다.

파사트 패턴은 GOF에서 설명하는 구조 패턴중의 하나 입니다. 파사드 패턴은 복잡하게 얼켜있는 업무로직들을 정리하여 상위 레벨의 인터페이스로 캐슐화 해 놓은 패턴입니다.
캑슐화된 인터페이스를 통하여 하위 시스템에 접근하여 동작을 처리 합니다. 

파사트 패턴은 연관되는 매서드들을 하나로 묶어서 이를 실행합니다.


파사트 패턴은 서브시스템을 직접 호출하여 접근하지 않고, 이 시스템을 접근할 수 있는 겉면 클래스함수를 통하여 접근하는 방법입니다.

파사드는 사전적 의미로 해석하면 "표면, 허울" 입니다. 파사드는 복잡한 과정을 처리하기 위한 중간의 간단한 레이어 계층이라 할 수 있습니다.

HTTP와 같은 통신 규약처리등 파사트 패턴을 적용하여 구현을 하는 사래들이 많이 있습니다.

파사드 패턴을 다른 말로 `singletone abstract factory`라고도 부르기도 한다고 합니다.

<br>

### 기본실습
---

기본 코드를 통하여 파사트 패턴을 좀더 알아 보도록 하겠습니다.

기본 기능에 대한 클래스를 먼저 선언을 합니다. 여기서는 3개의 기능을 각각 package1, package2, package3 로 생성을 합니다.

facade/01/package1.php
```php
<?php
/**
 * 기능1 클래스를 선언합니다.
 */
class Package1
{
    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
    }

    public function process()
    {
        echo "패키지1 작업을 진행합니다.<br>";
    }
}
```

facade/01/package2.php
```php
<?php
/**
 * 기능2 클래스를 선언합니다.
 */
class Package2
{
    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
    }

    public function process()
    {
        echo "패키지2 작업을 진행합니다.<br>";
    }
}
```

facade/01/package3.php
```php
<?php
/**
 * 기능3 클래스를 선언합니다.
 */
class Package3
{
    public function __construct()
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
    }

    public function process()
    {
        echo "패키지3 작업을 진행합니다.<br>";
    }
}
```

패키지 동작에 대한 파사드 패턴을 생성합니다.
facade/01/facade.php
```php
<?php
/**
 * 패키지에 대한 파사드 패턴
 */
class Facade
{
    private $_package1;
    private $_package2;
    private $_package3;

    /**
     * 인스턴스를 생성합니다.
     */
    public function __construct()
    {
        $this->_package1 = new Package1;
        $this->_package2 = new Package2;
        $this->_package3 = new Package3;
    }

    /**
     * 패키지 동작 1,2,3 을 한번에 수행해야 되는
     * 복잡한 동작을 파사드 메서드로 생성합니다.
     */
    public function processAll()
    {
        $this->_package1->process();
        $this->_package2->process();
        $this->_package3->process();
    }

}
```

파사드 패턴은 복작한 동작이나 다른 페키지에 대한 처리를 외부에서 쉽게 접근할 수 있도록 메소드를 생성합니다. 외부에서는 이렇게 생성된 메서드를 한번만 호출함으로써 여러 외부 동작들을 한번에 수행을 할 수 있습니다.

파사드 패턴을 이용하여 동작을 출력해 보도록 합니다.
facade/01/index.php
```php
<?php
require "package1.php";
require "package2.php";
require "package3.php";

require "facade.php";
/*
기존에 페키지를 직접 접근하여 사용
*/
// $obj1 = new Package1;
// $obj1->process();
// $obj2 = new Package2;
// $obj2->process();
// $obj3 = new Package3;
// $obj3->process();

/*
파사드
*/
$obj = new Facade;
$obj->processAll();
```

각각의 패키지 객체를 실행하는 것이 아니라, 파사드 패턴의 메서드를 호출하여 한번에 실행을 합니다.
실행 결과는 다음과 같습니다.

화면출력
```php
Package1 객체가 생성이 되었습니다.
Package2 객체가 생성이 되었습니다.
Package3 객체가 생성이 되었습니다.
패키지1 작업을 진행합니다.
패키지2 작업을 진행합니다.
패키지3 작업을 진행합니다.
```

<br>

### 정리
---
파사드 패턴은 라라벨과 같이 프레임워크에서 빈번하게 사용하는 디자인 패턴입니다.


 
참고URL
https://www.youtube.com/watch?v=BqDimaIoStQ&list=PLsoscMhnRc7pPsRHmgN4M8tqUdWZzkpxY&index=19

