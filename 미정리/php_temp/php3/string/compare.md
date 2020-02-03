
## 03.4.문자열 비교 
---
문자열을 비교하여 처리하는 기능은 문자열 처리 중에서도 비중이 높은 활용도가 있는 부 분입니다. PHP는 다양한 문자열 비교 함수를 통하여 보다 쉽게 문자열을 처리할 수 있습 니다. 

### 03.4.1 문자열 비교 
내장 함수 strcmp()는 바이너리 형태로 2개의 문자열을 비교합니다. 2개의 문자열이 같 을 경우 0보다 큰 값을 반환합니다. 문자열을 비교할 때는 대소문자를 구별합니다. 

| 내장 함수 | 
int strcmp ( string $str1 , string $str2 ) 

예제 파일 | strcmp.php 
1  <?php  
2  $str1 = "hello";  
3  $str2 = "hello";  
4  $str3 = "word";  
5  
6  if (strcmp($str1, $str2) == 0) {  
7  echo $str1 ."== ". $str2 . "<br>";  
8  } else {  
9  echo $str1 ."!= ". $str2 . "<br>";  
10  }  
11  
12  if (strcmp($str2, $str3) == 0 ) {  
13  echo $str2 ."== ". $str3 . "<br>";  

14 } else { 15 echo $str2 ."!= ". $str3 . "<br>"; 
16 } 17 18 ?> 


화면 출력 
hello== hello hello!= word 

| 내장 함수 | 
int strcoll ( string $str1 , string $str2 ) 

내장 함수 strcoll( )은 현재 로케일 기반 문자열을 비교합니다. 현재 로케일이 C 또는 
POSIX면 이 함수는 strcmp()와 같습니다. 

예제 파일 | strcoll.php 
1 <?php 2 3 $a = 'a'; 4 $b = 'A'; 5 6 print strcmp ($a, $b) . "<br>"; 7 // prints 1 8 9 setlocale (LC_COLLATE, 'C'); 10 print "Locale based C: " . strcoll ($a, $b) . "<br>"; 11 // prints 1 12 13 setlocale (LC_COLLATE, 'de_DE'); 14 print "de_DE: " . strcoll ($a, $b) . "<br>"; 15 16 setlocale (LC_COLLATE, 'de_CH'); 17 print "de_CH: " . strcoll ($a, $b) . "<br>"; 18 19 setlocale (LC_COLLATE, 'en_US'); 
20 print "en_US: " . strcoll ($a, $b) . "<br>"; 21 22 ?> 

화면 출력 
1 Locale based C: 1 de_DE: 1 de_CH: 1 en_US: 1 

### 03.4.2 문자열 Binary safe 
---
C 언어와 같이 저수준의 언어의 경우 문자열은 메모리 세그먼트를 포인터로 표현합니다. 문자열의 마지막 종료 기호로는 특수 마크로 0바이트 또는 null 바이트를 사용합니다. 따 라서 0과 같이 이러한 특수 마크 기호는 문자열에 포함할 수 없습니다. 
이러한 점으로 문자열을 저장하는 또 다른 방법으로는 포인터와 문자열의 길이를 함께 저 
장하는 것입니다. 하지만 이러한 방법은 문자열을 관리하는 데 2개의 값을 사용해야 하기 때문에 문자열을 처리하는 것은 매우 복잡합니다. 

| 내장 함수 | 
int strncmp ( string $str1 , string $str2 , int $len )

내장 함수 strncmp()는 첫 번째 n 문자의 Binary safe 문자열을 비교합니다. 대소문자 
구분합니다. str1가 str2보다 작은 경우 0보다 작은 값을 반환합니다. str2가 str1보다 큰 경우에는 >0 값을 반환합니다. 2개의 값이 같은 경우에는 0을 반환합니다. 

예제 파일 | strncmp.php 
1 <?php 2 echo strncmp("xybc","a3234",0); 3 // 0 4 
5  echo "<br>";  
6  
7  echo strncmp("blah123","hohoho", 0);  
8  //0  
9  
10  ?>  

화면 출력 
0 0 

| 내장 함수 | 
int strcasecmp ( string $str1 , string $str2 ) 

내장 함수 strcasecmp()는 Binary safe 유형으로 대소문자를 구분하지 않고 문자열을 비교합니다. 

예제 파일 | strcasecmp.php 
1 2  <?php $var1 = "Hello";  
3  $var2 = "hello";  
4 5  if (strcasecmp($var1, $var2) == 0) { echo '$var1과 $var2는 대소문자를 구분하지 않고 동일한 문자열입니다.';  
6 7  }  
8  ?>  

화면 출력 
$var1 와 $var2 은 대소문자를 구분하지 않고 동일한 문자열입니다. 

| 내장 함수 | 
int substr_compare ( string $main_str , string $str , int $offset [, int $length [, bool $case_insensitivity = false ]] ) 

내장 함수 substr_compare()는 바이너리 세이프 형태로 오프셋의 두 문자열 비교, 최대 길이 문자를 비교합니다. substr_compare()는 오프셋 위치에서 main_str을 str과 최대 길이 문자를 비교합니다. 

예제 파일 | substr_compare.php 
1 <?php 2 echo substr_compare("abcde", "bc", 1, 2); // 0 3 echo substr_compare("abcde", "de", -2, 2); // 0 4 echo substr_compare("abcde", "bcg", 1, 2); // 0 5 echo substr_compare("abcde", "BC", 1, 2, true); // 0 6 echo substr_compare("abcde", "bc", 1, 3); // 1 7 echo substr_compare("abcde", "cd", 1, 2); // -1 8 echo substr_compare("abcde", "abc", 5, 1); // warning 9 10 ?> 

화면 출력 
0 0 0 0 1 -1 


### 03.4.3 자연 순서 
자연 순서 알고리즘을 통하여 문자열을 비교하고 처리할 수 있습니다. 

int strnatcmp ( string $str1 , string $str2 ) 

내장 함수 strnatcmp()는 ‘자연 순서’ 알고리즘을 사용하여 문자열을 비교합니다. 

예제 파일 | strnatcmp.php 
1  <?php  
2  $arr1 = $arr2 = array("img12.png", "img10.png", "img2.png", "img1.  
png");  
3  echo "Standard string comparison\n";  
4  usort($arr1, "strcmp");  
5  print_r($arr1);  
6  
7  echo "\nNatural order string comparison\n";  
8  usort($arr2, "strnatcmp");  
9  print_r($arr2);  
10  ?>  

화면 출력 
Standard string comparison Array ( [0] => img1.png [1] => img10.png [2] => img12.png [3] => img2.png ) Natural order string comparison Array ( [0] => img1.png [1] => img2.png [2] => img10.png [3] => img12.png ) 

| 내장 함수 | 
int strnatcasecmp ( string $str1 , string $str2 ) 

내장 함수 strnatcasecmp()는 ‘자연 순서’ 알고리즘을 적용합니다. 대소문자를 구분하지 
않는 문자열 비교합니다. 

### 03.4.4 유사성 
문자열의 유사성을 비교하고 검사합니다. 

| 내장 함수 | 
int similar_text ( string $first , string $second [, float &$percent ] ) 
내장 함수 similar_text()는 2개의 문자의 비슷한 정도를 계산합니다. 

예제 파일 | similar_text.php 
1  <?php  
2  $str1 = "안녕하세요! 지니 입니다.";  
3  $str2 = "안녕하세요! jiny 입니다.";  
4  
5  
6  similar_text($str1, $str2, $percent);  
7  echo "두 문장의 유사도는 $percent % 입니다.<br>";  
8  
9  similar_text($str2, $str1, $percent);  
10  echo "두 문장의 유사도는 $percent % 입니다.<br>";  
11  
12  ?>  

화면 출력 
두 문장의 유사도는 84.848484848485 % 입니다. 두 문장의 유사도는 84.848484848485 % 입니다. 

| 내장 함수 | 
string soundex ( string $str ) 

내장 함수 soundex()는 문자열의 soundex 키 값을 반환합니다. 

1 <?php 2 echo "Euler ".soundex("Euler") . " == " . 3 "Ellery ". soundex("Ellery") . "<br>"; 4 5 echo "Gauss ".soundex("Gauss") . " == " . 6 "Ghosh ". soundex("Ghosh") . "<br>"; 7 8 echo "Hilbert ".soundex("Hilbert") . " == " . 9 "Heilbronn ". soundex("Heilbronn") . "<br>"; 10 11 ?> 

화면 출력 
Euler E460 == Ellery E460 Gauss G200 == Ghosh G200 Hilbert H416 == Heilbronn H416 

내장 함수 levenshtein( )은 두 문자열 사이의 Levenshtein 거리를 반환합니다. 
Levenshtein 거리는 문자열 str1을 str2로 변환하기 위해 교체하거나 삽입 또는 삭제해 
야 하는 최소 문자 수를 말합니다. 

| 내장 함수 | 
int levenshtein ( string $str1 , string $str2 ) 

예제 파일 | levenshtein.php 
1 <?php 2 // 당근 : carrot의 스펠링을 잘못 입력합니다. 3 $input = 'carrrot'; 4 5 // 단어 데이터들 6 $words = array('apple','pineapple','banana','orange', 7 'radish','carrot','pea','bean','potato'); 8 
9 $shortest = -1; 
11 // 입력한 단어를 비교합니다. 12 foreach ($words as $word) { 13 14 $lev = levenshtein($input, $word); 
16 // 입력한 단어가 일치할 때 17 if ($lev == 0) { 18 19 // 일치한 단어 설정
 $closest = $word; 21 $shortest = 0; 22 23 // 단어가 일치하기 때문에, 반복문 종료 24 break;
 } 
26 27 if ($lev <= $shortest || $shortest < 0) { 
28  $closest = $word;  
29  $shortest = $lev; 
 }  
31  }  
32  

33 echo "입력 단어: $input <br>"; 34 if ($shortest == 0) { echo "정확한 단어: $closest <br>"; 
36 } else { 37 echo "혹시 원하는 단어가 $closest 입니까? <br>"; 
38 } 39 

?> 
화면 출력 
입력 단어: carrrot 혹시 원하는 단어가 carrot 입니까? 

string metaphone ( string $str [, int $phonemes = 0 ] ) 

내장 함수 metaphone()은 문자열의 메타폰 키를 계산합니다. 

예제 파일 | metaphone.php 
1 <?php 2 var_dump(metaphone('programming')); 3 echo "<br>"; 4 var_dump(metaphone('programmer')); 5 echo "<br>"; 6 var_dump(metaphone('programming', 5)); 7 echo "<br>"; 8 var_dump(metaphone('programmer', 5)); 9 echo "<br>"; 10 11 ?> 

화면 출력 
string(7) "PRKRMNK" string(6) "PRKRMR" string(5) "PRKRM" string(5) "PRKRM" 


