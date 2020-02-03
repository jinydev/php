
|내부함수|
int strncmp ( string $str1 , string $str2 , int $len )

내부함수 strncmp()는 첫 번째 n 문자의 Binary safe 문자열 비교합니다. 대소문자 구분합니다. str1가 str2보다 작은 경우 0보다 작은 값을 반환합니다. str2가 str1 보다 큰경우에는 >0 값을 반환합니다. 두개의 값이 같은 경우에는 0을 반환합니다. 

예제파일) strncmp.php
<?php 
	echo strncmp("xybc","a3234",0);
	// 0 
	
	echo "<br>";

	echo strncmp("blah123","hohoho", 0);
	//0 
?>

화면출력)
0
0 
