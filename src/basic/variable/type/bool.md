---
layout: php
breadcrumb:
- "basic"
- "variable"
---

# 논리변수
---
불린(Boolean)이라고 부르는 변수형 타입은 논리형 변수라고도 합니다. 주로 수학적의미로 참과 거짓을 표기합니다. 또는 1과 0의 숫자값으로 표현하기도 합니다. 하지만 요즘은 숫자값 대신 상수를 이용하여 true, false 기호를 많이 사용합니다.  
 
논리변수를 불린이라고 부르는 이유는 영국의 수학자 겸 논리학자인 조지 불(George Boole) 이름에 서 유래한 것입니다.  

논리변수는 조건문, 반복문 등 어떠한 처리 결과의 성공 여부를 확인하거나, 반환하는 값으로 가장 많이 사용하는 변수 타입 중 하나입니다. 따라서 논리변수의 개념은 반드시 숙지하고 넘어가야 합니다.  

<br>

## 0 과 1
---
컴퓨터는 수많은 트랜지스터의 집합으로 표현을 합니다. 전기가 통하고 있는 상태 1과 전기가 단절된 상태 0 으로만 표현이 됩니다.  

따라서, 컴퓨터는 우리가 일반적으로 사용하는 10진법의 수학을 표현하지 않고, 2진법 형태로 모든 데이터와 처리를 반복합니다.  

<br>

## 논리변수 출현
---
기존 언어에서는 변수에 논리값을 숫자 0 또는 1의 값을 넣어서 판별을 하거나, 변수의 비트값을 연산하여 처리하였습니다.  

0과 1의 표현은 사람이 직관적으로 쉽게 알아보기는 어렵습니다. 그래서,  

|표현|
```
0 = false (거짓)
1 = true (참)
```

이라고 변수에 문자열로 ‘true’ 또는 ‘false’로 저장하여 문자열로 판별했습니다. 하지만 문자열을 통해 처리하는 것은 문자 수만큼의 메모리가 필요합니다. 따라서 논리변수 타입의 변수와 대입하는 값은 상수값처럼 TRUE, FALSE로 입력하여 처리합니다.  

<br>

## 논리변수 생성
---
논리변수를 만드는 것은 간단합니다. $변수명 뒤에 논리 상수명을 적어주면 됩니다.  

|문법|
```php
$x = true;
$y = false;
```

논리값은 소문자/대문자를 구분하지 않습니다.  

예제 파일 bool-01.php
```php
<?php
	$a = true;
	If ($a) {
		echo "a = true(참) 입니다.";
	} else {
		echo "a = false(거짓) 입니다.";
	}

	echo "<br>";

	$b = TRUE;
	If ($b) {
		echo "b = true(참) 입니다.";
	} else {
		echo "b = false(거짓) 입니다.";
	}

	echo "<br>";

	$c = false;
	If ($c) {
		echo "c = true(참) 입니다.";
	} else {
		echo "c = false(거짓) 입니다.";
	}

	echo "<br>";

	$d = FALSE;
	If ($d) {
		echo "d = true(참) 입니다.";
	} else {
		echo "d = false(거짓) 입니다.";
	}

	echo "<br>";
?>
```

결과
```
a = true(참) 입니다.
b = true(참) 입니다.
c = false(거짓) 입니다.
d = false(거짓) 입니다.
```

<br>

## 논리변수 확인
---
PHP는 생성한 변수가 논리변수를 확인할 수 있는 is_bool()이라는 내부함수를 제공합니다.  

|관련함수|
```php
bool is_bool ( mixed $var )
```

매개변수 값으로 변수를 전달하면 변수의 논리 타입 여부를 논리값 형태로 반환합니다.  

사용예 bool-02.php
```php
<?php
  $a = false;
  $b = 0;

  // 논리값으로 쓰여진 변수인지를 확인합니다.
  if (is_bool($a) === true) {
    echo "a는 논리 변수 입니다.";
  }

  echo "<br>";

  // $b는 정수 0 입니다. 논리 변수가 아니라서 false 를 반환합니다.
  if (is_bool($b) === false) {
    echo "b는 논리 변수가 아닙니다.<br>";
    var_dump($b);
  }

?> 
```

결과
```
a는 논리 변수 입니다.
b는 논리 변수가 아닙니다.
int(0)
```

위의 예제는 변수값의 논리 타입 여부를 확인하는 예입니다.  

<br>