---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# $this
---
정의된 클래스의 메서드와 프로퍼티는 인스턴스화를 통하여 생성된 객체변수에 직접 접근했습니다.  
이러한 인스턴스화를 통한 객체의 생성과 접근은 클래스 외부에서 메서드와 프로퍼티를 사용하는 대표적인 방법입니다.  

하지만 클래스의 정의 내부에서 선언된 프로퍼티와 메서드에 접근하려면 어떻게 해야 할까요?  
클래스가 객체지향적일 때 동일한 클래스 메서드에서 다른 메서드를 호출이 필요한 경우가 많이 발생할 것입니다.  

이런 경우 클래스는 내부 접근을 위해서 특별한 인스턴스 변수 $this를 제공합니다.  
$this 객체변수는 자기 자신의 클래스를 가르키는 셀프 변수입니다.  

예제 파일 class-06.php
```php
<?php
	class JinyClass
	{
		public $message;

		public function show(){
			// 내부 메서드를 호출합니다.
			echo $this->getMessage();
		}

		public function getMessage(){
			return $this->message;
		}

	}

	$obj = new JinyClass;
	$obj->message = "안녕하세요";
	echo $obj->show() . "<br>";
?>
```

결과
```
안녕하세요
```

위의 예제를 보면 클래스 내부의 프로퍼티와 메서드는 $this를 통해 내부 접근이 가능합니다.  
클래스 내의 show() 메서드는 getMessage() 메서드를 호출하고, getMessage() 메서드는 message 프로퍼티에 접근합니다.  

특별한 $this 인스턴스 변수를 클래스 정의 내에서 사용하기 위해서는 반드시 클래스를 인스턴스화 형태로 객체를 생성해야 합니다.  
예를 들면 $this를 사용하기 위해서 다음과 같이 클래스의 인스턴스화 작업을 해야만 합니다.  

```php
$obj = new JinyClass;
```

위처럼 $obj 객체변수가 생성되고 나서 내부에서 $this를 통해 내부 메서드와 프로퍼티를 접근할 수 있는 것입니다.  

만일 정적 방식으로 클래스를 사용할 때는 $this를 사용할 수 없습니다. 인스턴스를 생성하지 않기 때문 입니다.  

즉, $obj 인스턴스를 생성하게 되면 $this는 $obj를 가리키게 됩니다. 인스턴스를 생성하지 않으면 객체 자체가 없기 때문에 $this 사용을 못하는 것입니다.   
 
<br>

## 매서드체인
---
메서드 체인이란 $this의 특성을 이용하여 클래스 메서드를 연결하여 사용하는 코딩 스타일을 말합니다.  

PHP 클래스 응용 소스를 보면, 

```php
$obj->setEnv()->loading();
```

위처럼 메서드 함수를 ->로 연결하여 사용하는 코드를 본적이 있을 것입니다.  

이런 형태의 메서드 호출을 매서드 체인이라고 합니다. 메서드 체인은 PHP 4.x에서 PHP 5.x 버전으로 업그레이드되면서 지원하게 되었습니다.  

메서드 체인의 원리는 각각의 메서드를 실행 후 $this 반환으로서 객체를 연결합니다.  

`$obj->setEnv()->loading();는 $obj->setEnv()`를 실행하고 `$this`를 반환합니다. `$this`는 `$obj`를 가리키기 때문에 다시  
`$obj->loading();`처럼 실행할 수 있습니다. 

이러한 메서드 체인 방법은 보다 코드를 간결하게 만들고 프로그램을 개발하는 데 좀 더 직관적으로 유지보수가 쉬워지는 면도 있습니다. 

예제 파일 class-07.php
```php
<?php
	class members
	{
		private $user_name;
		private $user_age;
		private $user_sex;

		// 이름을 설정합니다.
		public function setUserName($name)
		{
			$this->user_name = $name;

			// 자기 자신의 객체를 반환합니다.
			return $this;
		}

		// 나이를 설정합니다.
		public function setUserAge($age)
		{
			$this->user_age = $age;

			// 자기 자신의 객체를 반환합니다.
			return $this;
		}

		// 성별을 설정합니다.
		public function setUserSex($sex)
		{
			$this->user_sex = $sex;

			// 자기 자신의 객체를 반환합니다.
			return $this;
		}

		public function show()
		{
			printf("안녕하세요. 저는 %s입니다. 나이는 %d이고요 %s입니다.",$this->user_name, $this->user_age, $this->user_sex);
		}
	}

	// 클래스를 선언합니다.
	$objMembers = new members;
	$objMembers->setUserName("jiny")->setUserAge(18)->setUserSex("남자")->show();

?>
```

결과
```
안녕하세요. 저는 jiny입니다. 나이는 18이고요 남자입니다.
```

위의 예제를 보면 각각의 메서드는 `$this` 자기 자신의 객체를 반환합니다.

```php
// 클래스를 선언합니다.
$objMembers = new members;
$objMembers->setUserName("jiny")->setUserAge(18)->setUserSex("남자")->show();
```

클래스를 선언하고 메서드 체인으로 각각의 메서드를 연결, 호출합니다.  
기존 메서드 호출 방식으로 호출은 다음과 같습니다.

```php
// 클래스를 선언합니다.
$objMembers = new members;

// 메서드 호출로 변수를 초기화합니다.
$objMembers->setUserName("jiny");
$objMembers->setUserAge("18");
$objMembers->setUserSex("남자");

$objMembers->show();
```

위의 전형적은 메서드 호출 사용법은 메서드를 직접 하나씩 호출하여 프로퍼티 변수들을 초기화합니다.  
세 개의 프로퍼티를 초기화하기 위해서 소스상에서 세 줄을 할당하여 사용합니다.  

메서드 체인 방식은 함수의 연속 호출과 반환되는 값을 이용하기 때문에 직관적이고 한 줄에 모든 명령을 실행할 수 있습니다.  

메서드 체인도 $this의 속성을 이용하기 때문에 사용 전에 반드시 클래스의 인스턴스를 생성 후에 사용해야 합니다.  

<br>

## 객체 순회
---
PHP 5.x 부터는 객체를 리스트처럼 순회하여 접근할 수 있습니다.  
다음 예제는 객체의 프로퍼티를 `foreach`문을 사용하여 순회하여 접근합니다.

예제 파일 class-08.php
```php
<?php
  class MyClass
  {
    public $var1 = 'value 1';
    public $var2 = 'value 2';
    public $var3 = 'value 3';
  }

  $obj = new MyClass();

  foreach($obj as $key => $value) {
    print "$key => $value <br>";
  }

?>
```

결과
```
var1 => value 1 
var2 => value 2 
var3 => value 3
```