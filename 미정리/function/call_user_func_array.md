---
layout: post
permalink: /function/call_user_func_array
---

# call_user_func_array()
`call_user_func_array()` 함수는 콜백호출을 처리합니다.


## 함수정의
```php
mixed call_user_func_array ( callable $callback , array $param_arr )
```


## 예제코드1
다음은 사용자 함수 `foobar()`를 선언하고, 콜백으로 함수를 호출합니다.

예제) call_user_func_array1.php
```php
<?php
	// 사용자 함수 정의
	function foobar($arg1, $arg2) {
        echo __FUNCTION__, " 입력값1 = $arg1 ,입력값2 = $arg2 \n";
	}

	// 콜백 호출
	call_user_func_array("foobar", array("one", "two"));
```

`call_user_func_array()`를 통하여 콜백을 호출할때, 콜백함수의 이름은 문자열로 지정을 합니다.
콜백되는 함수의 매개변수 인자는 배열로 2번째 매개변수로 전달 합니다.

다음은 실행결과 출력 입니다.
```
foobar got one and two
```


## 예제코드2
콜백 처리를 다시 함수로 래핑하여 처리를 할 수 있습니다. 
이때 함수의 모든 인자값을 `func_get_args()` 함수를 이용하여 배열로 받아 전달을 할 수 있습니다.

예제) call_user_func_array2.php
```php

<?php
	// 사용자 함수 정의
	function foobar($arg1, $arg2) {
        echo __FUNCTION__, " 입력값1 = $arg1 ,입력값2 = $arg2 \n";
	}

    function foo() {
        // 콜백 호출
        return call_user_func_array("foobar", func_get_args());
    }
	
```


## 예제코드3
다음은 콜백호출을 클래스를 이용하여 호출하는 예제 입니다.

예제) call_user_func_array3.php
```php
	// 객체 매소드 호출 
	class foo {
    	function bar($arg, $arg2) {
        	echo __METHOD__, " got $arg and $arg2<br>";
    	}
	}

	$foo = new foo;
	// 인스턴스, 매소드 배열
	// 매개변수 매열
	call_user_func_array(array($foo, "bar"), array("three", "four"));

?>
```

다음은 실행결과 출력 입니다.
```
foo::bar got three and four
```


## 유사함수
call_user_func()