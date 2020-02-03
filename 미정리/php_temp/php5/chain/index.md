---
layout: default
title: Chain
subtitle: "patterns"

tree: /php
---

### 체인 패턴
---

이번장에서는 체인 패턴에 대해서 알아 보도록 하겠습니다.

체인 패턴은 여러가지 일들을 유연하게 연결을 하는 패턴입니다.


<br>

### 기본실습
---
자신이 먼저 처리를 해보고, 실패시 다음 객체의 메소드로 처리를 연결하는 것입니다.

Calculator.php
```php
<?php

abstract class Calculator
{
    // 다음동작
    private $_next;

    public function setNext($obj)
    {
        $this->_next = $obj;
    }

    public function process($request)
    {
        if ($this->operator($request)) {
            echo ">>> 연산이 성공적으로 처리가 되었습니다.<br>";
            return TRUE;
        } else {

            echo ">>> 연산 실패. 다음 연산으로 전달합니다.<br>";
            // 다음 체인 동작으로 처리합니다.
            if ($this->_next) {
                return $this->_next->process($request);
            }
        }
        echo "!!! 연산 실패. <br>";
        return FALSE;
    }

    // 실제적인 동작
    abstract protected function operator($request);
}
```

Plus.php
```php
<?php

class Plus extends Calculator
{
    public function __construct()
    {
        echo __CLASS__." 객체를 생성하였습니다.<br>";
    }

    protected function operator($request)
    {
        echo __CLASS__."연산을 작업합니다>>> ";
        if ($request->_o == "+") {
            echo "더하기 연산입니다.<br>";
            return TRUE;
        }
        return FALSE;
    }
}
```

Sub.php
```php
<?php

class Sub extends Calculator
{
    public function __construct()
    {
        echo __CLASS__." 객체를 생성하였습니다.<br>";
    }

    protected function operator($request)
    {
        echo __CLASS__."연산을 작업합니다>>> ";
        if ($request->_o == "-") {
            echo "빼기 연산입니다.<br>";
            return TRUE;
        }
        return FALSE;
    }
}
```

Request.php
```php
<?php

class Request
{
    public $_a, $_b;
    public $_o;

    public function __construct($a, $b, $o)
    {
        echo __CLASS__." 객체를 생성하였습니다.<br>";
        
        $this->_a = $a;
        $this->_b = $b;
        $this->_o = $o;

    }

}
```

Index.php
```php
<?php

require "Calculator.php";
require "Plus.php";
require "Sub.php";

require "Request.php";

echo "체인 패턴에 대해서 학습을 합니다.<br>";

$plus = new Plus;
$sub = new Sub;

// Plus 연산 실패시 동작할 다음 객체를 설정합니다.
$plus->setNext($sub);

$req1 = new Request(1,2,"+");
$req2 = new Request(5,3,"-");

// Plus 동작은 정상적으로 처리가 됩니다.
$plus->process($req1);

// sub 연산은 plus 연산 실패, sub로 체인 연결되어 동작합니다.
$plus->process($req2);
```

처리화면
```php
체인 패턴에 대해서 학습을 합니다.
Plus 객체를 생성하였습니다.
Sub 객체를 생성하였습니다.
Request 객체를 생성하였습니다.
Request 객체를 생성하였습니다.
Plus연산을 작업합니다>>> 더하기 연산입니다.
>>> 연산이 성공적으로 처리가 되었습니다.
Plus연산을 작업합니다>>> >>> 연산 실패. 다음 연산으로 전달합니다.
Sub연산을 작업합니다>>> 빼기 연산입니다.
>>> 연산이 성공적으로 처리가 되었습니다.
```

17.4 예제코드2
동적 체인패턴

```php
<?php

class Attact
{
    private $_amount;

    public function __construct($amount)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        echo "...".$amount." 치명타를 공격하였습니다.<br>";
        $this->_amount = $amount;
    }

    public function getAmount()
    {
        return $this->_amount;
    }

    public function setAmount($amt)
    {
        $this->_amount = $amt;
    }
}
```

```php
<?php

interface Defense
{
    public function defense($attact);
}
```

```php
<?php

Class Amor implements Defense
{
    private $_next;
    private $_def;
    
    public $_name;

    public function __construct($def, $name)
    {
        echo __CLASS__."객체가 생성이 되었습니다.<br>";
        $this->_def = $def;
        $this->_name = $name;
    }

    public function setNext($defense)
    {
        echo "다음 방어구 체인을 추가 하였습니다.<br>";
        $this->_next = $defense;
    }

    public function process($attact)
    {
        // 방어를 처리합니다.
        $this->defense($attact);

        // 다음 방어구에 대한 처리를 연속합니다.
        if ($this->_next) {
            $this->_next->process($attact);
        }
    }

    public function defense($attact)
    {
        echo "*** 방어 ".$this->_name."<br>";

        // 공격값을 읽어 옵니다.
        $amount = $attact->getAmount();

        // 방어값을 적용 합니다.
        $amount = $amount - $this->_def;
        echo ">>> ".$this->_name." 방어 $amount 를 성공하였습니다.<br>";

        // 방어한 새로운 값을 저장합니다.
        $attact->setAmount($amount);
    }

}
```

Index.php
```php
<?php

require "Attact.php";

require "Defense.php";
require "Amor.php";

echo "체인 패턴2 에 대해서 학습을 합니다.<br>";

$attact = new Attact(100);

$amor1 = new Amor(10, "방패");
$amor2 = new Amor(15, "갑옷");
$amor1->setNext($amor2);

// 공격합니다.
$amor1->process($attact);

// 추가 장비 장착
echo "== 장비를 추가 장착합니다.<br>";
$amor3 = new Amor(10, "투구");
$amor2->setNext($amor3);
$amor4 = new Amor(5, "장갑");
$amor3->setNext($amor4);

// 공격합니다.
$amor1->process($attact);
```

화면출력
```php
체인 패턴2 에 대해서 학습을 합니다.
Attact객체가 생성이 되었습니다.
...100 치명타를 공격하였습니다.
Amor객체가 생성이 되었습니다.
Amor객체가 생성이 되었습니다.
다음 방어구 체인을 추가 하였습니다.
*** 방어 방패
>>> 방패 방어 90 를 성공하였습니다.
*** 방어 갑옷
>>> 갑옷 방어 75 를 성공하였습니다.
== 장비를 추가 장착합니다.
Amor객체가 생성이 되었습니다.
다음 방어구 체인을 추가 하였습니다.
Amor객체가 생성이 되었습니다.
다음 방어구 체인을 추가 하였습니다.
*** 방어 방패
>>> 방패 방어 65 를 성공하였습니다.
*** 방어 갑옷
>>> 갑옷 방어 50 를 성공하였습니다.
*** 방어 투구
>>> 투구 방어 40 를 성공하였습니다.
*** 방어 장갑
>>> 장갑 방어 35 를 성공하였습니다.
```

<br>

### 정리
---

체인 패턴의 특징은 하나의 처리를 할 때 한 개의 클래스 객체의 메소드에서 책임을 지는 것이 아니라 여러 객체의 메소드에서 책임을 같이 처리하게 됩니다.





