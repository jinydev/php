---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "class"
- "static"
---

# 정적 클래스
---
클래스는 지금까지 인스턴스 객체를 생성을 하여 접근을 했습니다.  
정적 클래스는 인스턴스를 생성하지 않고 클래스의 메서드와 프로퍼티를 접근할 수 있는 방식입니다.

정적 클래스 방식으로 접근하여 사용 시에는 인스턴스 객체를 가리키는 $this를 사용할 수 없습니다.  

<br>

## static
---
`static` 키워드는 프로퍼티를 정적 타입으로 선언한다는 의미입니다.  
`static`으로 선언된 프로퍼티는 인스턴스를 생성하지 않아도 접근이 가능합니다.

하지만 인스턴스 객체변수로는 접근이 불가능합니다.  

예제 파일 class-09.php
```php
<?php
	// 클래스를 선언합니다.
	class Jiny
	{
		public static $aaa = 10;
	
		public function show(){
			echo "show = ". self::$aaa;
		}
	}

	echo "aaa = ". Jiny::$aaa ."<br>";

	Jiny::show();

?>
```

결과
```
aaa = 10
show = 10
```

<br>

## 호출
---
정적 메서드와 프로퍼티의 호출은 `->` 기호 대신에 더블콜론(`::`)을 사용합니다.  
인스턴스의 객체가 없기 때문에 ->를 사용할 수 없습니다.

|문법|
```
클래스명::메서드();
클래스명::$프로퍼티명
```

형태로 작성을 해주면 됩니다.

위의 예제는 정적으로 선언된 프로퍼티와 메서드를 인스턴스 없이 바로 호출하는 예제입니다.

예제 파일 class-10.php
```php
<?php
	// 클래스를 선언합니다.
	class jiny
	{
		public static $my_static = 'jiny';
		
		public function staticValue()
		{
			return self::$my_static;
		}
	}

	// 정적 프로퍼티를 출력합니다.
	print "정적 프로퍼티 =". Jiny::$my_static . "<br>";

	$jiny = new Jiny();
	print "인스턴스 =". $jiny->staticValue() . "<br>";

	// 정적 프로퍼티는 인스턴트화된 경우 ->로 호출할 수 없습니다.  
	print "인스턴스 =".$jiny->my_static . "<br>";      // Undefined "Property" my_static 

	print "정적 프로퍼티 =".$jiny::$my_static . "<br>";
	$classname = 'Jiny';
	print "정적 프로퍼티 =".$classname::$my_static . "<br>"; // As of PHP 5.3.0

?>
```

결과
```
정적 프로퍼티 =jiny
인스턴스 =jiny
인스턴스 =
정적 프로퍼티 =jiny
정적 프로퍼티 =jiny
```

PHP 5.3 이상부터는 클래스 이름을 가변변수를 이용하여 호출이 가능합니다.  
변수를 이용한 호출은 가변적인 클래스 선택과 호출을 할 수 있는 장점이 있습니다.

<br>

## SELF
---
자기 자신을 호출할 때 사용하는 키워드입니다.  

예로 자기 자신의 상수나 프로퍼티, 메서드를 호출할 때 사용합니다.  

클래스 안에서 선언한 상수는 다음과 같이 호출하여 사용할 수 있습니다.  

```php
self::상수명;
```

클래스 안에 있는 프로퍼티 호출

```php
self::$변수명;
```

클래스 안에 있는 메서드 호출

```php
self::메서드();
```