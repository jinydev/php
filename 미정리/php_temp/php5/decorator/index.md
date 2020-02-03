---
layout: default
title: Decorator
subtitle: "patterns"

tree: /php
---

### 데코레이션 패턴
---

데코레이터 패턴은 하나의 기본 객체에 새로운 부가 가능을 추가할때 유용한 패턴입니다.

어듯보면 기본 객체에 변화를 추가하여 새로운 객체를 생성하는 것이 Adapter 패턴하고 유사하다고 생각할 수도 있습니다. 하지만, 추가로 넣어지는 기능들이 범용적이라면 독립적으로 객체를 구성하여 처리하는 것이 차이점이 될 수 있습니다.

데코레이터 패턴은 하나의 기능에 부가기능을 동적으로 추가할 수 있습니다. 동적이란 실시간으로 변화되는 할일을 추가하는 것을 의미합니다.


### 분류
---
데코레이터 패턴은 GOF의 구조적 패턴으로 분류 됩니다.

### 목적
---
동적 실시간으로 객체의 기능을 추가할때 데이터레이터 패턴을 사용합니다.
확장 기능은 상속을 통하여 자유롭게 처리 할 수 있습니다.


### 연관성
---
데코레이트 패턴은 컴포짓 패턴과 같이 연관하여 학습하는 것이 좋습니다.

컴포짓 패턴의 경우 트리구조로 인한여 좌우 폭과 상하 관계등 다양한 형태의 크기로 확장될 수 있습니다.

반면에 데코레이터 패턴은 동적으로 기능이 추가되기 때문에 새로운 객체를 생성한다기 보다는 adapter 패턴처럼 새로운 기능을 추가하면서 커지는 구조라고 볼 수 있습니다. 데코레이터 패턴의 크기는 오직 상하 관계로만 커지게 됩니다. 


컴포넌트
실질적인 인터페이스 인스턴스의 역활
데코레이터와 컴포넌트를 연결하는 역할을 수행합니다.


<br>

### 기본실습
---

데코레이터 예제로 까페에서의 에스프레소를 많이 애기를 합니다. 우리는 커피 주문을 받는 POS를 제작합니다.

IBeverage.php
```php
<?php
/**
 * 인터페이스
 */
interface IBeverage
{
    public function getTotalPrice();

}
```

Base.php
```php
<?php

class Base implements IBeverage
{
    // 책임의 주체
    public function getTotalPrice()
    {

    }
}
```

Decorator.php
```php
<?php

class AbsAdding implements IBeverage
{
    private $_base;

    public function __constrcut($base){
        $this->_base = $base;
    }

    public function getTotalPrice()
    {
        $this->_base->getTotalPrice();
    }
}
```

espresso.php
```php
<?php

class Espresso extends AbsAdding
{
    public function getTotalPrices()
    {
        return parent::getTotalPrices()+50;
    }
}
```


<br>

### 정리
---




