내부함수 substr()는 입력한 문자열의 일부분을 잘라낼수 있습니다. 문자열을 잘라 낼때는 문자열의 시작위치와 끝 위치를 지정하여 부분을 추출합니다.

|내부함수|
string substr ( string $string , int $start [, int $length ] )

예제파일) substr.php
<?php
	$string = "abcdefghijklmnopqrstuvwxyz";

	// 1위치 이후부터 표시함
	echo substr($string,1)."<br>";

	// 3위치 이후부터 5개 표시함
	echo substr($string,3,5)."<br>";

?>

화면출력)
bcdefghijklmnopqrstuvwxyz
defgh

위의 실험은 문자열 $string 변수에서 특정 부분의 문자열을 추출합니다. 문자열을 추출할 때 세번째 끝값은 생략이 가능합니다. 끝값을 생략할때는 시작부터 끝까지를 모두 출력합니다.