---
layout: default
title: Singleton
subtitle: "patterns"

tree: /php
---

### 싱글턴 패턴
---

객체는 속성과 기능이라는 두가지를 가지고 있습니다. 클래스는 속성과 기능을 정의한 것을 말합니다. 인스턴스 속성과 기능을 가지는 실체를 말합니다.


싱글톤은 클래스에서 하나의 인스턴스만 생성을 하게 만들게 됩니다.

싱글톤 패턴은 GOF에서 설명하는 생성 패턴중의 하나 입니다.



패턴 싱글톤

“사공이 많으면 배가 산으로 간다”
인스턴스를 하나만 만들어 내는 형태의 패턴


싱글톤 패턴을 사용하기 위해서는  static 키워드의 정학한 이해가 필요로 합니다.


싱클톤 패턴은 전역 변수역할을 하는 객체, 장치간의 드라이버 인터페이스 등 시스템에서 유일한 객체의 경우 싱글턴 패턴을 사용합니다.

### 좋은점
---
싱글톤 패턴을 사용하면 다음과 같은 장점들을 얻을 수 있습니다.
* 공유데이터를 관리 할 수 있습니다.
* 리소스를 중복생성을 방지 할 수 있습니다.
* 팩토리 패턴을 응용하여 객체 내부에서 인스턴스를 생성합니다.
* 정적 클래스로 생성

### 단점
---
싱글톤은 중복 생성을 방지하기 위해서 인스턴스를 캐쉬 형태로 처리를 합니다. 싱글톤을 통하여 캐쉬화 한다는 것은 PHP 스크립트가 끝날때 가지 유지가 되기 때문에 메모리 리소스가 계속 유지가 됩니다.
따라서 싱글톤 객체가 많아 지게 되면, 메모리 리소스를 많이 차지 하게 됩니다.

또한 싱글톤을 정적호출을 통하여 인스턴스를 생성하기 때문에, 클래스에서 장점인 상속과 복수의 객체를 생성할 수 있는 장점들을 포기하는 것과 같습니다.

멀티 쓰래드 환경에서 싱글톤은 잘못된 동작으로 2개 이상의 인스턴스가 생성될 수도 있는 오류가 발생될 수 있습니다.

### UML 다이어그램
---

```
싱글톤
-----
- instance: Singleton
-----
+ getInstance()
```


### 싱글톤 의존
---
싱글톤을 생성시 다른 클래스를 의존하다고 할때 어떻게 해야 될까요?
필요한 의존 클래스를 처리를 하고 싱클톤 인스턴스를 생성을 해야 될 것입니다.


### 싱글톤이란


클래스 내에서 인스턴스 하나만 사용할려고 할 경우, 이를 싱클톤 패턴을 이용할 수 있습니다.

OOP의 개념으로 다양한 객체에 대한 패턴(pattern)들이 생겨나기 시작합니다.
싱글톤 패턴은 OOP의 4대패턴중의 하나로 가장 많이 사용하는 유형입니다.

싱글톤패턴은 특정한 클래스의 경우 인스턴스를 하나만 생성합니다. 그리고 이렇게 한 개만 생성된 인스턴스를 다른 곳에서도 사양을 해야 합니다.

```php
<?php

class Ford
{
	public $founder = "Henry Ford";
	public $headquarters = "Detroit";
	public $employees = 164000;

	public function produces($car)
	{
		return $car->producer == $this;
	}
}

class Car
{
	public $color;
	public $producer;
}

$ford = new Ford();
$car = new Car();

$car->color = "Blue";
$car->producer = $ford;

echo $ford->produces($car);
echo "<br>";
echo $ford->founder;
```

<br>

### 싱글턴 변경
---
기존의 클래스를 싱글톤 패턴으로 변경을 해보도록 합니다.
싱클톤 패턴 변경은 먼저 생성자 키워드를 통하여 객체를 생성할 수 없도록 만드는 것이 필요합니다.

먼저 클래스에서 기본적으로 제공되는 메직메소드 몇 개를 제한해야 합니다.
__construct()와 __clone()를 숨깁니다.

#### __construct()
매직메서는__construct()는 new키워드를 통하여 클래스 인스턴스를 생성할 때 매번 자동적으로 호출되는 특수한 메서드 입니다. 

싱글턴 패턴에서는 외부에서 생성을 금지하기 위해서 속성을 protected로 제한합니다. 만일 private로 설정하게 되면 new키워드 사용시 예외가 발생됩니다.

```php
protected function __construct()
{
}
```

#### __clone()
매직 메서드 __clone()는 인스턴스를 복제할 때 자동적으로 호출되는 특수메서드 입니다.

싱클턴 패턴에서 인스턴스를 복제할 수 없도록 메소드의 속성을 private로 제한합니다.

```php
private function __clone()
{
}
```

### 인스턴스 접근
---
이제 외부에서 자동적으로 인스턴스에 영향을 줄 수 있는 메서드 들을 제한하였습니다. 
인스턴스 처리를 위해서 별도의 추가 메소드 하나를 생성합니다. 새롭게 추가한 instance() 메소드 호출을 통해서만 속성과 메서드를 접근할 수 있습니다.

```php
private static $_instance;

public static function instance()
{
	if (!isset(self::$_instance)) {
		self::$_instance = new self();
	}

	return self::$_instance;
}
```

싱클턴에서 인스턴스를 접근할 수 있는 매서드는 `static`형태로 작성을 하도록 합니다.

<br>



### 싱글턴 동작
---
기존의 클래스를 싱글턴 패턴으로 변경하는 방법에 대해서 알아보았습니다. 그럼 변경된 싱글턴을 실행해 보겠습니다.

```php
<?php
class Ford
{
	public $founder = "Henry Ford";
	public $headquarters = "Detroit";
	public $employees = 164000;

	public function produces($car)
	{
		return $car->producer == $this;
	}

	private function __construct()
	{
		// do nothing
	}
	
	private function __clone()
	{
		// do nothing
	}

	private static $_instance;
	
	public function instance()
	{
		if (!isset(self::$_instance)) {
			// 인스턴스를 생성합니다.
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}

// 인스턴스 생성메소드 호출
$ford = Ford::instance();

class Car
{
	public $color;
	public $producer;
}

$car = new Car();
$car->color = "Blue";
$car->producer = $ford;

echo $ford->produces($car);
echo "<br>";
echo $ford->founder;
```

이전 싱글톤 변경전 예제와 변경후 예제를 살펴보면 $ford에 대해서 new키워드를 통하여 인스턴스를 생성하지 안았습니다. 

// 인스턴스 생성메소드 호출
```php
$ford = Ford::instance();
```

대신에 인스턴스 생성 매서드인 instance()를 호출함으로서 대신하였습니다. 우리는 여기서 매서드 이름을 instance라고 했지만, 독자들 마다 다른 이름을 이용하셔도 무방합니다. 

<br>

### 싱클턴 패턴의 단점
---
기존의 클래스를 싱글톤 형태로 변경을 하는 것은 간단합니다. 

<br>

### 코드 증가
---
하지만 싱클턴 패턴으로 변경을 하기위해서는 코드의 양이 증가하는 단점이 있습니다.
짧고 간단하 코드라도 자주 반복되다 보면 불편합니다.

<br>

### 참조 이름
---
싱글턴 클래스의 참조가 이름으로 발생됩니다. 클래스의 인스턴스를 얻기 위해서는 네임스페이스가 포함된 클래스의 전체이름을 사용해야 합니다.


### 정리
---
싱글톤은 처음 패턴을 접하는 사람들에게는 매력적인 패턴중에 하나 입니다. 또한, 자신의 코드를 뽐내기를 좋아한다면 더욱 더 그럴 것입니다.
하지만, 또한 많은 개발자들은 디자인 패턴중에 싱클턴을 안티 패턴으로 지적을 하기도 합니다.

패턴의 오남용과 메모리 리소스가 계속 점유하고 있다는 것이 싱글톤이 안티패턴으로 인기가 없어지는 이유이기도 합니다.
