---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

## 객체 접근

객체변수는 클래스를 통하여 인스턴스화된 객체변수를 통하여 메서드나 프로퍼티를 접근 및 호출합니다.

생성된 객체변수의 메서드와 프로퍼티를 호출하기 위해서는 접근 연산자 ->를 사용합니다. -> 기호는 객체 안에 있는 메서드와 프로퍼티를 접근하여 값을 설정하거나 호출할 수 있습니다.

$객체변수->메서드;

$객체변수->프로퍼티;

기존 다른 언어에서는 클래스 객체의 메서드 접근을 점(.)을 사용하기도 합니다. PHP 언어의 경우에는 -> 기호를 사용하는 차이점이 있습니다.


## 14.5.1 프로퍼티 접근
프로퍼티에 값을 저장하거나 읽어오기 위해서는 객체 접근이 필요합니다. 접근 기호를 통해 객체변수의 프로퍼티에 접근할 수 있습니다. 앞에서 설명한 것처럼 아래와 같이 작성하면 됩니다.

|문법|
$객체변수->프로퍼티;

하지만 프로퍼티 이름 앞에 $ 기호는 사용하지 않습니다.

$jiny->username = "hojin lee";

$name = $jiny->username;

위의 예제는 프로퍼티에 접근하여 값을 읽어오거나 저장하는 간단한 표현입니다. 접근 기호 ->만 넣어서 사용하면 됩니다.

간접 접근
위의 예와 접근 방식은 객체에 직접 프로퍼티를 접근하는 방법입니다. 또한 프로퍼티를 접근할 때 프로퍼티명 앞에 $를 쓰지 않았습니다. 

만일 $를 포함하여 작성하면 프로퍼티명을 변수 값을 이용하여 호출하겠다는 의미입니다. $ 변수를 통해 간접적으로 프로퍼티에 접근하게 되는 것입니다.

$obj->$proertyName ;

간접 접근은 가변적으로 프로퍼티를 선택하여 호출할 때 이용할 수 있습니다. 접근하려고 하는 프로퍼티는 $propertyName의 값의 이름입니다.

 
예제 파일 class-04.php
<?php
	class JinyClass
	{
		public $age;
		public $name;
	}

	$obj = new JinyClass;
	
	// 프로퍼티에 값을 저장
	$obj->age = 18;

	// 프로퍼티의 값을 읽어옵니다.
	echo "나이는 ".$obj->age." 입니다.<br>";

	// 간접 프로퍼티 접근
	// aaa 변수에 프로퍼티명을 설정 후에 간접적으로 접근함
	$aaa = "name";
	$obj->$aaa = "jiny";

	// 프로퍼티의 값을 읽어옵니다.
	echo "내 이름은 ".$obj->$aaa." 입니다.<br>";

?>

결과
나이는 18입니다.
내 이름은 jiny입니다.

위의 예제는 프로퍼티 간접 접근에 대한 실험입니다. 예에서 첫 번째 나이 부분은 직접 프로퍼티명을 입력하여 값을 설정하거나 읽어서 출력했습니다.

하지만 두 번째 이름은 변수에 프로퍼티명을 설정한 후에 간접적으로 프로퍼티를 선택하여 설정, 출력을 했습니다.


## 14.5.2 메서드 접근
클래스의 함수인 메서드 접근은 프로퍼티 접근 방식과 유사합니다. 객체변수 뒤에 접근 연산자 ->를 통해 메서드를 호출할 수 있습니다.

|문법|
$객체변수->메서드();

예제 파일 class-05.php
<?php
	class JinyClass
	{
		public $message;

		public function setMessage($msg){
			$this->message = $msg;
		}

		public function showMessage(){
			return $this->message;
		}

	}

	$obj = new JinyClass;

	// 메서드를 호출합니다.
	$obj->setMessage("hello world!");

	// 메서드 호출 및 반환값
	$msg = $obj->showMessage();
	echo $msg . "<br>";

?>

결과
hello world!

위의 예처럼 메서드를 단독으로 호출할 수 있습니다. 또한 메서드의 반환값을 받아서 처리할 수도 있습니다.