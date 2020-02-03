
|내부함수|
string strtr ( string $str , string $from , string $to )

내부함수 strtr()는 특정 문자열을 대체합니다. 참고로 문자열을 대치할 때는 문자열의 길이가 같아야 합니다. 만일 대체 하고자 하는 문자열의 길이가 더 클때는, 이후 문자열은 무시됩니다.

예제파일) strtr.php
<?php
	$str = "안녕하세요. jiny 입니다.!";
	echo $str."<br>";

	$src = "jiny";
	$dst = "hojinlee";

	echo strtr($str, $src, $dst);
?>

화면출력)
안녕하세요. jiny 입니다.!
안녕하세요. hoji 입니다.!