
## 03.8.문자열 조작 
컴퓨터와 프로그램 언어들은 초기 영문권을 중심으로 개발이 되면서 대부분의 언어 처리 는 알파벳으로 구성되어 있습니다. 알파벳은 특성상 대문자와 소문자로 구분됩니다. 
PHP는 이러한 알파벳 문자의 특징을 처리할 수 있는 함수들을 지원합니다. 

### 03.8.1 문자열 순서 
내장 함수 strrev()는 입력된 문자열의 순서를 반대로 바꿉니다. 

| 내장 함수 | 
string strrev ( string $string ) 

예제 파일 | strrev.php 
1 <?php 2 $str = "abcdeghijklem-abcdeghijklem-1234567"; 3 echo "원본 : " . $str . "<br>"; 4 $a = strrev($str); 5 echo $a; 6 7 ?> 

화면 출력 
원본 : abcdeghijklem-abcdeghijklem-1234567 7654321-melkjihgedcba-melkjihgedcba 

### 03.8.2 대소문자 

알파벳의 대소문자들을 변경할 수 있습니다. 

string strtolower ( string $string ) 

내장 함수 strtolower(), mb_strtolower()는 알파벳 문자열을 소문자로 변경합니다. 

| 내장 함수 | 
string strtoupper ( string $string ) 

내장 함수 stroupper(), mb_stroupper()는 알파벳 문자열을 대문자로 변경합니다. 

예제 파일 | strtolower.php 
1 <?php 2 $lower = "ABCD"; 3 echo $lower. "=" . strtolower($lower). "<br>"; 4 5 $upper = "abcd"; 6 echo $upper. "=" . strtoupper("abcd"). "<br>"; 7 8 ?> 

화면 출력 
ABCD=abcd abcd=ABCD 

### 03.8.3 낙타 표기 
알파벳의 단어나 문장들을 단어의 첫 글자를 대문자로 표기하는 낙타 표기법을 사용합 
니다. PHP는 단어의 낙타 표기법을 변환할 수 있는 함수들을 제공합니다. 

| 내장 함수 | 
string ucwords ( string $str [, string $delimiters = " \t\r\n\f\v" ] ) 

내장 함수 ucwords()는 단어를 낙타 표기법처럼 각각의 단어를 대문자로 변환합니다. 

| 내장 함수 | 
string ucfirst ( string $str ) 

내장 함수 ucfirst()는 전체 문자열 중에서 첫 글자만 대문자로 변환합니다. 

예제 파일 | ucwords.php 
1 <?php 2 $string = "abcd ergh ijkl mnop"; 3 4 // 첫 단어를 대문자로 변경합니다. 5 echo ucwords($string) . "<br>"; 6 7 // 문자열 전체에서 첫 단어만 대문자로 변경합니다. 8 echo ucfirst($string) . "<br>"; 9 10 ?> 

화면 출력 
Abcd Ergh Ijkl Mnop Abcd ergh ijkl mnop 

| 내장 함수 | 
string lcfirst ( string $str ) 

내장 함수 lcfirst()는 문자열의 첫 번째 문자를 소문자로 변환합니다. 
1  <?php  
2  $str = 'HelloWorld';  
3  $str = lcfirst($str);  
4  echo $str;  
5  
6  ?>  

화면 출력 
helloWorld 

