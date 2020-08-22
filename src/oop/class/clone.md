---
layout: php
title: "PHP"
keyword: "jinyphp, php"
breadcrumb:
- "oop"
- "class"
- "clone"
---

# 객체 복사
---
new 키워드는 새로운 객체를 생성합니다. new 키워드는 초기화된 객체를 생성합니다.  
만일 클래스 값의 초기화 같은 것이 필요하다면 그냥 new 키워드를 이용하여 객체를 생성하면 됩니다.

하지만 지금 사용 중인 객체를 복제하여 사용하려고 하면 `clone` 키워드를 사용해야 합니다. 

|문법|
```php
$obj2 = clone $obj;
```
 
clone 키워드는 현재의 객체의 상태를 포함하여 객체를 복사합니다.

예제 파일 class-03.php
```php
<?php
	class JinyClass
	{
		public $message;

		public function showMessage(){
			return $this->message;
		}

	}

	$obj = new JinyClass;
	$obj->message = "testing clone";
	echo $obj->showMessage() . "<br>";

	$obj2 = clone $obj;
	echo $obj2->showMessage() . "<br>";

?>
```

결과
```
testing clone
testing clone
```

위의 예는 객체 복사에 대한 실험입니다. 첫 번째 객체 $obj는 처음에 생성된 객체변수입니다.  
생성된 객체에 메시지 내용을 설정한 다음에 화면 출력합니다.

$obj2는 $obj를 복사한 객체입니다. 현재 $obj객체의 설정값을 포함하여 새로운 객체변수에 복제가 됩니다.  
복제된 $obj2를 통해 메시지를 출력하면 복제하기 전의 $obj 의 프로퍼티 값이 출력되는 것을 볼 수 있습니다.

복제는 이전 객체에 어떠한 프로퍼티 값이 설정이 되어 있다면 이 설정값까지 모두 복제를 합니다.  
