---
layout: php
breadcrumb:
- "function"
- "declare"
- "call"
---

# 함수 실행
---
앞에서 사용자 함수를 정의했다고 해서 함수가 바로 실행되지는 않습니다. 함수의 정의와 실행은 엄밀히 말하면 서로 다릅니다.  
`function` 키워드로 함수를 선언했다고 해서 코드상의 함수가 실행되지는 않습니다.  

단지 PHP는 이러한 함수가 있다고 기억만 하고 있는 것입니다. 
PHP에는 수많은 내장 함수들이 포함되어 있지만 이 모든 함수들이 실행되지 않는 것과 유사합니다.  

프로그램을 실행하기 위해서는 함수 호출이 필요합니다. 
프로그램이 function이라는 키워드로 함수를 정의한 후 프로그램에서 `함수명();` 형태로 실행할 위치에서 함수 호출을 합니다. 
PHP 언어는 함수를 실행하는 코드를 만나야 비로소 함수가 실행된다고 보면 됩니다.  

PHP에서 함수를 실행 호출하는 방법은 매우 간단합니다.  

|문법|
```php
함수명();
```

형태로 소스상에 적으면 됩니다. 즉, 선언한 함수를 호출(사용)을 해야만 함수를 PHP 코드에서 실행을 합니다.  

프로그램에서 함수를 실행한다는 것은 프로그램의 제어권이 변경되는 것입니다. 
프로그램이 순차적으로 동작을 하다가 함수를 만나면 제어권이 함수로 넘어가 일정한 일을 수행한 다음 호출한 함수의 위치로 되돌아갑니다.  

예제 파일 func-03.php
```php
<?php
	function helloMsg() {
    	echo "Hello world! <br>";
	}

	helloMsg(); // 함수를 호출합니다.

	helloMsg(); // 재사용 함수 재호출합니다.
?>
```

결과
```
Hello world!
Hello world! 
```