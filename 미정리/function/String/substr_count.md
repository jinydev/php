
문자열안에 또다른 문자열을 포함하고 있을 경우, 포함되고 있는 문자의 반복 갯수를 측정할 수 있습니다. 

|내부함수|
int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )

내부함수 substr_count()는 원본의 $haystack 변수에서 검색하고자 하는 문자열 $needle 값이 몇 개를 포함하고 있는지를 확인합니다. 반환값은 정수입니다. 검색을 할때는 대소문자를 구분하여 처리를 합니다.

예제파일) substr_count.php
<?php
	$text = 'This is a test';
	echo $text . "<br>";

	echo "원본 문자열 길이 = ". strlen($text) ."<br>";
	// 출력: 14

	// 'This is a test' 안에 is 두번 존재
	echo "needle substring이 발생하는 횟수 =". substr_count($text, 'is')."<br>";
	// 출력 :2
	
	// 오프셋 3 적용하여 문자열은 's is a test' 형태로 앞에 3개의 문자열은 건너 뜁니다.
	echo "오프셋 적용 = ".substr_count($text, 'is', 3) ."<br>";

	// 오프셋 3 적용 및 문자열의 길이는 3으로 제한합니다.
	// 따라서 문자열은 's i' 로 적용됩니다.
	echo "오프셋 적용, 길이제한  = ".substr_count($text, 'is', 3, 3) ."<br>";

	// 오류발생
	// 오프셋 5 + 길이 10 = 총길이 15로 원본 $text 문자열 14보다 크기 때문에 오류 발생 
	echo substr_count($text, 'is', 5, 10) ."<br>";

	// prints only 1, because it doesn't count overlapped substrings
	$text2 = 'gcdgcdgcd';
	echo substr_count($text2, 'gcdgcd') ."<br>";
?> 

화면출력)
This is a test
원본 문자열 길이 = 14
needle substring이 발생하는 횟수 =2
오프셋 적용 = 1
오프셋 적용, 길이제한 = 0

1

위의 실험은 $text 문자열에서 “is” 의 문자열을 포함하고 있는 문자열의 개수를 찾아서 처리를 합니다.
