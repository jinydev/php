|내부함수|
int substr_compare ( string $main_str , string $str , int $offset [, int $length [, bool $case_insensitivity = false ]] )

내부함수 substr_compare()는 바이너리 세이프 형태로 오프셋의 두 문자열 비교, 최대 길이 문자 비교합니다. substr_compare ()는 오프셋 위치에서 main_str을 str과 최대 길이 문자를 비교합니다.

예제파일) substr_compare.php
<?php
	echo substr_compare("abcde", "bc", 1, 2); // 0
	echo substr_compare("abcde", "de", -2, 2); // 0
	echo substr_compare("abcde", "bcg", 1, 2); // 0
	echo substr_compare("abcde", "BC", 1, 2, true); // 0
	echo substr_compare("abcde", "bc", 1, 3); // 1
	echo substr_compare("abcde", "cd", 1, 2); // -1
	echo substr_compare("abcde", "abc", 5, 1); // warning
?> 

화면출력)
0
0
0
0
1
-1 