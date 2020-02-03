|내부함수|
int similar_text ( string $first , string $second [, float &$percent ] )

내부함수 similar_text() 는 두개의 문자의 비슷한 정도를 계산합니다.

예제파일) similar_text.php
<?php
	$str1 = "안녕하세요! 지니 입니다.";
	$str2 = "안녕하세요! jiny 입니다.";


	similar_text($str1, $str2, $percent); 
	echo "두 문장의 유사도는 $percent % 입니다.<br>";

	similar_text($str2, $str1, $percent); 
	echo "두 문장의 유사도는 $percent % 입니다.<br>";

?>

화면출력)
두 문장의 유사도는 84.848484848485 % 입니다.
두 문장의 유사도는 84.848484848485 % 입니다.