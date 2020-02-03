|내부함수|
string soundex ( string $str )

내부함수 soundex()는 문자열의 soundex 키값을 반환합니다.

예제파일) soundex.php
<?php
	echo "Euler ".soundex("Euler") . " == " . 
		"Ellery ". soundex("Ellery") . "<br>";

	echo "Gauss ".soundex("Gauss") . " == " . 
		"Ghosh ". soundex("Ghosh") . "<br>";

	echo "Hilbert ".soundex("Hilbert") . " == " . 
		"Heilbronn ". soundex("Heilbronn") . "<br>";

?>

화면출력)
Euler E460 == Ellery E460
Gauss G200 == Ghosh G200
Hilbert H416 == Heilbronn H416