자연순서 알고리즘을 통하여 문자열을 비교하고 처리할 수 있습니다.

|내부함수|
int strnatcmp ( string $str1 , string $str2 )

내부함수 strnatcmp()은 "자연 순서" 알고리즘을 사용하여 문자열을 비교 합니다.

예제파일) strnatcmp.php
<?php
	$arr1 = $arr2 = array("img12.png", "img10.png", "img2.png", "img1.png");
	echo "Standard string comparison\n";
	usort($arr1, "strcmp");
	print_r($arr1);
	
	echo "\nNatural order string comparison\n";
	usort($arr2, "strnatcmp");
	print_r($arr2);
?> 

화면출력)
Standard string comparison Array ( [0] => img1.png [1] => img10.png [2] => img12.png [3] => img2.png )
Natural order string comparison Array ( [0] => img1.png [1] => img2.png [2] => img10.png [3] => img12.png ) 

|내부함수|
int strnatcasecmp ( string $str1 , string $str2 )

내부함수 strnatcasecmp()은 "자연 순서" 알고리즘을 적용합니다. 대소 문자를 구분하지 않는 문자열 비교합니다.

