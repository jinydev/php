---
layout: php
breadcrumb:
- "basic"
- "scope"
---

# static 키워드
---

함수 안에 정의된 로컬변수는 휘발적인 특성이 있습니다. 즉, 함수가 종료되면 함수 내에서 사용된 변수들은 전부 자동 소멸하게 됩니다.  

하지만, 함수 내의 로컬변수의 자동 소멸을 방지할 수 있는 방법 또한 있습니다. static 키워드는 함수를 재사용을 하면서 함수 내에서 선언한 변수가 소멸하지 않도록 할 수 있습니다. 아래와 같이 함수 내에서,  

|문법|
```
static $변수명;
```

으로 선언을 하면, 함수가 종료된 후에도 해당 변수를 소멸하지 않고 변수를 남겨 놓을 수 있습니다.  

이렇게 변수의 자동소멸을 유보한 변수는 함수의 재호출 사용 시 기존의 작업된 변수의 내용을 가지고 와서 계속 연산을 이어 갈 수 있습니다.  

예제 파일 scope-04.php
```php
<?php

	function increment(){
		// static 변수는 처음 한 번 선언 시에만 초기화 됩니다.
		static $total = 0; 
		return ++$total;
	}

	echo increment() . "<br>";
	echo increment() . "<br>";
	echo increment() . "<br>";

?>
```

결과)
```
1
2
3
```

위의 예제는 정적변수의 실험입니다. increment() 함수 안에 정의한 정적변수 $total은 함수가 종료 후에도 자동으로 소멸하지 않습니다. 할당된 변수의 값을 계속 가지고 있습니다.  

또한 함수를 재호출할 때 기존 값을 이용하여 계속 참조할 수도 있습니다. 정적변수의 초기화는 처음 함수를 호출할 때 한 번만 실행됩니다.  

예제 파일 scope-05.php
```php
<?php 
	function foo()
	{
		// 정적 변수를 선언합니다.
		static $bar; 
		$bar++; 
    		echo "unset 실행 전: $bar, "; 
    	
		// 변수를 직접 해제합니다.
    		unset($bar); 
    		$bar = 21; 
    		echo "unset 실행 후: $bar <br>"; 
 	}

 	foo();
 	// 결과: unset 실행 전: 1, unset 실행 후: 21
 	
 	foo();
 	// 결과: unset 실행 전: 2, unset 실행 후: 21 
 	
 	foo();
 	// 결과: unset 실행 전: 3, unset 실행 후: 21 
 ?> 
```

결과
```
unset 실행 전: 1, unset 실행 후: 21
unset 실행 전: 2, unset 실행 후: 21
unset 실행 전: 3, unset 실행 후: 21 
```

<br><br>