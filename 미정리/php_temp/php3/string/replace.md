## 03.5.문자열 치환 
---
치환이란 특정 문자열의 내용을 다른 문자열로 대체한다는 것입니다. 문자열 치환은 다양 
한 문자열 출력 결과물을 만들어 처리하는 데 매우 유용한 기능입니다. 
문자열의 내용을 치환하는 알고리즘은 복잡합니다. PHP는 문자열 치환 함수들을 통하여 보다 간단하게 처리할 수 있습니다. 

| 내장 함수 | 
string strtr ( string $str , string $from , string $to ) 
내장 함수 strtr()은 특정 문자열을 대체합니다. 참고로 문자열을 대체할 때는 문자열의 길 이가 같아야 합니다. 만일 대체하고자 하는 문자열의 길이가 더 클 때는 이후 문자열은 무 시됩니다. 

예제 파일 | strtr.php 
1 <?php 2 $str = "안녕하세요. jiny 입니다.!"; 3 echo $str."<br>"; 4 5 $src = "jiny"; 6 $dst = "hojinlee"; 7 8 echo strtr($str, $src, $dst); 9 10 ?> 

화면 출력 
안녕하세요. jiny 입니다.! 안녕하세요. hoji 입니다.! 

| 내장 함수 | 
mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] ) 

내장 함수 str_replace()는 문자열 내의 특정 문자열을 검색하여 다른 문자열로 대체합 
니다. 

예제 파일 | str_replace.php 
1 <?php 2 $string = "abcdefg"; 
3  $keyword = "cde";  
4  
5  $body = str_replace($keyword, " 111111 ", $string);  
6  echo $body;  
7  
8  ?>  

화면 출력 
ab 111111 fg 

| 내장 함수 | 
mixed str_ireplace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] ) 

내장 함수 str_ireplace()는 str_replace()의 대소문자를 구별하지 않는 버전입니다. 

| 내장 함수 | 
mixed substr_replace ( mixed $string , mixed $replacement , mixed $start [, mixed $length ] ) 

내장 함수 substr_replace()는 문자열의 일부분 내에서 텍스트를 바꿉니다. 

예제 파일 | substr_replace.php 
1 <?php 2 $var = 'ABCDEFGH:/MNRPQR/'; 3 echo "원본: $var<hr/>\n"; 4 5 /* 전제 문자열을 'bob'으로 변경합니다. */ 6 echo substr_replace($var, 'bob', 0) . "<br />\n"; 7 echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n"; 8 9 /* 문자열 앞에 'bob'을 추가합니다. */ 10 echo substr_replace($var, 'bob', 0, 0) . "<br />\n"; 11 12 /* 'MNRPQR' 부분을 'bob'으로 바꾸기 합니다. */ 
13 echo substr_replace($var, 'bob', 10, -1) . "<br />\n"; 14 echo substr_replace($var, 'bob', -7, -1) . "<br />\n"; 15 16 /* 'MNRPQR' 부분을 삭제합니다. */ 17 echo substr_replace($var, '', 10, -1) . "<br />\n"; 18 19 ?> 

화면 출력 
원본: ABCDEFGH:/MNRPQR/________________________________________bob bob bobABCDEFGH:/MNRPQR/ ABCDEFGH:/bob/ ABCDEFGH:/bob/ ABCDEFGH:// 
