---
layout: php
---

# foreach
---

foreach는 간단하게 사용할 수 있는 반복 문법입니다. 기존 for 반복문과 달리 간단하게 배열값 등을 이용하여 반복문을 처리할 때 매우 편리합니다.  

 foreach는 기존 for 반복 문법처럼 반복 횟수를 정의하는 카운터가 없는 것이 특징입니다. 기존에 초기값 및 반복 증가, 조건 등의 횟수를 지정하는 것이 아니라 특이하게 입력된 객체 집합의 개수만큼 반복 실행하게 됩니다.  

foreach의 장점은 간단한 배열 등을 처리하는 데 있어서 초기값, 증가, 조건 등을 잘못 적용하여 발생할 수 있는 오류를 방지하고, 단순하게 반복 처리 코드를 실행할 수 있습니다.  

|문법|
```php
foreach ($array as $value) {
  반복 실행 코드;
}
```

foreach 반복문은 key와 value 값의 한 쌍의 구조를 응용하여 처리하는 반복문입니다.  

다음 예제는 어레이 배열의 포인터를 하나씩 증가하면서 마지막 엘리먼트까지 이동하면서 데이터를 출력하는 반복문입니다.  

예제 파일) foreach-01.php
```php
<?php

    $colors = array("red", "green", "blue", "yellow");
    foreach ($colors as $value) {
      echo "$value <br>";
    }

?>
```

결과
```
red
green
blue
yellow 
```

위 예제에서 배열변수 $colors 에서 값을 하나씩 찾아서 as 키워드 다음에 정의한 $value 변수명에 값을 하나씩 저장합니다. $value의 값은 반복이 수행되면서 $color 의 값으로 한 번씩 변경됩니다.  

위의 예제 foreach문법을 기본 for문으로 다시 구현 정의해보면 다음과 같습니다. 

예제 파일 foreach-02.php
```php
<?php
	$colors = array("red", "green", "blue", "yellow");

	for($i=0;$i<count($colors);$i++){
    		echo $colors[$i]."<br>";
	}

?>
```

결과
```
red
green
blue
yellow
```

위의 두 개의 문법은 같은 동작을 처리합니다. 하지만 배열 객체의 경우 foreach 문이 좀 더 간결하게 처리할 수 있는 것을 확인할 수 있습니다.  

<br><br>