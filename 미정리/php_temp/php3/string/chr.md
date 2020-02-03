
## 03.6.문자 
문자는 문자열을 구성하는 요소입니다. PHP는 이러한 문자들을 표현하고 처리할 수 있 는 다양한 함수를 제공합니다. 

| 내장 함수 | 
string chr ( int $ascii ) 

내장 함수 chr()은 아스키 코드값에 대한 문자를 출력합니다. 

예제 파일 | chr.php 
1 <?php 2 // 아스키 코드 3 echo "27 = ".chr(27)."<br>"; 4 echo "65 = ".chr(65)."<br>"; 5 echo "92 = ".chr(92)."<br>"; 6 

화면 출력 
27 = 65 = A 92 = \ 

| 내장 함수 | 
int ord ( string $string ) 

내장 함수 ord()는 입력한 문자의 아스키 코드값을 출력합니다. 

예제 파일 | ord.php 
1 <?php 2 // 아스키 코드 3 echo "27 = ".chr(27)."<br>"; 4 echo "65 = ".chr(65)."<br>"; 5 echo "92 = ".chr(92)."<br>"; 6 7 echo "<br>"; 8 9 echo "A = ".ord('A')."<br>"; 10 echo "+ = ".ord('+')."<br>"; 11 echo "% = ".ord('%')."<br>"; 12 13 ?> 

화면 출력 
27 = 65 = A 92 = \ 
A = 65 + = 43 % = 37 

| 내장 함수 | 
string str_repeat ( string $input , int $multiplier ) 

내장 함수 str_repeat()는 문자열을 지정한 횟수만큼 반복합니다. 

예제 파일 | str_repeat.php 
1 <?php 2 echo str_repeat("-=", 10); 3 4 ?> 

화면 출력 
-=-=-=-=-=-=-=-=-=-= 

| 내장 함수 | 
string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_ type = STR_PAD_RIGHT ]] ) 

내장 함수 str_pad()는 문자열을 다른 문자열로 특정 길이를 채웁니다. 

예제 파일 | str_pad.php 
1 <?php 2 $input = "hojin"; 3 echo str_pad($input, 10) ."<br>"; 4 echo str_pad($input, 10, "-=", STR_PAD_LEFT) ."<br>"; 5 echo str_pad($input, 10, "_", STR_PAD_BOTH) ."<br>"; 6 echo str_pad($input, 6, "___") ."<br>"; 7 echo str_pad($input, 3, "*") ."<br>"; 8 9 ?> 

hojin -=-=-hojin __hojin___ hojin_ hojin 

