---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

# 배열생성
---
배열 변수를 생성할 수 있습니다. 또한 배열을 여러 개의 변수로 분할 하여 처리를 할 수도 있습니다. 배열을 변수화 하여 데이터를 처리하는 것은 배열을 활용하는데 매우 유용합니다.

02.1.1 변수할당
====================

배열 변수를 생성하기 위해서는 데이터의 값을 배열타입으로 저장을 하면 됩니다. 배열타입의 값을 초기에 성성을 하기 위해서는 array() 함수를 이용합니다.

|내부함수| 배열생성
array array ([ mixed $... ] )

내부함수 array()는 입력된 값에 대한 배열데이터를 반한합니다. 각각의 데이터는 콤마(,)로 구분하면 키를 삽입을 할때는 => 기호를 같이 사용을 합니다.

예제파일) array-01.php
<?php
	// 배열 변수를 생성합니다.
	// 입력한 값에 대한 배열 값을 반환 합니다.
	$arr1 = array("hojin","jiny","james","eric");

	// 배열값을 foreach 를 통하여 하나씩 출력을 합니다.
	foreach ($arr1 as $value) {
		echo "$value <br>";
	}

	echo "===== <br>";
    
	// 키형태의 배열을 지정합니다.
	$arr2 = array('firstname' => "hojin", 'lastname' => "lee" );
	foreach ($arr2 as $key => $value) {
		echo "{$key} => {$value} ";
		print_r($arr);
	}

?>

화면출력)
hojin
jiny
james
eric
=====
firstname => hojin lastname => lee 

배열은 값의 묽음처리 입니다. 묽음 형태의 배열을 처리하는 것은 유사한 데이터를 처리하는데 있어서 많은 변수의 명을 통하여 자원을 낭비하는 것을 줄이기 위해서 입니다. 

|내부함수| 배열의 변수화
array list ( mixed $var1 [, mixed $... ] )

하지만 반대로 배열을 여러 개의 변수로 분할 할 수 있습니다. 내부함수 list()는 배열의 값을 지정한 각각의 변수에 값을 할당할 수 있습니다. 배열의 데이터를 여러 개의 변수에 분배하여 저장을 할 때 편리합니다.

예제파일) array-02.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');
	
	// 배열의 값을 각각의 변수에 값을 매칭하여 대입합니다.
	list($orage, $apple, $grape) = $arr;

	echo "변수 orage = $orage <br>";
	echo "변수 apple = $apple <br>";
	echo "변수 grape = $grape <br>";

	echo "<br> ===== <br><br>";

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}

?>

화면출력)
변수 orage = orage
변수 apple = apple
변수 grape = grape
=====
0==>orage
1==>apple
2==>grape

|내부함수|
array array_fill ( int $start_index , int $num , mixed $value )
 
내부함수 array_fill()는 지정한 값으로 배열 채우기 합니다. 지정한 값을 배열의 시작위치(start_index) 부터 반복횟수(num) 만큼 반복하여 배열을 생성합니다.

예제파일) array-03.php
<?php
	$a = array_fill(5, 6, 'aaa');
	$b = array_fill(-2, 4, 'bbb');
	print_r($a);
	print_r($b);
?>

화면출력)
Array ( [5] => aaa [6] => aaa [7] => aaa [8] => aaa [9] => aaa [10] => aaa )
Array ( [-2] => bbb [0] => bbb [1] => bbb [2] => bbb ) 

|내부함수|
array array_fill_keys ( array $keys , mixed $value )

내부함수 array_fill_keys()는 입력받은 배열의 값을 키 값으로 사용하여 배열의 데이터를 채우기 합니다.

예제파일) array-04.php
<?php
	$keys = array('foo', 5, 10, 'bar');
	$a = array_fill_keys($keys, 'banana');
	print_r($a);
?>

화면출력)
Array ( [foo] => banana [5] => banana [10] => banana [bar] => banana ) 

02.1.2 값과 키
====================

PHP는 다양한 형태의 최신 배열표기 및 처리를 지원합니다. 일반배열과 키값을 가지고 있는 연상배열 모두를 사용할 수 있습니다. 내부함수 each() 함수는 배열의 키와 값을 한쌍으로 반한홥니다. list() 함수와 결합하여 배열의 키와 값을 추출할 수 있습니다.

|내부함수| 배열의 쌍값
array each ( array &$array )

배열이 담긴 each() 함수를 호출할때마다 다음 배열 위치로 전달됩니다.

예제파일) array-05.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');
	
	$test = each($arr);
	echo "원소 0= ".$test[0]."<br>";
	echo "원소 1= ".$test[1]."<br>";
	echo "원소 key= ".$test[key]."<br>";
	echo "원소 value= ".$test[value]."<br>";

	echo "<br><br>";

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}

?>

화면출력)
원소 0= 0
원소 1= orage
원소 key= 0
원소 value= orage

1==>apple
2==>grape

위의 실습에서 배령의 키와 값을 추울하여 봅니다. 첫번째 명령에서 1번, 반복문에서 2번 실행되어 총 3개의 배열 정보가 출력됩니다. each() 함수는 4가지의 키값으로 데이터를 반환하는데 0, key 와 1, value 입니다.

연상배열에서 값만 추출한 다른 배열을 생성할 수있습니다. 내부함수 array_values() 는 배열의 값을 반환합니다. 

|내부함수| 배열 값
array array_values ( array $array )

예제파일) array-06.php
<?php
	// 배열을 생성합니다.
	$arr = array('firstname' => "hojin", 'lastname' => "lee" );
	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. ", ";
	}
	echo "<br> ==== <br>";

	$arr2 = array_values($arr);
	while(list($key,$val) = each($arr2)){
		echo $key. "==>" .$val. ", ";
	}
?>

화면출력)
firstname==>hojin, lastname==>lee,
====
0==>hojin, 1==>lee, 

|내부함수| 배열 인덱스키
array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )

내부함수 array_keys()는 배열의 인덱스 키 이름만을 반환 받을 수 있습니다.

예제파일) array-07.php
<?php
	$arr = array('firstname' => "hojin", 'lastname' => "lee" );
	$index = array_keys($arr);

	while(list($key,$val) = each($index)){
		echo $key. "==>" .$val. "<br>";
	}
?>

화면출력)
0==>firstname
1==>lastname

|내부함수|
array array_column ( array $input , mixed $column_key [, mixed $index_key = null ] )

내부함수 array_column()는 입력된 다중 배열에서 단일 열에서 값 만을 추출하여 배열로 반환합니다.

예제파일) array-08.php
<?php
$records = array(
    array(
        'id' => 2135,
        'first_name' => '홍',
        'last_name' => '길동',
    ),
    array(
        'id' => 3245,
        'first_name' => '이',
        'last_name' => '호진',
    ),
    array(
        'id' => 5342,
        'first_name' => '장',
        'last_name' => '승빈',
    )
);
 
$first_names = array_column($records, 'last_name');
print_r($first_names);
?>

화면출력)
Array ( [0] => 길동 [1] => 호진 [2] => 승빈 ) 

|내부함수|
array array_flip ( array $array )

내부함수 array_flip()는 배열의 키와 값을 서로 교환합니다. array_flip ()은 배열의 키가 값이 됩니다. 값은 다시 배열의 키로 변경을 하여 배열로 처리합니다.

예제파일) array-09.php
<?php
	$input = array("a"=>"oranges", "b"=>"apples", "c"=>"pears");
	$flipped = array_flip($input);

	print_r($flipped);
?>

화면출력)
Array ( [oranges] => a [apples] => b [pears] => c ) 

02.1.3 변수 결합과 분리
====================

내부함수 compact()는 외부의 변수명을 응용하여 배열을 생성할 수 있습니다. 변수명은 키값으로 사용됩니다.

|내부함수| 변수 배열생성
array compact ( mixed $varname1 [, mixed $... ] )

예제파일) array-10.php
<?php
	
	$one = "하나";
	$two = "두개";
	$three = "세개";
	$four = "네게";

	// 배열에 변수의 값을 넣기 위해서는 "" 로 변수명을 입력 하면 됩니다. 
	$num = array("three", "four");

	// 배열을 넣을때는 배열명만 인수로 전달 합니다.
	$arr = compact("one", "two", $num);

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}

?>

화면출력)
one==>하나
two==>두개
three==>세개
four==>네게

|내부함수| 배열 변수화
int extract ( array &$array [, int $flags = EXTR_OVERWRITE [, string $prefix = NULL ]] )

내부함수 extract()는 배열의 키이름으로 각각 변수화 합니다. compact() 함수의 반대기능입니다.

예제파일) array-11.php
<?php
	$arr = array("blue"=>"파랑색","red"=>"발강색","black"=>"검정색");

	// 배열을 변수로 생성합니다.
	extract($arr);

	echo "blue = ".$blue ."<br>";
	echo "red = ".$red ."<br>";
	echo "black = ".$black ."<br>";
?>

화면출력)
blue = 파랑색
red = 발강색
black = 검정색

02.1.4 결합 및 분리
====================

내부함수 array_merge()는 입력되는 배열을 하나의 배열 형태로 결합하여 반환을 합니다.

|내부함수| 배열결합
array array_merge ( array $array1 [, array $... ] )

예제파일) array-12.php
<?php
	$arr1 = array('지니', '호진');
	$arr2 = array('철수', '영수');
	$arr3 = array('제니퍼', '홍길동');

	$arr = array_merge($arr1, $arr2, $arr3);

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}

?>

화면출력)
0==>지니
1==>호진
2==>철수
3==>영수
4==>제니퍼
5==>홍길동


|내부함수| 재귀적 배열결합
array array_merge_recursive ( array $array1 [, array $... ] )

두 개 이상의 배열을 재귀적으로 병합합니다. 내부함수 array_merge_recursive ()는 다수의 배열 요소를 병합하여 배열의 끝에 추가합니다.

병합될 배열에 동일한 문자열 키가있는 경우 이러한 키의 값은 배열로 병합됩니다. 이는 재귀적으로 수행되므로 값 중 하나가 배열 자체이면 함수는 해당 항목과 병합합니다. 그리고 배열에 동일한 숫자 키가 있으면 나중에 값이 원래 값을 덮어 쓰지 않고 뒤에 추가됩니다.

예제파일) array-13.php
<?php
	$ar1 = array("color" => array("favorite" => "red"), 5);
	$ar2 = array(10, "color" => array("favorite" => "green", "blue"));
	$result = array_merge_recursive($ar1, $ar2);
	
	print_r($result);
?>

화면출력)
Array ( [color] => Array ( [favorite] => Array ( [0] => red [1] => green ) [0] => blue ) [0] => 5 [1] => 10 ) 

|내부함수| 배열결합 (키/값)
array array_combine ( array $keys , array $values )

내부함수 array_combine()는 첫번재 배열을 키값으로, 두번째 배열을 값 형태로 배열을 결합합니다. 

예제파일) array-14.php
<?php
	$a = array('green', 'red', 'yellow');
	$b = array('avocado', 'apple', 'banana');

	// $a 배열은 키명으로 사용고, $b는 데이터로 사용합니다.
	// 두개의 배열을 연상배열 형태로 결합니다.
	$arr = array_combine($a, $b);
	print_r($arr);
?>

화면출력)
Array ( [green] => avocado [red] => apple [yellow] => banana ) 

|내부함수| 일부배열 분리
array array_slice ( array $array , int $offset [, int $length = NULL [, bool $preserve_keys = false ]] )

내부함수 array_slice()는 배열의 일부분의 요소만을 추출하여 반환합니다.

예제파일) array-15.php
<?php
	// 배열을 생성합니다.
	$arr = array('하나', '둘', '셋', '넷', '다섯', '여섯', '일곱', '여덟', '아홉', '열');
 
 	// 첫번째 인자: 추출 시작값
 	// 처음 2부터 끝까지.
 	$slice = array_slice($arr, 2);
	while(list($key,$val) = each($slice)){
		echo $key. "==>" .$val. ", ";
	}

	echo "<br>";
	
	// 두번째 인자: 추출 데이터 갯수
	// 처음 1부터, 3개의 데이터를 추출
 	$slice = array_slice($arr, 1,3);
	while(list($key,$val) = each($slice)){
		echo $key. "==>" .$val. ",";
	}

	echo "<br>";
	
	// 처음 인자가 음수이면 끝에서 -인자 수터 시작하여 , 두번째 인자 갯수를 추출
	// 마지막 -5 위치부터(여섯), 3개의 데이터를 추출
 	$slice = array_slice($arr, -5,3);
	while(list($key,$val) = each($slice)){
		echo $key. "==>" .$val. ",";
	}

?>

화면출력)
0==>셋, 1==>넷, 2==>다섯, 3==>여섯, 4==>일곱, 5==>여덟, 6==>아옵, 7==>열,
0==>둘,1==>셋,2==>넷,
0==>여섯,1==>일곱,2==>여덜,

|내부함수|
array array_chunk ( array $array , int $size [, bool $preserve_keys = false ] )

내부함수 array_chunk()는 배열을 크기 요소가있는 배열로 분할합니다. 마지막 chunk는 크기 요소보다 작은 요소를 포함 할 수 있습니다.

예제파일) array-16.php
<?php
	$array = array('a', 'b', 'c', 'd', 'e');
	print_r(array_chunk($array, 2));
	echo "<br>";

	print_r(array_chunk($array, 3));
	echo "<br>";
?>

화면출력)
Array ( [0] => Array ( [0] => a [1] => b ) [1] => Array ( [0] => c [1] => d ) [2] => Array ( [0] => e ) )
Array ( [0] => Array ( [0] => a [1] => b [2] => c ) [1] => Array ( [0] => d [1] => e ) ) 


02.1.5 출력
====================

내부함수 array_reverse()는 배열의 내용을 역순으로 출력합니다.

|내부함수| 역순배열
array array_reverse ( array $array [, bool $preserve_keys = false ] )

예제파일) array-17.php
<?php
	$arr = array("hojin","jiny","james","eric"); 
	$reverse = array_reverse($arr);

	while(list($key,$val) = each($reverse)){
		echo $key. "==>" .$val. "<br>";
	}

?>

화면출력)
0==>eric
1==>james
2==>jiny
3==>hojin

02.1.6 추가 및 삭제
====================

내부함수 array_push()는 배열의 마지막 위치에 새로운 원소 데이터를 추가합니다.

|내부함수| 배열 원소추가(마지막)
int array_push ( array &$array , mixed $value1 [, mixed $... ] )

예제파일) array-18.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');

	// $arr 배열에 두개의 원소를 추가합니다.
	array_push($arr, 'banana', 'tomato');

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}
?>

화면출력)
0==>orage
1==>apple
2==>grape
3==>banana
4==>tomato

|내부함수| 배열 원소제거
mixed array_pop ( array &$array )

내부함수 array_pop()은 배열의 마지막 요소 하나를 제거합니다. 이는 데이터처리 알고리즘 pop 과 유사합니다.

예제파일) array-19.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');

	// 마지막 배열 원소를 삭제 합니다.
	$temp = array_pop($arr);
	echo "배열에서 마지막 $temp 요소 하나를 제거합니다.<br> ";

	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}
?>

화면출력)
배열에서 마지막 grape 요소 하나를 제거합니다.
0==>orage
1==>apple

|내부함수| 배열 원소추가(처음)
int array_unshift ( array &$array , mixed $value1 [, mixed $... ] )

내부함수 array_unshift()는 배열 앞쪽에 새로운 원소를 추가합니다.

예제파일) array-20.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');
 
	// $arr 배열에 두개의 원소를 추가합니다.
	array_unshift($arr, 'banana', 'tomato');
 
	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}
?>

화면출력)
0==>banana
1==>tomato
2==>orage
3==>apple
4==>grape

|내부함수| 배열 원소제거(처음)
mixed array_shift ( array &$array )

내부함수 array_shift()는 배열의 맨 처음 요소 하나를 제거합니다. 배열을 좌측으로 하나 밀어서 제거하는 형태 입니다.

예제파일) array-21.php
<?php
	// 배열을 생성합니다.
	$arr = array('orage', 'apple', 'grape');
 
	// 배열 원소를 삭제 합니다.
	$temp = array_shift($arr);
	echo "배열에서 처음 $temp 요소 하나를 제거합니다.<br> ";
 
	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. "<br>";
	}
?>

화면출력)
배열에서 처음 orage 요소 하나를 제거합니다.
0==>apple
1==>grape

|내부함수| 일부배열 삭제
array array_splice ( array &$input , int $offset [, int $length = count($input) [, mixed $replacement = array() ]] )

내부함수 array_splice()는 일부분의 데이터를 삭제한 후에 값을 반환합니다.

예제파일) array-22.php
<?php
	// 배열을 생성합니다.
	$arr = array('하나', '둘', '셋', '넷', '다섯', '여섯', '일곱', '여덜', '아옵', '열');
	echo "원본<br>";
 	while(list($key,$val) = each($arr)){
		echo $key. "==>" .$val. ", ";
	}
	echo "<br><br>";

 	// 첫번째 인자: 삭제 시작값
 	// 2까지의 원소를 삭제하고 반환
 	$slice = array_splice($arr, 7);
	while(list($key,$val) = each($slice)){
		echo $key. "==>" .$val. ", ";
	}
	echo "를 삭제하였습니다.<br>";
	echo "<br>";
	
	$slice = array_splice($arr, 3,3);
	while(list($key,$val) = each($slice)){
		echo $key. "==>" .$val. ", ";
	}
	echo "를 삭제하였습니다.<br>";
	echo "<br>";

?>

화면출력)
원본
0==>하나, 1==>둘, 2==>셋, 3==>넷, 4==>다섯, 5==>여섯, 6==>일곱, 7==>여덜, 8==>아옵, 9==>열,

0==>여덜, 1==>아옵, 2==>열, 를 삭제하였습니다.

0==>넷, 1==>다섯, 2==>여섯, 를 삭제하였습니다.