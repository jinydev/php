
내부함수 strspn()는 문자열 $object의 첫 번째 문장에 대해서 마스크 필터링된 길이를 출력합니다.

|내부함수|
int strspn ( string $subject , string $mask [, int $start [, int $length ]] )

예제파일) strspn.php
<?php
	// mask에 맞는 initial segment의 길이를 반환합니다.
	$object = "423336 is the answer to the 128th question.";
	$mask =  "1234567890abcdefhijslmnopqrstuvwxyz";
	$var = strspn($object, $mask);

	echo $var;
?>

화면출력)
6

내부함수 strcspn() 는  $subject 문자열에서 $mask에 포함되어 있지 않은 문자의 초기 세그먼트값의 길이를 출력합니다.

|내부함수|
int strcspn ( string $subject , string $mask [, int $start [, int $length ]] )

예제파일) strcspn.php
<?php

	$a = strcspn('abcd', 'apple');
	var_dump($a); //0

	$b = strcspn('abcd',  'banana');
	var_dump($b);	// 0

	$c = strcspn('hello', 'l');
	var_dump($c);	// 2

	$d = strcspn('hello', 'world');
	var_dump($d); // 2

	$e = strcspn('abcdhelloabcd', 'abcd', -9);
	var_dump($e); //5

	$f = strcspn('abcdhelloabcd', 'abcd', -9, -5);	
	var_dump($f); //4
?>

화면출력)
int(0) 
int(0) 
int(2) 
int(2) 
int(5) 
int(4) 