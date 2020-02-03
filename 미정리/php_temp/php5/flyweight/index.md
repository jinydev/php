---
layout: default
title: FlyWeight
subtitle: "patterns"

tree: /php
---

### 플라이웨이트 패턴
---

플라이웨이트란 뜻은 가볍다는 입니다. 플라이웨이트 패턴을 통하여 중복된 객체를 생성하지 않고, 재사용함으로써 메모리의 공간을 적게 할당하게 하는 디자인 패턴입니다.

우리는 가끔씩 객체를 중복하여 생성 사용하는 하는 실수를 하게 됩니다. 프로그램이 방대해 지고, 추적이 어렵게 되면 어느순간 중복된 메모리 할당을 하게 될 수도 있습니다. 플라이웨이트 패턴은 객체를 생성, 호출하기 전에 미리 존재하는 지를 검사하여 간적적으로 객체를 관리하는 패턴입니다.

<br>

### 기본실습
---

기본 코드를 통하여 플라이웨이트 패턴에 대해서 알아 보도록 하겠습니다.

flyweight/01/Flyweight.php
```php
<?php
/**
 * 플라이웨이트 클래스를 생성합니다.
 */
class Flyweight
{
    public function __construct()
    {
        echo __CLASS__." 객체를 생성합니다. \n";
    }

    public function getData($data)
    {
        echo "입력값($data)을 반환합니다. \n";
    }

}
```
위의 객체는 단순한 출력 메소드만 가지고 있습니다.

그리고 플라이웨이트 객체를 생성관리할 수 있는 플라이웨이트 팩토리 클래스를 하나 정의합니다.

flyweight/01/FlyweightFactory.php
```php
<?php
/**
 * 팩토리 클래스를 생성합니다.
 */
class FlyweightFactory
{
    public $_arrInstance;

    public function __construct()
    {
        echo __CLASS__." 객체를 생성합니다. \n";
    }

    public function getFlyweight($name)
    {
        if (!$this->_arrInstance[$name]) {
            echo "새로운 Flyweight를 생성합니다. \n";
            $this->_arrInstance[$name] = new $name;
        } else {
            echo "기존 Flyweight를 반환합니다. \n";
        }
        return $this->_arrInstance[$name];
    }
}
```
플라이웨이트 팩토리 클래스는 플라이웨이트 객체의 인스턴스를 생성하고 관리를 합니다.
객체가 존재하지 않으면 새롭게 생성을 합니다. 그리고 이를 내부 프로퍼티 변수에 저장을 합니다.

만일 다시 클래스의 사용을 요청한다면, 새로운 클래스를 생성하는 것 대신에 기존의 만들어진 클래스를 반환합니다.

이렇게 만든 플라이웨이트를 만들고, 재사용 해보도록 하겠습니다.
flyweight/01/index.php
```php
<?php

require "Flyweight.php";
require "FlyweightFactory.php";

// 팩토리 객체를 생성합니다.
$fly = new FlyweightFactory;

// 객체를 호출합니다.(생성)
$obj = $fly->getFlyweight("Flyweight");
$obj->getData("hello");

// 객체를 호출합니다.(기존꺼 반환)
$obj2 = $fly->getFlyweight("Flyweight");
$obj2->getData("jiny");
```
위의 코드를 출력하면 다음과 같습니다.

출력화면
```php
FlyweightFactory 객체를 생성합니다.
새로운 Flyweight를 생성합니다.
Flyweight 객체를 생성합니다.
입력값(hello)을 반환합니다.
기존 Flyweight를 반환합니다.
입력값(jiny)을 반환합니다.
```

처음에 객체를 요구하면 `FlyweightFactory`는 새로운 객체를 생성하여 인스턴스를 반환합니다. 두번째 요구시에는 `FlyweightFactory`가 저장해 놓은 인스턴스를 반환하게 됩니다.
<br>

### 정리
---

플라이웨이는 프로젝트 내에서 객체, 변수들을 할당을 적게 하기 위한 패턴입니다. 한번 할당한 메모리를 재사용함으로써 메모리를 관리하게 됩니다.
