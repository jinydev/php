문자열은 하나의 단어일수도 있고, 문장일 수도 있습니다. 만일 문자열이 여러 개의 단어로 구성되어 있는 문장일 경우, 포함하고 있는 단어의 개수를 측정할 수 있습니다.

|내부함수|
mixed str_word_count ( string $string [, int $format = 0 [, string $charlist ]] )

내부함수 str_word_count()은 입력된 문자열에서 단어의 개수를 찾아서 개수를 반환합니다.

예제파일) str_word_count.php
<?php
	$str = "I love you";
	echo str_word_count($str);
?>

화면출력)
3