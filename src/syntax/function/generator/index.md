---
layout: php
breadcrumb:
- syntax
- "function"
- "generator"
---

# 제너레이터
---
모든 함수의 실행은 한 번의 호출과 한 번의 함수 처리를 하게 됩니다.  
하지만 특이하게도 제너레이터는 yield 키워드를 사용한 PHP 함수로 분할하여 실행할 수 있습니다. 특수한 형태의 함수입니다.  

또한 제너레이터는 특성상 반환값을 갖지 안습니다. 제너레이터는 PHP 5.5 업그레이드되면서 적용된 기능입니다.  

<br>

## yield
---
제너레이터 함수의 핵심은 `yield` 키워드입니다.  

`yield` 키워드는 `return`과 비슷한 것 같지만 메모리 라이프사이클 관점에서 완전히 다릅니다. 일반 함수의 `return` 문은 결과 값을 반환하면서 함수 실행을 영구적으로 중단하고 호출 스택 프레임을 완전히 파괴(소멸)합니다. 반면, 제너레이터의 `yield`는 결과 값을 호출처로 전달하면서 **현재 함수의 실행 상태(코드 포인터, 지역 변수 상태 등)를 멈춤(Frozen) 상태로 메모리에 유지**합니다. 이후 제너레이터가 다시 호출되면, 처음부터 새로 실행되는 것이 아니라 이전에 멈췄던 `yield` 시점 바로 다음 줄부터 실행을 이어 나갑니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/generator_yield_flow.svg" alt="Standard Return vs Generator Yield Flow Diagram" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 일반 함수의 Return(소멸)과 제너레이터의 Yield(일시 중지 및 동결) 작동 비교</p>
</div>

제너레이터 함수에서 `yield` 키워드를 사용하는 개수의 제한은 없습니다. 하나의 제너레이터 함수에 한 개 또는 여러 개의 `yield` 구문을 넣어서 잠시 멈출 수 있는 횟수를 지정할 수 있습니다. 제너레이터 함수를 호출하면 첫 번째 `yield` 명령이 나올 때까지 실행을 하고 잠시 멈춥니다.  

또 다시 제너레이터 함수를 실행을 하면 이전에 멈춘 위치부터 다음 위치의 `yield` 명령문까지 실행합니다.  

이러한 상태 유지 및 지연 평가(Lazy Evaluation) 메커니즘을 이용하면, 대량의 데이터셋을 메모리에 한꺼번에 적재할 필요 없이 필요할 때마다 한 건씩 뽑아 쓸 수 있어 메모리 효율성을 매우 높일 수 있습니다. 제너레이터는 함수의 마지막 끝까지 도달하거나 `return;` 문이 나올 때까지 이 루틴을 반복합니다.  

예제 파일 generator-01.php
```php
<?php

// yield 키워드는 값을 반환한다는 측면에서 return 키워드와 비슷하면서도 다르다. 

function myGen(){
	// 호출 시 첫 번째 yield 키워드까지 실행한다.
	echo "첫 번째 호출=";
	yield "test1";

	// 호출 시 두 번째 yield 키워드까지 실행한다.
	echo "두 번째호출=";
	yield "test2";

	// 호출 시 세 번째 yield 키워드까지 실행한다.
	echo "세 번째 호출=";
	yield "test3";
	
}

foreach (myGen() as $value) {
	echo $value."<br>";
}

?>
```

결과
```
첫 번째 호출=test1
두 번째 호출=test2
세 번째 호출=test3
```

위의 예를 보면 제너레이터는 반환값이 없는 대신에 yield 뒤에 값을 입력하면 foreach문으로 특정 데이터를 가지고 올 수 있습니다.  

<br>

## 제너레이터 델리게이션
---
제너레이터 함수 실행 시 from 키워드를 추가하여 또 다른 제너레이터 함수로 연결 실행할 수 있습니다. 즉, 제너레이터 함수 안에 또 다른 제너레이터 함수를 추가하여 실행할 수 있습니다.  

예제 파일 generator-02.php
```php
<?php
function gen(){
	yield "gen() 1 실행";
	yield "gen() 2 실행";

	// 3번째 yield는 gen2() 제너레이터로 연결
	yield from gen2();
}

function gen2(){
	yield "gen2() 3 실행";
	yield "gen2() 4 실행";
}

foreach (gen() as $val){
	echo $val."<br>";
}
?>
```

결과
```
gen() 1 실행
gen() 2 실행
gen2() 3 실행
gen2() 4 실행
```

위의 예제는 두 개의 제너레이터 함수를 연결하여 사용하는 예제입니다.  
gen() 함수에 yield 키워드 두 개와 gen2() 함수에 yield 키워드 두 개를 연결하여 총 네 개의 yield 키워드가 삽입되어 있습니다.  

gen() 함수는 총 네 번으로 나누어 실행하게 됩니다.   

<br>

## 제너레이터 예

예제 파일 generator-03.php
```php
<?php
	function rowsCount($count){
		for ($i=0;$i<$count;$i++){
			// 반복문 안에도 yield를 넣어서 반복할 수 있습니다.
			yield $i;
		}
	}

	foreach (rowsCount(10) as $i){
		echo " 실행 =". $i . "<br>";
	}
?>
```

결과
```
실행 =0
실행 =1
실행 =2
실행 =3
실행 =4
실행 =5
실행 =6
실행 =7
실행 =8
실행 =9
```

위의 예는 제너레이터 함수 안에 반복문을 통해 yield 키워드를 동적으로 삽입합니다.  
또한 제너레이터 함수를 호출할 때 매개변수로 반복 횟수를 전달합니다.  
즉, 제너레이터 함수는 반복 횟수만큼 함수를 분할하여 실행하게 됩니다.  
