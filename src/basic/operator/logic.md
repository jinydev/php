---
layout: php
breadcrumb:
- "basic"
- "operator"
- "logic"
---

# 논리 연산자
---
컴퓨터의 디지털 논리 회로 `and`와 `or`의 처리 로직을 프로그램에도 적용할 수 있습니다.  

기존 모든 연산자는 단일 연산 후 결과를 참(true)과 거짓(false)로 판별할 수 있었습니다.  
하지만 두 가지의 조건을 같이 판별을 하고자 할 때 논리 연산자를 이용하여 두 가지의 조건을 결합할 수 있습니다.  

<br>

## AND 논리
---
논리 결합 AND는 좌측의 조건과 우측의 조건이 동시에 참(true)인지를 확인합니다.  
만일 두 개의 값이 참(true)이면 참(true) 결과를 반환합니다. 둘 중에 하나만이라도 거짓(false)이면 거짓(false)을 반환합니다.  

AND는 논리 결과값을 곱셈하는 것과 같습니다.  

```php
$result = true * false * true;
```

즉 1 * 0 * 0은 0 이기 때문에 거짓(false)이 됩니다.  

```php
$result = true * true * true;
```

즉 1 * 1 * 1은 1이기 때문에 참(true)이 됩니다.  

프로그램 언어에서는 AND 연산을 &&로 표시합니다.  

예제 파일) logic-01.php
```php
<?php
	$x = true;
	$y = true;
	$z = false;

	if ($x && $y) {
		echo "x && y = true <br>";
	} else {
		echo "x && y = false <br>";
	}

	if ($x && $y && $z) {
		echo "x && y && z = true <br>";
	} else {
		echo "x && y && z = false <br>";
	}
?>
```

결과
```
x && y = true
x && y && z = false 
```

<br>

## OR 논리
---
논리 결합 OR는 좌측의 조건과 우측 두 개 중 참(true)인 값이 있는지를 확인합니다.  
둘 중에 하나만이라도 참(true)이면 참(true)을 반환합니다.  

OR 는 논리 결과값을 덧셈하는 것과 같습니다.  

```php
$result = true + false + true;
```

즉 `1 + 0 + 1`은 `0`보다 크기 때문에 `1`과 같은 참(true)이 됩니다.  

```php
$result = false * false * false;
```

즉 `0 + 0 + 0`은 `0`이기 때문에 거짓(false)이 됩니다. 

프로그램 언어에서는 `OR` 연산을 `||`로 표시합니다.  

예제 파일 logic-02.php
```php
<?php
	$x = false;
	$y = false;
	$z = true;

	if ( $x || $y ) {
		echo "x || y = true <br>";
	} else {
		echo "x || y = false <br>";
	}

	if ( $x || $y || $z) {
		echo "x || y || z = true <br>";
	} else {
		echo "x || y || z = false <br>";
	}
?>
```

결과
```
x || y = false
x || y || z = true 
```

<br>

## XOR 논리
---
XOR는 배타적 OR라고 불립니다.  

xor는 두 개의 조건이 같으면 거짓(false)을 출력하고, 두 개의 값이 서로 다르면 참(true)을 출력합니다.  

예제 파일 logic-03.php
```php
<?php
	$x = false;
	$y = false;
	$z = true;

	if ( $x xor $y ) {
		echo "x xor y  = true 두 개의 논리가 틀립니다.<br>";
	} else {
		echo "x xor y = false 두 개의 논리가 같습니다.<br>";
	}

	if ( $x xor $z) {
		echo "x xor z = true 두 개의 논리가 틀립니다.<br>";
	} else {
		echo "x xor z = false 두 개의 논리가 같습니다.<br>";
	}
?>
```

결과
```
x xor y = false 두 개의 논리가 같습니다.
x xor z = true 두 개의 논리가 틀립니다.
```

<br>

## NOT 논리
---
NOT은 논리 값을 반대의 값으로 변경합니다. 즉 참(true)은 거짓(false)으로, 거짓(false)은 참(true)으로 변경됩니다.  

NOT은 변수명 앞에 느낌표 `!`로 사용합니다.  

예제 파일 logic-04.php
```php
<?php
	$x = true;

	if ($x) {
		echo "x는 참입니다.";
	} else {
		echo "x는 거짓입니다.";
	}

	echo "<br>";

	if (!$x) {
		echo "x는 참입니다.";
	} else {
		echo "x는 거짓입니다.";
	}

?>
```

결과
```
x는 참입니다.
x는 거짓입니다.
```

<br><br>