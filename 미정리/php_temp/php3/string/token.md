## 03.7.구분화 
구분화는 문자열을 특정한 규칙을 통하여 분리하는 기능입니다. 여러 개의 문자열 데이터 
를 특정 키를 기준으로 연결되어 있을 경우 이를 처리하여 구분할 수 있습니다. 

### 03.7.1 토큰 

내장 함수 strtok()는 문자열을 주어진 키로 토큰화합니다. 

| 내장 함수 | 
string strtok ( string $str , string $token ) 

예제 파일 | strtok.php 
1  <?php  
2  $str = "안녕하세요! 지니 PHP 코딩입니다.";  
3  
4  // 공백 문자로 문자열을 토큰화합니다.  
5  $aaa = strtok($str," ");  
6  
7  $i=0;  
8  
9  while ($aaa) {  
10  echo $i++ . "= ". $aaa . "<br>";  
11  $aaa = strtok(" ");  
12  }  
13  
14  ?>  


0= 안녕하세요! 1= 지니 2= PHP 3= 코딩 4= 입니다. 

| 내장 함수 | 
array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] ) 
내장 함수 explode()는 주어진 문자열을 구분자로 구분하여 배열로 변환합니다. 

| 내장 함수 | 
string implode ( string $glue , array $pieces ) 

내장 함수 implode()는 반대로 배열을 연결하여 문자열로 반환합니다. 

예제 파일 | implode.php 
1 <?php 2 3 $string = "aaa;bbb;ccc;ddd;eee"; 4 $arr = explode(";", $string); 5 6 foreach ($arr as $key => $value) { 7 echo $key."=",$value."<br>"; 
8 } 9 10 $msg = implode(",", $arr); 11 echo $msg; 12 13 ?> 
0=aaa 1=bbb 2=ccc 3=ddd 4=eee aaa,bbb,ccc,ddd,eee 

### 03.7.2 문자열 분리 
내장 함수 chunk_split( )는 문자열을 비슷한 작은 크기로 분리합니다. base64_ 
encode() 출력을 RFC 2045 에 맞게 변환할 때 유용하게 사용할 수 있습니다. 모든 문자 
마다 종료 시퀀스 "\r\n"을 삽입합니다. 

| 내장 함수 | 
string chunk_split ( string $body [, int $chunklen = 76 [, string $end = "\r\n" ]] ) 

예제 파일 | chunk_split.php 
1 <?php 2 $str = "abcdefghijklem"; 3 echo chunk_split($str, 4) ."<br>"; 4 5 ?> 

화면 출력 
abcd efgh ijkl em 

| 내장 함수 | 
array str_split ( string $string [, int $split_length = 1 ] ) 

내장 함수 str_split()는 문자열을 배열로 변환합니다. 

예제 파일 | str_split.php 
1  <?php  
2  
3  $str = "Hello Friend";  
4  
5  // 한 글자씩 배열로 변환합니다.  
6  $arr1 = str_split($str);  
7  print_r($arr1);  
8  echo "<br>";  
9  
10  // 세 글자씩 배열로 변환합니다.  
11  $arr2 = str_split($str, 3);  
12  print_r($arr2);  
13  
14  ?>  

화면 출력 
Array ( [0] => H [1] => e [2] => l [3] => l [4] => o [5] => [6] => F [7] => r [8] => i [9] => e [10] => n [11] => d ) Array ( [0] => Hel [1] => lo [2] => Fri [3] => end ) 

### 03.7.3 래핑 
내장 함수 wordwrap()은 문자열을 주어진 문자 수로 래핑합니다. 

| 내장 함수 | 
string wordwrap ( string $str [, int $width = 75 [, string $break = "\n" [, bool $cut = false ]]] ) 

예제 파일 | wordwrap.php 
1 <?php 2 $text = "The quick brown fox jumped over the lazy dog."; 3 $newtext = wordwrap($text, 20, "<br />\n"); 4 
5 echo $newtext; 6 7 ?> 

화면 출력 
The quick brown fox jumped over the lazy dog. 

### 03.7.4 변수 해석 
내장 함수 parse_str()은 입력된 하나의 문자열을 변수로 해석합니다. 각각의 변수는 &로 구분하며, 변수명=값 형태로 지정할 수 있습니다. 

| 내장 함수 | 
void parse_str ( string $encoded_string [, array &$result ] ) 

예제 파일 | parse_str.php 
1 <?php 2 $str = "name[]=jiny&name[]=lee&country=korea"; 3 parse_str($str); 4 5 echo $country . "<br>"; 6 7 echo $name[0]."<br>"; 8 echo $name[1]."<br>"; 9 10 ?> 

화면 출력 
korea jiny lee 

