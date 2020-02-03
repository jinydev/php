
## 03.2.문자열 자르기 
문자열을 처리하는 데 있어서 많이 사용하는 기능은 문자열을 분리하는 것입니다. 문자열 은 다양한 형태로 존재하기 때문에 관련 함수들이 많이 지원됩니다. 

### 03.2.1 문자열 제거 
---
내장 함수 substr()은 입력한 문자열의 일부분을 잘라낼 수 있습니다. 문자열을 잘라낼 때 는 문자열의 시작 위치와 끝 위치를 지정하여 해당 부분을 추출합니다. 

| 내장 함수 | 
string substr ( string $string , int $start [, int $length ] ) 
예제 파일 | substr.php 
1  <?php  
2  $string = "abcdefghijklmnopqrstuvwxyz";  
3  
4  // 1 위치 이후부터 표시함  
5  echo substr($string,1)."<br>";  
6  
7  // 3 위치 이후부터 5개 표시함  
8  echo substr($string,3,5)."<br>";  
9  
10  ?>  


화면 출력 
bcdefghijklmnopqrstuvwxyz defgh 

위의 예제는 문자열 $string 변수에서 특정 부분의 문자열을 추출합니다. 문자열을 추출 할 때 세 번째 끝 값은 생략이 가능합니다. 끝 값을 생략할 때는 시작부터 끝까지를 모두 출력합니다. 

### 03.2.2 공백 제거 
문자열 변수는 공백도 문자로 취급을 합니다. 문자열을 가공하다가 보면 문자열 앞 또는 뒤에 쓸모가 없는 공백 문자들이 있는 경우가 있습니다. 이러한 경우 공백을 자동적으로 제거할 수 있는 내장 함수를 제공하고 있습니다. 
PHP는 공백을 제거하고 처리할 수 있는 3개의 함수를 제공합니다. trim( ), ltrim( ), rtrim() 함수는 문자열의 공백을 제거합니다. 

| 내장 함수 | 양쪽 공백 제거 
string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] ) 

내장 함수 trim()은 문자열의 앞뒤에 존재하는 공백 문자를 제거합니다. 

| 내장 함수 | 우측 공백 제거 
string rtrim ( string $str [, string $character_mask ] ) string chop (string str); 

내장 함수 rtrim(), chop()은 문자열 오른쪽에 있는 공백 문자를 제거합니다. chop() 함 수는 rtrim() 함수의 별칭입니다. 

string ltrim ( string $str [, string $character_mask ] ) 

내장 함수 ltrim()은 문자열의 왼쪽에 있는 공백 문자를 제거합니다. 

예제 파일 | trim.php 
1 <?php 2 $string = " jiny "; 3 echo "안녕하세요!".$string."입니다.<br>"; 
4 5 // 앞뒤 공백 문자열을 삭제합니다. 6 echo "안녕하세요!".trim($string)."입니다.<br>"; 
7 8 // 오른쪽 공백을 제거합니다. 9 echo "안녕하세요!".chop($string)."입니다.<br>"; 10 echo "안녕하세요!".rtrim($string)."입니다.<br>"; 
11 12 // 왼쪽 공백을 제거합니다. 13 echo "안녕하세요!".ltrim($string)."입니다.<br>"; 
14 15 ?> 

화면 출력 
안녕하세요! jiny 입니다. 
안녕하세요!jiny입니다. 안녕하세요! jiny입니다. 안녕하세요! jiny입니다. 안녕하세요!jiny 입니다. 

