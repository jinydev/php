---
layout: php
breadcrumb:
- "function"
- "declare"
- "name"
---

# 함수명
---
함수명을 작명할 때는 기존의 내장 함수 이름과 중복되지 않게 주의를 해야 합니다.  
중복되지 않는 상태에서 함수의 이름은 규격에 맞게 사용자가 자유롭게 작성을 할 수 있습니다.  

함수명은 영문자로 작명을 합니다. 함수명은 숫자로 시작할 수 없습니다.  
하지만 특수기호 밑줄(`_`)로 시작하거나 중간에 넣을 수 있습니다.  

예제 파일 func-02.php
```php
<?php
	function helloMsg() {
    	echo "Hello world! <br>";
	}
?>
```

위의 예제는 function 키워드로 helloMsg 함수를 정의합니다.  
사용자 정의된 `helloMsg 함수`는 "Hello world!"라는 메시지를 출력하는 단순한 기능을 가지고 있습니다.  