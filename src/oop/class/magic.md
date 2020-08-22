---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# 매직 메서드
---
클래스는 매직 메서드라는 몇 개의 미리 사전에 정의한 특수한 메서드가 있습니다.  
클래스를 생성할 때 초기값을 설정하거나 오류 동작 등 실행되는 특별한 메서드입니다.

<br>

## 초기화
---
__construct() 메서드는 객체 생성 시 초기값 설정을 해주는 특수 메서드입니다.  
또는 생성자 메서드라고도 부릅니다.  

```php
$obj = new members();
```

다음과 같이 클래스 인스턴스를 생성할 때 __construct() 메서드는 한 번 실행하게 됩니다.  
이 메서드명은 미리 정의된 이름입니다.

__construct() 메서드를 사용하기 위해서는 클래스 내에 선언해야 합니다.  

|문법|
```php
class 클래스명
{
	function __construct()
	{
		// 부모의 초기값을 실행합니다.
		parent::__construct();

		// 개별 초기값을 설정합니다.
	}
}
```

클래스 상속의 경우 부모의 초기값 매직 메서드는 자동으로 실행되지 않습니다.  
이런 경우 별도의 부모 초기값 매직 메서드를 추가해야 합니다.

예제 파일 class-12.php
```php
<?php
	class BaseClass
	{
		function __construct()
		{
			echo "BaseClass 초기화<br>";
		}
	}

	class SubClass extends BaseClass
	{
		function __construct($a1,$a2,$a3)
		{
			// 부모의 초기화 메서드를 실행합니다.
			parent::__construct();

			// 초기화 메서드를 실행합니다.
			echo "SubClass 초기화<br>";

			// 입력 매개변수를 확인합니다.
			echo "초기화 매개변수 a1 = ".$a1."<br>";
			echo "초기화 매개변수 a2 = ".$a2."<br>";
			echo "초기화 매개변수 a3 = ".$a3."<br>";
		}

		public function show()
		{
			echo "hello world! <br>";
		}
	}

	// 인스턴스 생성 시 초기화 매개변수를 같이 전달합니다.
	$obj = new SubClass("인자1","인자2","인자3");
	$obj->show();

?>
```

결과
```
BaseClass 초기화
SubClass 초기화
초기화 매개변수 a1 = 인자1
초기화 매개변수 a2 = 인자2
초기화 매개변수 a3 = 인자3
hello world! 
```

위의 예제는 상속받은 클래스의 인스턴스를 생성합니다.  
인스턴스 생성 시 초기 매개변수 값과 초기화 매직 메서드를 실행합니다.

<br>

## 소멸자
---
`__construct()` 처럼 초기화 메서드가 있다고 한다면 반대로 소멸자 매직 메서드가 존재합니다.  
PHP 스크립트의 모든 소스가 실행 끝나고 나면 `__destruct()` 메서드 함수가 실행됩니다.  

|문법|
```php
class 클래스명
{
	function __destruct()
	{
		// 소멸 작업들을 설정합니다.
	}
}
```


예제 파일 class-13.php
```php
<?php
	class BaseClass
	{
		function __construct()
		{
			echo "BaseClass 초기화<br>";
		}

		public function show()
		{
			echo "hello world! <br>";
		}

		function __destruct()
		{
			echo "BaseClass 소멸<br>";
		}
	}

	// 인스턴스 생성
	$obj = new BaseClass();
	$obj->show();
?>
```

결과
```
BaseClass 초기화
hello world!
BaseClass 소멸
```

위의 예제는 클래스의 인스턴스를 생성과 스크립트 종료와 함께 `__destruct()` 매직 메서드가 호출됩니다.

<br>

## 오류 호출
---
매서드를 사용하기 위해서는 반드시 클래스 내에 매서드 함수를 정의해야 합니다.  
하지만 정의되지 않는 클래스를 사용하려고 하면 당연히 오류가 발생할 것입니다.  
공동 작업이나 소스가 커질수록 이러한 오류가 발생할 확률도 커집니다.

만일 클래스 내에서 존재하지 않는 메서드를 호출할 때 오류를 발생하지 않고 `__call()` 메서드를 호출합니다.  

예제 파일 class-## 14.php
```php
<?php
	class BaseClass
	{
		function __call($method,$params)
		{
			echo "오류: 정의되지 않는 메서드 ".$method."를 ".implode(', ', $params)."호출했습니다.";
		}
	}

	// 인스턴스 생성
	$obj = new BaseClass();
	$obj->show("a1","a2","a3");
?>
```

결과
```
오류: 정의되지 않는 메서드 show를 a1, a2, a3호출했습니다.
```

위의 예제 에서는 없는 메서드를 호출합니다.  
없는 메서드를 호출하게 되면 대신에 __call() 매직 메서드를 호출합니다. __call() 함수는 두 개의 인자를 받습니다.  
호출한 메서드명과 입력받은 파라미터 값을 배열로 전달합니다.

매직 메서드를 잘 이용하면 공동 작업 시 잘못된 메서드의 호출로 인하여 발생할 수 있는 오류를 사전에 방지할 수 있습니다.  

<br>

## 객체의 문자열 변환
---
`__toString()` 매직 매서드는 클래스가 문자열로 변환하여 처리될 때 동작합니다.  
예로 클래스 객체를 `echo $obj;`처럼 출력할 때 `__toString()` 메서드가 동작합니다.

예재 파일 class-15.php
```php
<?php
	class TestClass
	{
		public $foo;

		public function __construct($foo)
		{
			$this->foo = $foo;
		}

		public function __toString()
		{
				return $this->foo;
		}
	}

	$obj = new TestClass('Hello');
	
	// 클래스가 문자열로 변환 
	echo $obj;
?>
```

결과
```
Hello
```

<br>

## 객체 함수 호출
---

`__invoke()` 매직 메서드는 객체를 함수처럼 호출할 경우에 호출되는 메서드 입니다.  
`$obj()` 형태로 호출될 때 실행됩니다.

예제파일) class-16.php
```
<?php
	class dataInt
	{
		public function __invoke($x)
		{
			var_dump($x);
		}
	}

	$obj = new dataInt;

	$obj(5);
	
	var_dump(is_callable($obj));
?>
```

화면출력)
```
int(5) bool(true)
```

<br>

## 객체 복제 호출
---
`__clone()` 매직 메소드는 객체가 복제 되었을 때 실행회는 메서드입니다.

예제파일) class-17.php
```php
<?php
    class MyClass
    {
        public $instance;

        public function __clone() {
            echo "clone object<br>";
        }

    }
        
    $obj = new MyClass();
    $obj2 = clone $obj;
?>
```

화면출력)
```
clone object
```

## __set(), __get(), __isset(), __unset()
---
__set() 매직 메서드는 접근할 수 없는 프로퍼티에 값을 쓰고자 할 때 호출됩니다.  
__get() 매직 메서드는 접근할 수 없는 프로퍼티의 값을 읽을 경우에 호출됩니다.  
__isset() 매직 메서드는 접근할 수 없는 프로퍼티에 isset() 함수나 empty() 함수를 사용할 때 호출됩니다.  
__unset() 매직 매서드는 접근할 수 없는 프로퍼티를 unset() 함수를 사용할 때 호출됩니다.  

예제 파일 class-18.php
```php
<?php
	class MyClass
	{

		public function __set($name, $value) {
			echo "Setting '$name' to '$value' <br>";
		}

		public function __isset($name)
		{
			echo "Is '$name' set? <br>";
		}

		public function __unset($name)
		{
			echo "Unsetting '$name' <br>";
		}

	// 접근불가 프로퍼티에 대해 isset() 나 empty() 가 호출되었을때 불려집니다. 

		public function __get($name) {
			echo "Reading '$name' <br>";
		}


	}

	$obj = new MyClass();

	// 접근 불가 프로퍼티에 값을 설정할때 매직 매소드 __set() 호출
	$obj->name = "jiny";

	isset($obj->name);

	empty($obj->name);

	unset($obj->name);


	// 접근 불가 프로퍼티에 값을 읽을때 매직 매소드 __get() 호출
	echo $obj->name;
?>
```

결과
```
Setting 'name' to 'jiny' 
Is 'name' set? 
Is 'name' set? 
Unsetting 'name' 
Reading 'name'
```

<br>

## 그 외 메서드
---
이외에도 다음과 같은 매직 메서드가 더 있습니다.  
지면상 전부 다룰 수 없어서 보다 자세한 부분은 공식 사이트에서 확인 가능합니다.

* __callStatic() : 정적 컨텍스트 내에서 접근 불가 메서드를 가져올 때 호출됩니다.
* __sleep()
* __wakeup()
* __set_state() : var_export()에 의해 내보내진 클래스를 위해 호출됩니다.
* __debugInfo() : var_dump()에 의해 덤프될 때 보여줄 속성을 가져올 때 호출됩니다.



