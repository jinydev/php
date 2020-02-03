
## 03.10 인코딩 
---
글로벌화된 소프트웨어의 개발로 인하여 다국어 처리와 다양한 문자 언어셋을 지원하는 것은 중요합니다. 문자열은 다양한 문자 언어셋으로 처리됩니다. 
PHP는 문자열의 언어 인코딩을 변경할 수 있는 몇 가지 함수를 제공하고 있습니다. 

| 내장 함수 | 
string iconv ( string $in_charset , string $out_charset , string $str ) 
내장 함수 iconv()는 문자 인코딩을 변환합니다. 

예제 파일 | iconv.php 
1  <?php  
2  $text = "This is the Euro symbol '€'.";  
3  
4  echo 'Original : ', $text, "<br>";  
5  echo 'TRANSLIT : ', iconv("UTF-8", "ISO-8859-1//TRANSLIT", $text),  
"<br>";  
6  echo 'IGNORE  : ', iconv("UTF-8", "ISO-8859-1//IGNORE", $text),  

"<br>"; 
7 ?> 

화면 출력 
Original : This is the Euro symbol '€'. TRANSLIT : This is the Euro symbol 'EUR'. IGNORE : This is the Euro symbol ''. 

| 내장 함수 | 
string convert_uuencode ( string $data ) 

내장 함수 convert_uuencode()는 문자열을 uuencode 알고리즘으로 인코딩합니다. 

예제 파일 | convert_uuencode.php 
1 2 3 4  <?php $string = "test\ntext text\r\n"; echo convert_uuencode($string);  
5  ?>  

화면 출력 
0=&5S=`IT97AT('1E>'0-"@`` ` 

| 내장 함수 | 
string convert_uudecode ( string $data ) 

내장 함수 convert_uudecode()는 uuencode된 문자열을 디코딩합니다. 

예제 파일 | convert_uudecode.php 
1 <?php 2 echo convert_uudecode("+22!L;W9E(%!(4\"$`\n`"); 
3 4 ?> 

화면 출력 
I love PHP! 

| 내장 함수 | 
string quoted_printable_encode ( string $str ) 

내장 함수 quoted_printable_encode()는 8비트 문자열, 따옴표 붙은 인쇄 가능한 문자 열로 변환합니다. 

| 내장 함수 | 
string quoted_printable_decode ( string $str ) 

내장 함수 quoted_printable_decode ()는 quoted-printable 문자열을 8비트 문자열 로 변경합니다. 

| 내장 함수 | 
string convert_cyr_string ( string $str , string $from , string $to ) 

내장 함수 convert_cyr_string()은 하나의 Cyrillic 문자 집합을 다른 집합으로 변환합 니다. 

## 03.11 랜덤 
램덤이란 난수를 발행하는 알고리즘입니다. 

| 내장 함수 | 
string random_bytes ( int $length ) 

예제 파일 | random_bytes.php 
1 2 3 4  <?php $bytes = random_bytes(5); var_dump(bin2hex($bytes));  
5  ?>  

화면 출력 
string(10) "fab26daa1e" 

| 내장 함수 | 
string str_shuffle ( string $str ) 

내장 함수 str_shuffle()은 입력한 문자열을 무작위로 섞습니다. 

예제 파일 | str_shuffle.php 
1  <?php  
2  $str = 'abcdef';  
3  $shuffled = str_shuffle($str);  
4  
5  echo $shuffled;  
6  
7  ?>  

화면 출력 
efbcda 
