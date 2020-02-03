
## 03.9.변환 
정수형 자료의 경우 숫자의 값을 가지고 있습니다. 실수형의 자료의 경우도 실수의 숫자 값을 가지고 있습니다. 하지만 정수형, 실수형의 표현은 문자로도 출력이 가능합니다. 
정수값, 실수값을 문자로 정확하게 표기하기 위해서는 내부 숫자 변환 함수를 이용하면 편리합니다. 

### 03.9.1 숫자 표기 
내장 함수 number_format()은 입력된 문자열을 기준으로 그룹화된 숫자 서식 형태로 변경할 수 있습니다. 함수의 입력 매개변수는 1개, 2개, 4개로 전달합니다. 

| 내장 함수 | 
string number_format ( float $number [, int $decimals = 0 ] ) 

기본적으로 매개변수 1개만 입력되는 경우 천 단위 표기로 변경된 포맷을 출력합니다. 두 번째 인자값은 소수점 자리수를 의미합니다. 
세 번째 인자와 네 번째 인자는 같이 한 쌍으로 입력해야 합니다. 세 번째는 소수점 표기 
기호, 네 번째는 천 단위 표시 기호입니다. 

예제 파일 | number_format.php 
1 <?php 2 3 $number = 1234.56; 4 5 // 기본 6 // 매개인자 1개만전달할 경우 천단위 구분자 쉼표(,)로 포맷 변경됩니다. 7 echo number_format($number) ."<br>"; 8 // 1,235 9 10 // 두 번째 매개변수는 소수점 자리수 11 echo number_format($number,5) ."<br>"; 12 // 1,234.56000 13 14 // 세 번째 인자는 = 소수점 표기 기호 15 // 네 번째 인자는 = 천 단위 표기 기호 16 echo number_format($number, 2, ',', ' ') ."<br>"; 17 // 1 234,56 18 19 $number = 1234.5678; 20 echo number_format($number, 2, '.', ','); 21 // 1234.57 22 23 ?> 

화면 출력 
1,235 1,234.56000 1 234,56 1,234.57 

### 03.9.2 통화 표시 
경제학, 금융 쪽에서 사용되는 숫자는 통화로 사용되는 경우가 많습니다. 숫자를 통화로 
표기하는 것은 각각의 나라마다 표현하고 처리하는 방법이 다릅니다. 
서는 money_format()을 사용할 수 없습니다. 

| 내장 함수 | 
string money_format ( string $format , float $number ) 

예제 파일 | money_format.php 
1 <?php 2 3 $number = 1234.56; 4 5 // 로컬 설정 en_US 6 setlocale(LC_MONETARY, 'en_US'); 7 echo "en_US". money_format('%i', $number) . "<br>"; 8 // USD 1,234.56 9 10 // 이탈리아 포맷 2 decimals` 11 setlocale(LC_MONETARY, 'it_IT'); 12 echo money_format('%.2n', $number) . "\n"; 13 // Eu 1.234,56 14 15 // 음수 값 16 $number = -1234.525234; 17 18 // US 포맷 19 // 왼쪽 정밀도의 경우 10 자리 20 setlocale(LC_MONETARY, 'en_US'); 21 echo money_format('%(#10n', $number) . "\n"; 22 // ($ 1,234.57) 23 24 // 위 형식과 비슷한 형식으로 2 자리의 오른쪽 자리 정밀도와 25 // '*'를 채우기 문자로 추가합니다. 26 echo money_format('%=*(#10.2n', $number) . "\n"; 27 // ($********1,234.57) 28 29 30 // 왼쪽에서 14 자리의 너비, 8 자리의 왼쪽 자릿수, 2 자리의 오른쪽 자릿수 
31  // withouth 그룹화 문자 및 de_DE 로케일의 국제 형식을 사용합시다.  
32  setlocale(LC_MONETARY, 'de_DE');  
33  echo money_format('%=*^-14#8.2i', 1234.56) . "\n";  
34  // Eu 1234,56****  
35  
36  
37  // 전환 지정 전후에 몇 가지 문안을 추가하겠습니다.  
38  setlocale(LC_MONETARY, 'en_GB');  
39  $fmt = 'The final value is %i (after a 10%% discount)';  
40  echo money_format($fmt, 1234.56) . "\n";  
41  // The final value is GBP 1,234.56 (after a 10% discount)  
42  
43  ?>  


