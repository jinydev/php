---
layout: default
title: Visitor
subtitle: "patterns"

tree: /php
---

### 방문자 패턴
---

방문자 패턴을 이용하면 객체 내에서 처리를 해야 하는 것들을 분리할 수 있습니다. 
즉 클래스에서 미리 정의하지 못한 메서드를 분리되어 있는 밖에서 처리를 하는 패턴입니다.

<br>

### 기본실습
---
기본 예제코드를 통하여 방문자 패턴에 대해서 알아 보도록 하겠습니다.

이번 예제에서는 각각의 객체의 인구조사를 하는 동작을 방문자 패턴으로 코드를 작성해 보도록 하겠습니다.

방문자 인터페이스를 생성합니다.

visitor/01/Visitor.php
```php
<?php
/**
 * 방문자
 */
interface Visitor
{
    public function visit($visitable);
}
```

방문을 받아 들여 주는 클래스의 인터페이스를 정의합니다.

visitor/01/Visitable.php
```php
<?php
/**
 * 방문을 받아 들이는 인터페이스
 */
interface Visitable
{
    public function accept($visitor);
}
```

생성한 인터페이스에 대한 구체 클래슬 생성합니다.
`VisitingAreas` 클래스는 `Visitable` 인터페이스의 구현입니다.

visitor/01/VisitingArea.php
```php
<?php
/**
 * 방문할 지역의 집들입니다.
 */
class VisitingAreas implements Visitable
{
    private $_age;
    private $_people;

    public function __construct($name, $people)
    {
        echo "방문지 ".__CLASS__." 객체를 생성하였습니다.<br>";
        $this->_name = $name;
        $this->_people = $people;
    }

    public function accept($visitant)
    {
        // 방문자를 받아들입니다.
        echo ">>> 어서오세요. ".$this->_name."집에 오신것을 환영합니다.<br>";
        
        // 자신의 this를 넣어서 방문자의 visit 메소드를 호출합니다.
        $visitant->visit($this);
    }

    public function setPeople($people)
    {
        $this->_people = $people;
    }

    public function getPeople()
    {
        return $this->_people;
    }
}
```

방문자가 `accept`로 들어오게 되면 자신의 방문자에게 메소드 호출을 하게 됩니다.

visitor/01/Visitant.php
```php
<?php
/**
 * 방문 설문조사 하는 사람
 */
class Visitant implements Visitor
{
    private $_population;

    public function __construct()
    {
        echo "방문객 ".__CLASS__." 객체를 생성하였습니다.<br>";
        $this->$_population = 0;
    }

    public function visit($visitable)
    {
        // echo __METHOD__."를 호출합니다.<br>";
        echo "... 반갑게 맞이해 주셔서 감사합니다.<br>";
        // 방문자를 확인을 합니다.
        // 입력된 객체의 클래스가 VisitableA 인지를 확인합니다.
        if ($visitable instanceof VisitingAreas) {
            // 합계를 구합니다.
            echo "... 이곳은 총 ".$visitable->getPeople()."명 이군요.<br>";
            $this->_population += $visitable->getPeople();
        }
    }

    public function population()
    {
        return $this->_population;
    }
}
```

방문자 패턴에 대한 2개의 인터페이스와 2개의 구현체를 만들어 보았습니다. 이를 통하여 방문자 패턴을 구현하여 출력해 봅니다.

visitor/01/Index.php
```php
<?php

require "visitor.php";
require "Visitant.php";

require "visitable.php";
require "VisitingAreas.php";

echo "방문자 패턴을 학습합니다.<br>";

// 방문객 객체를 생성합니다.
$visitant = new Visitant;

// 방문객이 방문지를 하나씩 
$areas = [
    new VisitingAreas("James",3),
    new VisitingAreas("Jiny",2),
    new VisitingAreas("Eric",4)
];
foreach ($areas as $obj) $obj->accept($visitant);

echo "<br>우리 동내 총 인구는 <b>". $visitant->population() ."</b> 입니다.";
```

먼저 인구조사를 하는 조사원 방문자 객체를 하나 생성합니다. 
```
// 방문객 객체를 생성합니다.
$visitant = new Visitant;
```

그리고 방문하려고 하는 지역의 집들을 배열로 만듭니다. 이 집들은 `Visitable` 인스턴스로 구현되어 있습니다.
3개의 객체를 넣어 생성합니다. 생성시 인자로, 이름과 가족 수를 같이 설정을 합니다.

이제 조사원 방문자가 배열로 된 집들을 `foreach`를 통하여 하나씩 방문을 합니다.

`accept()` 메서드를 통하여 방문할 집의 `$visitant` 인스턴스를 전달합니다. `accept()` 메서드는 매개변수로 전달 받은 방문자 인스턴스를 확인하고, 방문자 인스턴스의 `visit()` 메소드를 역으로 호출합니다. 이때, 방문한 집의 인스턴스(`$this`)를 매개변수로 전달합니다.

즉, 방문자 `$visitant` 인스턴스는 `VisitingAreas` 클래스의 `accept()` 메서드를 호출함으로서 `VisitingAreas` 클래스의 인스턴스를 가지고 올 수 있는 것입니다.
`$visitant` 인스턴스의 `visit()`매소드는 방문지의 인스턴스를 통하여 가족수를 조회하여 합산하게 됩니다.

출력한 결과는 다음과 같습니다.

화면결과
```php
방문자 패턴을 학습합니다.
방문객 Visitant 객체를 생성하였습니다.
방문지 VisitingAreas 객체를 생성하였습니다.
방문지 VisitingAreas 객체를 생성하였습니다.
방문지 VisitingAreas 객체를 생성하였습니다.
>>> 어서오세요. James집에 오신것을 환영합니다.
... 반갑게 맞이해 주셔서 감사합니다.
... 이곳은 총 3이군요.
>>> 어서오세요. Jiny집에 오신것을 환영합니다.
... 반갑게 맞이해 주셔서 감사합니다.
... 이곳은 총 2이군요.
>>> 어서오세요. Eric집에 오신것을 환영합니다.
... 반갑게 맞이해 주셔서 감사합니다.
... 이곳은 총 4이군요.

우리 동내 총 인구는 9 입니다.
```

방문자 패턴으로 통하여 하나의 객체가 각각의 여러 객체의 인스턴스를 하나씩 얻어낼 수 있습니다. 

<br>

### 정리
---
방문자 패턴을 간단동작이지만 클래스의 서로 연결을 통하여 사용하는 데 유용합니다.

방문자 패턴은 위와 같이 VisitingArea의 클래스가 정의되고 수정할 수 없을 경우 방문자 외부의 클래스를 통하여 업무 처리를 할 수 있는 장점이 있습니다.


참고 URL
https://www.youtube.com/watch?v=YzFzLpwxSM4&index=15&list=PLsoscMhnRc7pPsRHmgN4M8tqUdWZzkpxY


