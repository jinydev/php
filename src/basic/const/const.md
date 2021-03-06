---
layout: php
title: "상수"
keyword: "const, php"
description: "php 상수에 대해서 학습합니다. 삼수는 고정된 값입니다."
breadcrumb:
- "basic"
- "const"
- "const"
---

# const 키워드
---
PHP는 define() 함수 이외에 const 키워드를 사용해서도 상수를 선언할 수 있습니다. const는 키워드를 통해 상수를 설정합니다. 따라서 define()처럼 상수의 선언 오류 등을 함께 확인할 수 없는 단점을 가지고 있습니다.

|문법|
```
const 상수명 = 값;
```

const는 상수를 생성하는 시점이 PHP프로그램이 실행되면서 const 키워드를 만나는 시점에 생성됩니다. 따라서 소스에서 const 명령이 선언하기 이전에 상수명을 호출하게 되면 미정의 상수명 사용으로 인하여 오류가 발생할 수 있습니다.

const 상수 선언 키워드는 함수나 반복문 loop 또는 if문 안에서는 사용할 수 없습니다. 함수 호출이나 반복문과 같은 곳에서는 중복된 상수명 선언을 시도할 수 있기 때문입니다.

예제 파일 const-01.php
```php
<?php
	// 상수를 선언합니다.
	const DB_TYPE = "mysql";
	// 상수를 출력합니다.
	echo DB_TYPE;
?>
```

결과
```
mysql
```

위의 예에서 DB_TYPE이라는 상수를 선언하며, 상수값으로는 “mysql”을 대입합니다. 이처럼 생성한 상수값은 PHP에서 바로 사용하거나, 다른 변수에 값으로 대입할 수도 있습니다.

예제 파일 const-02.php
```
<?php
	// 상수를 선언합니다.
	const DB_TYPE = "mysql";
	$dbTYPE = DB_TYPE;
	// 상수를 출력합니다.
	echo $dbTYPE;
?>
```

결과
```
mysql
```