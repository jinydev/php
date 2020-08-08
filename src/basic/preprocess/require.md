---
layout: php
---

# require
---
PHP에서는 include와 비슷한 require 전처리 명령어를 지원합니다.  
require 명령어를 제공하는 이유는 좀 더 유연한 소스 결합과 엄격한 소스 결합을 서로 구분하기 위함입니다.  

<br>

## Require특징  
---
PHP는 왜 include와 비슷한 require를 지원하는 것일까요? 
include와 require의 차이점은 삽입하고자 하는 파일의 존재 여부에 따른 처리 방법입니다. 

명령 키워드의 의미만으로도 특징을 유추해 볼 수 있습니다. 
만일 삽입할 PHP 스크립트 파일이 없는 경우 include 처럼 경고(E_WARNING)를 출력하는 대신에 require 명령어는 소스의 치명적 오류(E_COMPILE_ERROR)를 출력한 후에 스크립트를 즉시 중단합니다.  

|문법|
```php
require 'filename';
```

따라서 약간 동적 스타일로 삽입하는 include 대신에 프로그램에서 반드시 삽입 처리가 이루어져야 하는 필수 기능은 require를 사용하는 것을 권장합니다.  

예제 파일 include_lib.php
```php
<?php
	function addPlus($x,$y){
		return $x+$y;
	}
?>
```

예제 파일 require-01.php
```php
<?php
	require "include_lib.php";
	$x = 10;
	$y = 5;
	
	echo addPlus($x,$y);
?>
```

결과
```
15
```

위의 예제는 분리된 2개의 소스를 require 명령으로 결합하는 예입니다. 
만일 결합하고자 하는 require 소스 파일이 없으면 실행을 중단하고 오류를 발생할 것입니다.  

<br>

## require_once
---
require도 중복으로 동일한 파일을 선언 시 두 번 require하는 것을 방지 하기 위해서 include_once와 유사한 require_once라는 명령도 같이 제공합니다.  

|문법|
```php
require_once  'filename';
```

require-01.php 파일은 include_lib.php 파일을 삽입하여 실행 함수를 호출합니다.  

예제 파일 require-02.php
```php
<?php
	require_once "include_lib.php";
	// 두 번 삽입을 해도 오류가 나지 않습니다.
	require_once "include_lib.php";

	$x = 10;
	$y = 5;
	
	echo addPlus($x,$y);
?>
```

결과
```console
15
```

위의 예는 require_one를 이용한 예입니다. require_once명령어는 두 번 삽입하는 실수를 방지할 수 있습니다. 
중복하여 사용하는 경우 두 번째 require_once는 무시하게 됩니다.  

<br><br>