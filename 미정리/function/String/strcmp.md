
내부함수 strcmp()는 바이너리 형태로 두개의 문자열을 비교합니다. 두개의 문자열이 같을 경우 0보다 큰값을 반환합니다. 문자열을 비교할때는 대소문자를 같이 구별합니다.

|내부함수|
int strcmp ( string $str1 , string $str2 )

예제파일) strcmp.php
<?php
	$str1 = "hello";
	$str2 = "hello";
	$str3 = "word";

	if (strcmp($str1, $str2) == 0) {
		echo $str1 ."== ". $str2 . "<br>";
	} else {
		echo $str1 ."!= ". $str2 . "<br>";
	}

	if (strcmp($str2, $str3) == 0 ) {
		echo $str2 ."== ". $str3 . "<br>";
	} else {
		echo $str2 ."!= ". $str3 . "<br>";
	}

?>

화면출력)
hello== hello
hello!= word

|내부함수|
int strcoll ( string $str1 , string $str2 )

내부함수 strcoll()은 현재 로케일 기반 문자열을 비교합니다. 현재 로케일이 C 또는 POSIX이면이 함수는 strcmp()와 같습니다.

예제파일) strcoll.php
<?php

	$a = 'a';
	$b = 'A';

 	print strcmp ($a, $b) . "<br>";
 	// prints 1

	setlocale (LC_COLLATE, 'C');
 	print "Locale based C: " . strcoll ($a, $b) . "<br>";
 	// prints 1

	setlocale (LC_COLLATE, 'de_DE');
 	print "de_DE: " . strcoll ($a, $b) . "<br>";

	setlocale (LC_COLLATE, 'de_CH');
	print "de_CH: " . strcoll ($a, $b) . "<br>";

	setlocale (LC_COLLATE, 'en_US');
	print "en_US: " . strcoll ($a, $b) . "<br>";
?>

화면출력)
1
Locale based C: 1
de_DE: 1
de_CH: 1
en_US: 1