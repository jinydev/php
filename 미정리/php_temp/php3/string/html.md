# HTML 문자열
---

## 03.14 html 문자열 
PHP는 웹 사이트 개발 및 HTML을 처리하는 데 매우 친화적으로 사용할 수 있는 언어입 니다. HTML는 다양한 태그와 기호를 포함하고 있습니다. PHP는 HTML 태그들을 처리 하고 출력을 위한 다양한 함수를 지원합니다. 

### 03.14.1 백슬래시 
문자열을 처리하는 데 있어서 특수기호 백슬래시 (\)는 SQL 처리 및 문자열을 처리하는 데 방해될 수 있습니다. 웹과 DB 연동을 위해서 문자열의 백슬래시 기호는 안전하게 처 리해야 합니다. 이를 위해서 PHP는 백슬래시 처리에 관련된 함수를 제공합니다. 

| 내장 함수 | 
string addslashes ( string $str ) 

내장 함수 addslashes()는 주어진 문자열에 백슬래시로 감싸 반환합니다. 백슬래시는 ' , ", \ 등 특수기호를 데이터베이스 쿼리 등 작업할 때 많이 사용합니다. 

예제 파일 | addslashes.php 
1 <?php 2 echo addslashes("c:\aaa\bbb\ccc"); 3 echo "<br>"; 4 
5 echo addslashes("안녕하세요! 'jiny'님"); 6 echo "<br>"; 7 8 ?> 

화면 출력 
c:\\aaa\\bbb\\ccc 안녕하세요! \'jiny\'님 

| 내장 함수 | 
string addcslashes ( string $str , string $charlist ) 

내장 함수 addcslashes()는 C 스타일로 주어진 문자열에 백슬래시로 감싸 반환합니다. 

| 내장 함수 | 
string stripslashes ( string $str ) 

내장 함수 stripslashes()는 addslashes() 함수의 반대입니다. 주어진 매개변수 문자열에 서 quote 부분을 삭제하여 반환합니다. 

예제 파일 | stripslashes.php 
1 <?php 2 $str = "안녕하세요 '지니'입니다."; 3 $temp = addslashes($str); 4 echo $temp."<br>"; 5 6 $temp2 = stripslashes($temp); 7 echo $temp2."<br>"; 8 9 ?> 

화면 출력 
안녕하세요 \'지니\'입니다. 안녕하세요 '지니'입니다. 
| 내장 함수 | 
string stripcslashes ( string $str ) 

### 03.14.2 라인 브레이크 

콘솔 및 텍스트 기반의 문자열 처리에서 다음 줄을 표시하는 기호는 \n을 사용합니다. 하 지만 웹 화면에서는 다음 줄(\n)이 반영되지 않습니다. 
출력 결과를 웹으로 처리하기 위해서는 \n 기호를 웹에서의 다음 줄인 <br> 기호로 변경 해야 합니다. 

| 내장 함수 | 
string nl2br ( string $string [, bool $is_xhtml = true ] ) 

내장 함수 nl2br()은 HTML 라인 브레이크로 <br> 태그를 사용합니다. 

예제 파일 | nl2br.php 
1  <?php  
2  echo nl2br("안녕하세요!\n 지니입니다.");  
3  
4  ?>  

화면 출력 
안녕하세요! 지니입니다. 

### 03.14.3 태그 제거 
내장 함수 strip_tags( )는 문자열에서 HTML과 PHP 태그를 제거한 문자열을 반환합 니다. 

| 내장 함수 | 
string strip_tags ( string $str [, string $allowable_tags ] ) 

예제 파일 | strip_tags.php 
1 <?php 2 $html = " 3 <h1>안녕하세요!</h1> 4 <br> 5 <?php phpinfo(); ?> 6 "; 7 8 echo $html; 9 10 echo "=============== <br>"; 11 12 $temp = strip_tags($html); 13 echo $temp; 14 15 ?> 

화면 출력 
안녕하세요! 
=============== 안녕하세요! 

### 03.14.4 html entities 
내장 함수 htmlentities()는 변경 가능한 모든 글자들을 HTML entities 코드로 변환합 
니다. 

string htmlentities ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") [, bool $double_encode = true ]]] ) 
● ENT_COMPAT: 큰따옴표만 변환합니다. 
● ENT_QUOTES: 큰따옴표와 작은따옴표를 모두 변환합니다. 
● ENT_NOQUOTES: 큰따옴표와 작은따옴표를 변환하지 않습니다. 
● ENT_IGNORE: 빈 문자열을 반환하는 대신에 잘못된 코드 단위 시퀀스는 자동으 로 무시합니다. 이 플래그를 사용하면 보안에 영향을 미칠 수 있으므로 사용하지 않는 것이 좋습니다. 
● ENT_SUBSTITUTE: 잘못된 코드 단위 시퀀스를 유니 코드 대체 문자 U + FFFD (UTF-8) 또는 & # FFFD; (그렇지 않으면) 빈 문자열을 반환합니다. 
● ENT_DISALLOWED: 주어진 문서 유형에 대한 유효하지 않은 코드 포인트를 유 니 코드 대체 문자 U + FFFD (UTF-8) 또는 & # FFFD; (그렇지 않은 경우) 그대로 남겨 둡니다. 
● ENT_HTML401: 코드를 HTML 4.01로 처리합니다. 
● ENT_XML1: 코드를 XML 1 로 처리합니다. 
● ENT_XHTML: 코드를 XHTML로 처리합니다. 
● ENT_HTML5: 코드를 HTML 5 로 처리합니다. 

예제 파일 | htmlentities.php 
1 <?php 2 $str = "A 'quote' is <b>bold</b>"; 3 4 // 출력: A 'quote' is &lt;b&gt;bold&lt;/b&gt; 5 echo htmlentities($str); 6 echo "<br>"; 7 8 // 출력: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt; 9 echo htmlentities($str, ENT_QUOTES); 10 echo "<br>"; 
11  
12  $str = "\x8F!!!";  
13  
14  // 출력: an empty string  
15  echo htmlentities($str, ENT_QUOTES, "UTF-8");  
16  echo "<br>";  
17  
18  // 출력: "!!!"  
19  echo htmlentities($str, ENT_QUOTES | ENT_IGNORE, "UTF-8");  
20  echo "<br>";  
21  
22  ?>  

화면 출력
 'quote' is &lt;b&gt;bold&lt;/b&gt; <br> A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt; <br> <br> !!! <br> 

| 내장 함수 | 
string html_entity_decode ( string $string [, int $flags = ENT_COMPAT | ENT_ HTML401 [, string $encoding = ini_get("default_charset") ]] ) 

내장 함수 html_entity_decode ( )는 HTML 엔터티를 문자로 변환합니다. html_ 
entity_decode( )는 문자열의 모든 HTML 엔터티를 해당 문자로 변환한다는 점에서 
htmlentities()와 반대 함수입니다. 

예제 파일 | html_entity_decode.php 
1 <?php 2 $str = "I'll \"walk\" the <b>cat</b> now"; 3 echo $str."<br>"; 4 
5 $a = htmlentities($str); 6 echo $a."<br>"; 7 8 echo html_entity_decode($a); 9 10 ?> 

화면 출력 
I'll "walk" the cat now I'll "walk" the <b>cat</b> now I'll "walk" the cat now 

| 내장 함수 | 
string htmlspecialchars ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") [, bool $double_encode = true ]]] ) 

내장 함수 htmlspecialchars()는 다음과 같은 HTML 특수 문자를 다른 entity 코드로 변 환해 줍니다. 
● &&amp; 
● " &quot;, ● ' &#039; 
● < &lt; 
● > &gt; 

코드를 변환하여 출력하면 브라우저에서 코드를 분석하지 않고 html 코드 자체를 바로 출력할 수 있습니다. 

예제 파일 | htmlspecialchars.php 
1 <?php 2 $body = "<h1 class=\"aaa\" id='bb'>안녕하세요</h1> <br>"; 3 echo $body; 4 
5 echo htmlspecialchars($body); 6 7 ?> 

화면 출력 
<h1 class="aaa" id='bb'>안녕하세요</h1> <br> &lt;h1 class=&quot;aaa&quot; id='bb'&gt;안녕하세요&lt;/h1&gt; &lt;br&gt; 

| 내장 함수 | 
string htmlspecialchars_decode ( string $string [, int $flags = ENT_COMPAT | ENT_ HTML401 ] ) 
내장 함수 htmlspecialchars_decode()는 특수 HTML 엔터티를 다시 문자로 변환합 니다. htmlspecialchars() 함수의 반대 함수입니다. 
예제 파일 | htmlspecialchars_decode.php 
1 <?php 2 $str = "<p>this -&gt; &quot;</p>\n"; 3 4 echo htmlspecialchars_decode($str); 5 6 echo htmlspecialchars_decode($str, ENT_NOQUOTES); 7 8 ?> 

화면 출력 
<p>this -> "</p> <p>this -> &quot;</p> 

| 내장 함수 | 
array get_html_translation_table ([ int $table = HTML_SPECIALCHARS [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = "UTF-8" ]]] ) 

사용하는 변환 테이블을 반환합니다. 

예제 파일 | get_html_translation_table.php 
1 2  <?php var_dump(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_ HTML5));  
3  ?>  

화면 출력 
array(1511) { [" "]=> string(5) " " [" "]=> string(9) " " ["!"]=> string(6) "!" ["""]=> string(6) """ ["#"]=> string(5) "#" ….. 중간생략 } 


### 03.14.5 메타 
내장 함수 get_meta_tags()는 html 파일의 내용을 읽어 <head></head> 안에 설정되 
어 있는 메타 태그 값을 추출합니다. 추출된 모든 content를 배열 형태로 반환합니다. 

| 내장 함수 | 
array get_meta_tags ( string $filename [, bool $use_include_path = false ] ) 

예제 파일 | get_meta_tags.php 
1 <?php 2 // html 파일 3 $tags = get_meta_tags("sample.htm"); 4 
5 echo "META author = ". $tags['author'] ."<br>"; 6 echo "META keywords = ". $tags['keywords'] ."<br>"; 7 echo "META description = ". $tags['description'] ."<br>"; 8 9 ?> 

화면 출력 
META author = jiny META keywords = php documentation META description = jinyPHP 샘플 html 파일입니다. 

| 내장 함수 | 
string quotemeta ( string $str ) 
내장 함수 quotemeta()는 메타 문자들에 대해서 백슬래시가 붙어 있는 형태로 변환합 
니다. 
● 메타 문자:. \ + * ? [ ^ ] ( $ ) 

예제 파일 | quotemeta.php 
1 2 3 4  <?php $str = "Hello world. (반가워요!)"; echo quotemeta($str);  
5  ?>  

화면 출력 
Hello world\. \(반가워요!\) 

### 03.14.6 escape 
내장 함수 escapeshellcmd()는 이스케이프 셸 메타 문자를 처리합니다. 

string escapeshellcmd ( string $command ) 

escapeshellcmd()는 외부 입력값을 통하여 셸 명령을 실행할 때 발생할 수 있는 악성 문 자열 등을 이스케이프 처리합니다. 악성 문자열 등은 시스템 명령을 생성하는 과정에 악 의적인 명령을 통하여 시스템 보안을 취약하게 만들 수 있습니다. 
exec() 또는 system() 함수를 실행 전에 모든 입력 데이터에 대해서 이스케이프 처리를 하는 것이 좋습니다. 
다음 문자 앞에는 백슬래시를 추가합니다. & # &`| *?~ <> ^ () [] {} $\, \ x0A 및 \ xFF. 윈도우에서는 이러한 모든 문자와 % 및 !가 대신 공백으로 대체됩니다. 

예제 파일 | escapeshellcmd.php 
1  <?php  
2  $command = './configure '.$_POST['options'];  
3  
4  $escaped_command = escapeshellcmd($command);  
5  
6  system($escaped_command);  
7  
8  ?>  

| 내장 함수 | 
string escapeshellarg ( string $arg ) 

내장 함수 escapeshellarg()는 셸 인수로 사용되는 문자열을 이스케이프 처리합니다. 
escapeshellarg ()는 문자열 주위에 작은따옴표를 추가합니다. 또한 기존 작은따옴표를 인용/이스케이프하여 문자열을 셸 함수에 단일 안전한 인수로 전달하도록 처리합니다. 
셸 함수에는 exec(), system() 및 백틱 연산자가 포함됩니다. 
윈도우에서 escapeshellarg() 대신 백분율 (%) 기호, 느낌표 (!) 및 큰따옴표를 공백으로 대 체하고 문자열 주위에 큰따옴표를 추가합니다. 

예제 파일 | escapeshellarg.php 
1  <?php  
2  system('ls '.escapeshellarg($dir));  
3  
4  ?>  



### 03.15 로케일 및 코드 
IntlChar는 PHP 7.x로 업그레이드되면서 새롭게 추가된 클래스입니다. 새로운 IntlChar 클래스는 추가 ICU 기능을 노출합니다. 이는 유니 코드 문자를 조작하는 데 사용할 수 있 습니다. IntlChar 클래스를 사용하기 위해서는 Intl 확장 기능이 설치되어 있어야 합니다. 

<?php printf('%x', IntlChar::CODEPOINT_MAX); echo IntlChar::charName('@'); var_dump(IntlChar::ispunct('!')); 
?> 

| 내장 함수 | 
string setlocale ( int $category , string $locale [, string $... ] ) 

내장 함수 setlocale()은 로케일 정보를 설정합니다. 

array localeconv ( void ) 

내장 함수 localeconv()는 숫자 형식 정보를 가져옵니다. 

예제 파일 | localeconv.php 
1  <?php  
2  setlocale(LC_ALL, 'nl_NL.UTF-8@euro');  
3  
4  $locale_info = localeconv();  
5  print_r($locale_info);  
6  
7  ?>  

화면 출력 
Array ( [decimal_point] => . [thousands_sep] => [int_curr_symbol] => [currency_ symbol] => [mon_decimal_point] => [mon_thousands_sep] => [positive_sign] => [negative_sign] => [int_frac_digits] => 127 [frac_digits] => 127 [p_cs_ precedes] => 127 [p_sep_by_space] => 127 [n_cs_precedes] => 127 [n_sep_by_ space] => 127 [p_sign_posn] => 127 [n_sign_posn] => 127 [grouping] => Array ( ) [mon_grouping] => Array ( ) ) 

| 내장 함수 | 
string nl_langinfo ( int $item ) 

내장 함수 nl_langinfo()는 쿼리 언어 및 로케일 정보, nl_langinfo()는 locale 카테고리 
의 개별 요소들을 액세스하는 데 이용합니다. 모든 요소를 반환하는 localeconv()와 달 
리 nl_langinfo()는 특정 요소만을 선택할 수 있습니다. 


