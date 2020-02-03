내부함수 strpbrk()는 임의의 문자 집합에 대한 문자열 검색합니다. 매칭 검색된 이후의 문자열을 반환합니다.

|내부함수|
string strpbrk ( string $haystack , string $char_list )

예제파일) strpbrk.php
<?php

	$text = 'This is a Simple text.';

	// "is is a Simple text." 를 출력합니다. 
	// 처음에 'i'가 먼저 매팅이 되었기 때문입니다.
	echo strpbrk($text, 'mi');
	echo "<br>";

	// "Simple text."를 출력합니다.
	echo strpbrk($text, 'S');
?> 

화면출력)
is is a Simple text.
Simple text. 

위의 실험은 임의의 문자들 $char_list에 대해서 매칭 검색을 하여 처리합니다. 매칭되는 문자들은 한 개 또는 여러 개일 수 있습니다.
