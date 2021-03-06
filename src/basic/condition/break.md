---
layout: php
title: "break - PHP 프로그래밍"
breadcrumb:
- "basic"
- "condition"
- "break"
---

# break
---
switch 조건 제어문을 설명하면서 빼놓을 수 없는 기능이 바로 `break;`입니다. 
break는 사전적으로 ‘깨다’, ‘부수다’라는 의미이지만 프로그램에서는 종료나 탈출(exit) 같은 의미를 가지고 있습니다.  

break; 명령 키워드는 switch 문법에서 거의 필수적으로 꼭 사용되는 명령입니다. 또한 9장에서 배울 반복문에서도 종종 사용할 수 있는 명령입니다.  

기본적으로 switch 조건에서 실행되는 코드의 시작은 case 또는 default로 서브 키워드로 정의된 부분입니다. 
여기서 시작해서 실행의 끝은 swtich의 중괄호가 끝나는 `}` 기호를 만날 때까지입니다. 
따라서 조건 실행의 끝을 의미하는 break; 조건 제어 흐름 명령어가 필요합니다.  

switch 문에서는 break; 문장을 만나게 되면 switch의 중괄호 { }를 끝내고 다음 문장으로 실행 제어권이 이동됩니다.  

break 키워드는 PHP, C 언어 이외의 대부분의 언어에서도 동일한 형태의 기능을 수행합니다.  

브레이크 키워드는 단독으로 사용합니다. 또한 break 키워드와 명령 구분자 세미콜론(;)을 바로 붙여서 사용합니다.  

|문법|
```php  
break; 
```

즉, 프로그램이 실행 도중에 `break;`를 만나게 되면 중괄호 `{ }`로 묶여 있는 하나의 그룹을 탈출(종료)하게 됩니다.  

예제 파일) break-01.php
```php
<?php
	$n = 1; 

	switch ($n) {
		case 1:
			echo "n값는 ".$n."입니다.<br>";
		break;
		
		case 2:
			echo "n값는 ".$n."입니다.<br>";
		break;

		case 3:
			echo "n값는 ".$n."입니다.<br>";
		break;

		default:
			echo "n값는 ".$n."입니다.<br>";
	}
	
	echo "switch문 종료";

?>
```

결과
```
n값는 1입니다.
switch문 종료
```

위의 예에서 `$변수` 값에 따라서 조건과 일치하는 문자열을 한 개만 출력합니다. 그 이유는 $n 값에 따라서 조건을 분기하고, 한 줄의 문자열을 출력한 다음에 `break`문이 있어서 `switch`문을 탈출하게 됩니다.  

만일 break문을 모두 제거한다고 하면 출력값은 다음과 같습니다.  

예제 파일 break-02.php
```php
<?php
	$n = 1; 

	switch ($n) {
		case 1:
			echo "n값는 ".$n."입니다.<br>";

		
		case 2:
			echo "n값는 ".$n."입니다.<br>";
	
		case 3:
			echo "n값는 ".$n."입니다.<br>";
	

		default:
			echo "n값는 ".$n."입니다.<br>";
	}
	
	echo "switch문 종료";

?>
```

결과
```
n값는 1입니다.
n값는 1입니다.
n값는 1입니다.
n값는 1입니다.
switch문 종료
```

break문이 없기 때문에 조건 1, 2, 3과 default를 모두 처리하게 됩니다.  

따라서 switch의 각각의 case문 뒤에는 조건 코드의 실행 종료 의미로 break;로 단락을 마감해야 합니다. 만일 switch문이 조건이 일치한 case로 점프하여 코드를 실행하는 데 break;를 만나지 않으면 switch 실행의 끝 중괄호 }가 나오는 시점까지 모두 실행됩니다.  

그럼 위의 예제에서 label2 의 break;를 주석으로 하나 삭제해 보겠습니다.    다음 예제를 확인해서 실행해 보기를 바랍니다.  

예제 파일 break-03.php
```php
<?php
	$n = "label2";
	
	switch ($n) {
    	case label1:
      		echo "n 값이 label1일 경우 실행됩니다.<br>";
    	break;

    	case label2:
      		echo "n 값이 label2일 경우 실행됩니다.<br>";
    	// break;

    	case label3:
      		echo "n 값이 label3일 경우 실행됩니다.<br>";
    	break;

    	default:
      		echo "n 값이 일치하는 게 없는 경우 실행됩니다.<br>";
	}

?>
```

결과
```
n 값이 label2일 경우 실행됩니다.
n 값이 label3일 경우 실행됩니다.
```

위처럼 두 줄의 실행 결과가 출력될 것입니다. $n변수의 값의 label3인 경우는 바로 case label3로 분기하여 echo "n 값이 label3일 경우 실행됩니다."; 명령이 실행될 것입니다.  

하지만 $n 변수의 값이 label2인 경우 case label2 분기하여 echo "n 값이 label2일 경우 실행됩니다."; 를 실행하고 break;가 없기 때문에 그 밑에 있는 case label3 부분도 같이 실행됩니다.  

```php
echo "n 값이 label3일 경우 실행됩니다.";
break;
```

그리고 `case label3`의 `break;`를 만나서 switch 문을 끝나게 되어 밖으로 빠져나오게 됩니다.  

`break;`를 통해 `switch`의 조건 실행의 코드 영역을 유연하게 범위를 정할 수 있습니다.    


<br><br>