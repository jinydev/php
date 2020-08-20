---
layout: php
title: "상수"
keyword: "const, php"
description: "php 상수에 대해서 학습합니다. 삼수는 고정된 값입니다."
breadcrumb:
- "basic"
- "const"
- "define"
---

# define()
---
내장 함수 define()은 PHP언어에서 상수를 설정할 수 있도록 사전에 미리 만들어 제공되는 함수입니다.

<br>


## define() 함수
---
define() 함수는 세 개의 실행 인자 값을 입력할 수 있습니다. 첫 번째는 상수명, 두 번째는 상수의 스칼라 값, 세 번째는 대소문자 구분 여부입니다.

|관련함수|
```
bool define("상수명", "상수값", true);
```
실행 인자 중 세 번째 인자는 생략할 수 있습니다. 세 번째 인자를 생략할 경우에는 기본적으로는 true 로 설정된 것으로 간주합니다.

예제 파일 define-01.php
```php
<?php
	// 상수를 정의합니다.
	define("DB_TYPE","mysql");
	// 설정한 상수를 출력합니다.
	echo DB_TYPE."<br>";
?>
```

결과
```
 mysql
```

define() 함수는 실행 후 결과값으로 논리값을 반환합니다. 상수 설정이 성공한 경우 true, 실패할 경우 false를 반환함으로 상수 설정의 성공 여부를 확인할 수 있습니다.

예제 파일 define-02.php
```php
<?php
	// 상수를 정의합니다.
	define("DB_TYPE","mysql");
	// 설정한 상수를 출력합니다.
	echo DB_TYPE."<br>";

	// 상수를 중복 정의해 봅니다.
	if(define("DB_TYPE","mysql")){
		echo "상수 설정 성공";
	} else {
		echo "상수 설정 실패";
	}

?>
```
결과
```
mysql
상수 설정 실패
```

위의 두 번째 예는 동일한 이름의 상수를 중복으로 선언하기 때문에 define() 함수는 상수의 설정 false를 반환합니다.

<br>

## 배열 상수
---
배열 상수 설정 기능은 PHP 7.x부터의 새로운 기능입니다. 기존 PHP 5.6 까지는 상수의 값은 단지 한 개의 값으로만 정의가 가능했습니다.

PHP 7.x 은 기존 define() 내장 함수를 개량하여 비슷한 문법적 처리를 통해 배열 상수를 설정할 수 있습니다.

예제 파일 define-03.php
```php
<?php
	// 배열 상수를 선언합니다.
	define('ANIMALS', [
    	'dog',
    	'cat',
    	'bird'
	]);

	echo ANIMALS[1]; // outputs "cat"

?>
```

결과
```
cat
```

배열 상수도 배열 변수처럼 상수명 뒤에 []를 붙여서 배열 접근 및 처리를 할 수 있습니다. 

<br>