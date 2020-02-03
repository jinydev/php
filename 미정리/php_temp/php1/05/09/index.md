---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

# 05.9 예약된 상수 목록
---
> `넘버 PHP 1권` 보충정리 내용입니다. 원문은 도서를 참고해 주시길 바랍니다.

모든 언어들이 그러하듯이 사전에 많은 상수를포함하고 있습니다. 상수를 선언하여 사용할 때 실수로 상수명이 중복되어 프로그램의 오작동을 발생할 수도있습니다. 

상수를 선언하기 전에는 PHP에서 미리 사용된 상수명인지 확인하고 중복되지 않게 쓰는 것이 중요합니다.또는 앞에 개인적인 접두어를 붙여서 사용하는 것도 또 다른 방법일 수 있습니다.  
PHP언어에서는 기존에 미리 선언된 상수의 목록을 확인할 수 있는 내부 함수를제공하고 있습니다. 

|관련함수| 
```
array get_defined_constants ([ bool $categorize = false ] )
```

위 함수의 반환값 형태는 배열인 것을 확인할 수 있습니다. get_define_constants() 함수는 PHP 내부 상수와 사용자가개별적으로 선언한 모든 상수의 목록을 배열 형태로 반환받을 수 있습니다.

예제 파일 get_defined_constants.php
```
<?php
	// 상수를 정의합니다.
	define("MY_CONSTANT", 1);
	// 정의된 모든 상수들을 출력합니다.
	// 카테고리도 같이 출력합니다.
	print_r( get_defined_constants(true) );
?> 
```

위의 예제는 get_defined_constants()함수로PHP의 내부 상수와 사용자 정의 상수의 목록을 출력하는 것입니다. 출력결과는내용이많아서지면상생략하도록하겠습니다. 

<br><br> 