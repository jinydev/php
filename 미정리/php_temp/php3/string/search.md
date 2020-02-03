
## 03.3.문자열 검색 
문자열을 다양하게 처리하기 위해서는 문자열에서 특정 문자들의 위치를 찾아 처리하는 
것입니다. 문자열의 내용을 검색하고 값을 반환하거나 위치 값을 구할 수 있습니다. 

### 03.3.1 첫 번째 검색 
내장 함수 strstr()은 문자열 안에서 찾을 문자의 첫 번째 위치를 구하고, 이후의 문자열을 데이터를 반환합니다. 문자를 검색할 때는 대소문자를 구별을 하는 점을 주의해야 합니다. 

| 내장 함수 | 
string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] ) 

strchr() 함수는 strstr() 함수의 별칭으로 동일한 작업을 수행합니다. 

예제 파일 | strstr.php 
1 <?php 2 $str = "abcdeghijklem-abcdeghijklem-1234567"; 3 echo "원본 : " . $str . "<br>"; 4 5 // 문자열에서 em-으로 시작하는 위치를 찾아 6 // 이후의 문자열을 반환합니다. 7 $a = strstr($str,"em-"); 8 echo $a; 9 10 ?> 

화면 출력 
원본 : abcdeghijklem-abcdeghijklem-1234567 em-abcdeghijklem-1234567 

| 내장 함수 | 
string stristr ( string $haystack , mixed $needle [, bool $before_needle = false ] ) 

내장 함수 stristr()은 strstr() 함수와 동일한 동작을 하는 함수입니다. 하지만 차이점으로 
는 대소문자를 구분하지 않습니다. 

### 03.3.2 마지막 검색 
내장 함수 strrchr()은 strstr() 함수와 반대로 마지막 위치를 찾아서 문자열 데이터를 처 리합니다. 검색하고자 하는 문자열에 찾을 문자들이 여러 개가 있는 경우 마지막 부분을 반환합니다. 

| 내장 함수 | 
string strrchr ( string $haystack , mixed $needle ) 

예제 파일 | strrchr.php 
1 2 3 4  <?php $str = "abcdeghijklem-abcdeghijklem-1234567"; echo strrchr($str,"em");  
5  ?>  

화면 출력 
em-1234567 
위 실험에서 원본의 문자열에서 em 글자를 찾습니다. em 글자는 원본 문자열에 두 번 포 함하고 있습니다. 마지막의 em 위치를 찾아서 이후의 문자열의 데이터를 반환합니다. 

### 03.3.3 첫 번째 위치 
내장 함수 strpos()는 문자열에서 검색하고자 하는 글자를 찾아 첫 번째 위치를 반환합 니다. 만일 글자를 찾게 되면 문자열의 시작 위치를 정수값으로 반환합니다. 

| 내장 함수 | 
mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] ) 

예제 파일 | strpos.php 
1 2 3 4 5 6  <?php $string = "abcdefg"; $keyword = "cde"; if (($pos = strpos($string, $keyword)) === false) { echo "Err] 찾는 문자열이 없습니다.";  
7 8 9 10  } else { echo "문자열 시작 위치 $pos 존재<br>"; }  
11  ?>  

화면 출력 
문자열 시작 위치 2 존재 

| 내장 함수 | 
mixed stripos ( string $haystack , string $needle [, int $offset = 0 ] ) 
내장 함수 stripos()는 strpos()와 동일한 동작을 합니다. 차이점으로는 검색 시 대소문자 를 구분하지 않고 처리합니다. 

### 03.3.4 마지막 위치 
내장 함수 strrpos()는 문자열에서 검색하고자 하는 글자의 마지막 위치의 값을 정수값으 로 반환합니다. 

| 내장 함수 | 
int strrpos ( string $haystack , string $needle [, int $offset = 0 ] ) 
1 <?php 2 $str = "abcdeghijklem-abcdeghijklem-1234567"; 3 echo "원본 : " . $str . "<br>"; 4 $a = strrpos($str,"em-"); 5 echo $a; 6 7 ?> 

화면 출력 
원본 : abcdeghijklem-abcdeghijklem-1234567 25 

| 내장 함수 | 
int strripos ( string $haystack , string $needle [, int $offset = 0 ] ) 

내장 함수 strripos()는 strrpos() 함수와 동일하게 동작합니다. 차이점으로는 문자열에서 
대소문자를 구분하지 않고 문자열의 마지막 위치를 찾습니다. 

### 03.3.5 마스크 필터 
내장 함수 strspn()은 문자열 $object의 첫 번째 문장에 대해서 마스크 필터링된 길이를 
출력합니다. 

| 내장 함수 | 
int strspn ( string $subject , string $mask [, int $start [, int $length ]] ) 

예제 파일 | strspn.php 
1 <?php 2 // mask에 맞는 initial segment의 길이를 반환합니다. 3 $object = "423336 is the answer to the 128th question."; 
4  $mask = "1234567890abcdefhijslmnopqrstuvwxyz";  
5  $var = strspn($object, $mask);  
6  
7  echo $var;  
8  
9  ?>  

화면 출력 
내장 함수 strcspn()은 $subject 문자열에서 $mask에 포함되어 있지 않은 문자의 초기 세그먼트 값의 길이를 출력합니다. 

| 내장 함수 | 
int strcspn ( string $subject , string $mask [, int $start [, int $length ]] ) 

예제 파일 | strcspn.php 
1 <?php 2 3 $a = strcspn('abcd', 'apple'); 4 var_dump($a); //0 5 6 $b = strcspn('abcd', 'banana'); 7 var_dump($b); // 0 8 9 $c = strcspn('hello', 'l'); 10 var_dump($c); // 2 11 12 $d = strcspn('hello', 'world'); 13 var_dump($d); // 2 14 15 $e = strcspn('abcdhelloabcd', 'abcd', -9); 16 var_dump($e); //5 17 18 $f = strcspn('abcdhelloabcd', 'abcd', -9, -5); 19 var_dump($f); //4 20 ?> 
int(0) int(0) int(2) int(2) int(5) int(4) 

### 03.3.6 매칭 검색 
내장 함수 strpbrk()는 임의의 문자 집합에 대한 문자열을 검색합니다. 매칭 검색된 이후 
의 문자열을 반환합니다. 

| 내장 함수 | 
string strpbrk ( string $haystack , string $char_list ) 

예제 파일 | strpbrk.php 
1  <?php  
2  
3  $text = 'This is a Simple text.';  
4  
5  // "is is a Simple text."를 출력합니다.  
6  // 처음에 'i'가 먼저 매칭되었기 때문입니다.  
7  echo strpbrk($text, 'mi');  
8  echo "<br>";  
9  
10  // "Simple text."를 출력합니다.  
11  echo strpbrk($text, 'S');  
12  
13  ?>  

화면 출력 
is is a Simple text. Simple text. 
위의 예제는 임의의 문자 $char_list에 대해서 매칭 검색을 하여 처리합니다. 매칭되는 문 자들은 1개 또는 여러 개일 수 있습니다. 

