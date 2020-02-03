## 03.13 문자열 출력
---
PHP에서 변수의 데이터 값을 출력할 수 있는 방법은 다양합니다. 간단하게 결과를 출력 하는 echo 함수뿐만 아니라 다양한 포맷을 통하여 출력할 수 있는 몇 가지 함수를 제공합 니다. 

### 03.13.1 출력 
내장 함수 echo()는 문자열을 출력합니다. php에서 가장 기본적이고 결과를 출력할 수 있는 방법입니다. 

| 내장 함수 | 
void echo ( string $arg1 [, string $... ] ) 

예제 파일 | echo.php 
<?php 
2 echo "hello world"; 3 4 ?> 

화면 출력 
hello world 
| 내장 함수 | 
int print ( string $arg ) 

내장 함수 print() 함수는 echo() 함수와 다르게 문자열을 화면에 출력 후 성공 여부를 논 리값으로 반환합니다. 반환값은 화면의 정상적인 출력 여부를 확인할 때 편리합니다. 

예제 파일 | print.php 
1 2 3  <?php if (print("안녕하세요!")) { echo ">true";  
4 5  } else { echo ">false";  
6 7  }  
8  ?>  

화면 출력 
안녕하세요!>true 

### 03.13.2 포맷 출력 
포맷 출력은 문자열을 그대로 출력하는 것이 아니라 포맷팅 처리를 하여 결과를 출력하는 방법입니다. 포맷팅 출력은 C 언어 등에서 많이 이용하는 방법입니다. PHP에서도 C 언 어와 같이 다양한 포맷팅 처리 함수를 사용할 수 있습니다. 
사용법 또한 매우 유사합니다. 사용되는 포맷 코드는 다음과 같습니다. 

● %b: 바이너리 출력 
● %c: 아스키문자 출력 
● %d: 10진수 출력 
● %f: 실수 출력 
● %o: 8진수 출력 
● %s: 문자열 출력 
● %x: 16진수 소문자 출력 
● %X: 16진수 대문자 출력 

| 내장 함수 | 
int printf ( string $format [, mixed $args [, mixed $... ]] ) 
내장 함수 printf()는 문자열을 지정한 포맷 방식으로 출력합니다. 포맷은 출력 문자열에 지정한 타입 형태로 데이터를 삽입하여 출력할 수 있는 기능입니다. 

예제 파일 | printf.php 
1 2 3  <?php $na me = "jiny";  
4 5  if  (printf("안녕하세요! %s 입니다.",$name)) { echo ">true";  
6 7  } e lse { echo ">false";  
8 9  }  
10  ?>  

화면 출력 
안녕하세요! jiny 입니다.>true 

| 내장 함수 | 
int fprintf ( resource $handle , string $format [, mixed $args [, mixed $... ]] ) 
내장 함수 fprintf()는 지정한 포맷을 스트림으로 출력합니다. 

예제 파일 | fprintf.php 
1 <?php 2 if (!($fp = fopen('date.txt', 'w'))) { 3 return; 
4 } 5 6 // 지정한 포맷으로 파일 스트림에 출력합니다. 7 fprintf($fp, "%04d-%02d-%02d", $year, $month, $day); 8 9 ?> 

| 내장 함수 | 
int vprintf ( string $format , array $args ) 

내장 함수 vprintf()는 형식화된 문자열을 출력합니다.

예제 파일 | vprintf.php 
1  <?php  
2  vprintf("%04d-%02d-%02d", explode('-', '2017-8-6'));  
3  
4  ?>  

화면 출력 
2017-08-06 
int vfprintf ( resource $handle , string $format , array $args ) 

내장 함수 vfprintf()는 지정한 포맷을 스트림으로 출력합니다. 

예제 파일 | vfprintf.php 
1  <?php  
2  if (!($fp = fopen('date.txt', 'w')))  
3  return;  
4  
5  vfprintf($fp, "%04d-%02d-%02d", array($year, $month, $day));  
6  
7  ?>  

| 내장 함수 | 
string sprintf ( string $format [, mixed $args [, mixed $... ]] ) 

내장 함수 sprintf()는 printf() 함수와 달리 화면에 출력하지 않고 포맷 형태로 변환하여 문자열을 반환합니다. 

예제 파일 | sprintf.php 
1 2 3 4 5  <?php $name = "jiny"; $string = sprintf("안녕하세요! %s 입니다.",$name); echo $string;  
6  ?>  

화면 출력 
안녕하세요! jiny 입니다. 

| 내장 함수 | 
string vsprintf ( string $format , array $args ) 

내장 함수 vsprintf()는 포맷 스트링을 반환합니다. 

예제 파일 | vsprintf.php 
1  <?php  
2  echo vsprintf("%04d-%02d-%02d", explode('-', '2017-8-6'));  
3  
4  ?>  

화면 출력 
2017-08-06 

03.13.3 포맷 입력 
내장 함수 sscanf()는 형식에 따라 입력된 문자열의 구문 분석합니다. 

| 내장 함수 | 
mixed sscanf ( string $str , string $format [, mixed &$... ] ) 

예제 파일 | sscanf.php 
1 <?php 
2 // 시리얼 넘버를 읽어옵니다. 
3 list($serial) = sscanf("SN/123456", "SN/%d"); 
4 
5 $mandate = "july 06 2017"; 
6 list($month, $day, $year) = sscanf($mandate, "%s %d %d"); 
7 echo "Item $serial was manufactured on: $year-" . substr($month, 0, 3) . "-$day\n"; 
8 ?> 

Item 123456 was manufactured on: 2017-jul-6 

