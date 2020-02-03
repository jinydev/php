
## 03.12 해시 및 암호화 
문자열은 우리가 일반적으로 읽기 쉬운 형태의 문장들입니다. 이러한 문장들은 데이터를 처리하는 데는 매우 편리합니다. 하지만 데이터를 저장하거나 외부로 전송할 때 문장 그 대로 처리하다 보면 보안상 문제가 발생할 수 있습니다. 
기본적으로 문자열을 보안 처리하는 방법으로는 암호화가 있습니다. PHP는 다양한 해시 및 암호화 모듈이 내장되어 있습니다. PHP 환경 설정 부분을 확인해 보면 설치되어 있는 목록을 볼 수 있습니다. 

md2 md4 md5 sha1 sha224 sha256 sha384 sha512/224 sha512/256 sha512 sha3-224 sha3-256 sha3-384 sha3-512 ripemd128 ripemd160 ripemd256 ripemd320 whirlpool tiger128,3 tiger160,3 tiger192,3 tiger128,4 tiger160,4 tiger192,4 snefru snefru256 gost gost-crypto adler32 crc32 crc32b fnv132 fnv1a32 fnv164 fnv1a64 joaat haval128,3 haval160,3 haval192,3 haval224,3 haval256,3 haval128,4 haval160,4 haval192,4 haval224,4 haval256,4 haval128,5 haval160,5 haval192,5 haval224,5 haval256,5 

## 03.12.1 해시 
해시는 가장 기초적인 문자열 암호화 방식입니다. 

| 내장 함수 | 
string hash ( string $algo , string $data [, bool $raw_output = false ] ) 

내장 함수 hash()는 해시값을 생성합니다. 첫 번째 인자 $algo는 알고리즘의 타입을 선 택합니다. 예로 ‘md5’, ‘sha256’, ‘haval160,4’ 등 두 번째 인자인 $data는 해시를 적용할 메시지입니다. 세 번째 인자인 $raw_output은 true일 때는 바이너리 형식, false는 소문 자 hex로 반환합니다. 

예제 파일 | hash.php 
<?php 
2 echo hash('ripemd160', 'hello world php!'); 3 4 ?> 

화면 출력 
271ab7cf2239daa049877e8c6fc73cfc8097d0de 

| 내장 함수 | 
resource hash_init ( string $algo [, int $options = 0 [, string $key = NULL ]] ) 
내장 함수 hash_init()는 추가된 문맥에 대해서 해시를 초기화합니다. 
● 옵션: HASH_HMAC. 지정되면 키를 지정해야 합니다. 
● 키: 옵션 HASH_HMAC가 지정되면 HMAC 해시 메서드와 함께 사용할 공유 비 밀 키를 매개변수로 제공해야 합니다. 

예제 파일 | hash_init.php 
1  <?php  
2  $ctx = hash_init('md5');  
3  hash_update($ctx, 'hello world ');  
4  hash_update($ctx, 'jinyPHP.');  
5  echo hash_final($ctx);  
6  
7  ?>  

화면 출력 
c4009628bfac77c4060e51d14bd417a5 

| 내장 함수 | 
array hash_algos ( void ) 

내장 함수 hash_algos()는 등록된 해시 알고리즘 목록을 반환합니다. 

예제 파일 | hash_algos.php 
1  <?php  
2  print_r(hash_algos());  
3  
4  ?>  

화면 출력 
Array ( [0] => md2 [1] => md4 [2] => md5 [3] => sha1 [4] => sha224 [5] => sha256 [6] => sha384 [7] => sha512/224 [8] => sha512/256 [9] => sha512 [10] => sha3-224 [11] => sha3-256 [12] => sha3-384 [13] => sha3-512 [14] => ripemd128 
[15] => ripemd160 [16] => ripemd256 [17] => ripemd320 [18] => whirlpool [19] => tiger128,3 [20] => tiger160,3 [21] => tiger192,3 [22] => tiger128,4 [23] => tiger160,4 [24] => tiger192,4 [25] => snefru [26] => snefru256 [27] => gost [28] => gost-crypto [29] => adler32 [30] => crc32 [31] => crc32b [32] => fnv132 [33] => fnv1a32 [34] => fnv164 [35] => fnv1a64 [36] => joaat [37] => haval128,3 [38] => haval160,3 [39] => haval192,3 [40] => haval224,3 [41] => haval256,3 [42] => haval128,4 [43] => haval160,4 [44] => haval192,4 [45] => haval224,4 [46] => haval256,4 [47] => haval128,5 [48] => haval160,5 [49] => haval192,5 [50] => haval224,5 [51] => haval256,5 ) 

### 03.12.2 MD5 
내장 함수 md5()는 RFC1321 기준 md5 해시 알고리즘을 제공합니다. 

| 내장 함수 | 
string md5 ( string $str [, bool $raw_output = false ] ) 

예제 파일 | md5.php 
1 <?php 2 $password = "abcd1234"; 3 echo "password = " . $password . "<br>"; 4 5 echo "MD5 = " . md5($password) . "<br>"; 6 echo "MD5 = " . md5($password) . "<br>"; 7 
8 echo "랜덤생성 예 === <br>"; 9 echo "램덤 MD5 = " . md5(mt_rand()) . "<br>"; 
10 11 ?> 

화면 출력 
password = abcd1234 MD5 = e19d5cd5af0378da05f63f891c7467af MD5 = e19d5cd5af0378da05f63f891c7467af 랜덤생성 예 === 램덤 MD5 = bea084f3108d3fa7ce4f6826097e2cd8 

| 내장 함수 | 
string md5_file ( string $filename [, bool $raw_output = false ] ) 

내장 함수 md5_file()은 주어진 파일에 대해서 MD5 해시값을 계산합니다. 

예제 파일 | md5_file.php 
1 2 3 4  <?php $file = 'md5_file.php'; echo 'MD5 file hash of ' . $file . ': ' . md5_file($file);  
5  ?>  

화면 출력 
MD5 file hash of md5_file.php: 25adcad58baa2a626dfa53b98dff0995 

### 03.12.3 crc32 
내장 함수 crc32()는 문자열에 대해서 CRC32 polynomial 계산을 수행합니다. 

| 내장 함수 | 
int crc32 ( string $str ) 

CRC32는 보통 데이터 전송 시 무결성 검증을 위해서 사용합니다. 입력된 문자열 스트링 
의 32비트 순환 중복 검사에 대한 결과를 출력합니다. 

예제 파일 | crc32.php 
1 2 3 4  <?php $checksum = crc32("hello php world"); printf("%u\n", $checksum);  
5  ?>  

화면 출력 
2202403677 

### 03.12.4 sha1 
내장 함수 sha1()은 문자열에 대해서 sha1 해시 계산을 처리합니다. 

| 내장 함수 | 
string sha1 ( string $str [, bool $raw_output = false ] ) 

raw_output이 true인 경우에는 길이가 20인 원시 바이너리 형식을 반환합니다. false인 경우에는 40문자 16진수를 반환합니다. 

예제 파일 | sha1.php 
1 2 3  <?php $str = 'apple';  
4 5 6  // 40문자 16진수 echo $str ." = ". sha1($str). "<br>";  
7 8 9  // 길이가 20인 원시 바이너리 형식 echo $str ." = ". sha1($str,true). "<br>"; ?>  

apple = d0be2dc421be4fcd0172e5afceea3970e2f3d940 apple = о-◆!◆O◆r◆◆◆◆9p◆◆◆@ 

| 내장 함수 | 
string sha1_file ( string $filename [, bool $raw_output = false ] ) 

내장 함수 sha1_file()은 주어진 파일에 대해서 SHA1 해시를 계산합니다. 

예제 파일 | sha1_file.php 
1 2  <?php  
3 4 5 6 7  foreach(glob('*.exe') as $ent) { if (is_dir($ent)) { continue;  
8 9  }  
10 11 12  }  echo $ent . ' = (SHA1: ' . sha1_file($ent) . ')' . "<br>";  
13  ?>  

화면 출력 
deplister.exe = (SHA1: 5aeb27623d25d042e101bb64ca011308cf2aa785) php-cgi.exe = (SHA1: 5cdb18117c91de9db5616c8141456dff63dc4a75) php-win.exe = (SHA1: 342aa529b6bf06b34e15ee7d3fef4dc87ee6199c) php.exe = (SHA1: aeee36515446efd8ca4fccddc5e7b277f0fb217c) phpdbg.exe = (SHA1: b1af4e81d2a146d9e3bd047c2a44b06b65999034) 

### 03.12.5 crypt 
내장 함수 crypt() 함수는 표준 유닉스 DES 형태로 단방향 암호화된 문자열을 반환합 
니다. 

| 내장 함수 | 
string crypt ( string $str [, string $salt ] ) 

운영체제별로 암호화 방식은 약간씩 다른데, MD5로 대체하여 처리하기도 합니다. 암호 화 작업 시 기본 문자열 이외에 암호키(salt)를 사용할 수 있습니다. 

예제 파일 | crypt.php 
1 <?php 2 3 $password = "ABCD1234"; 4 echo "암호 = " . $password . "<br>"; 5 6 // salt 자동 생성 7 echo "DES 기반 암호 =" .crypt('ABCD1234') . "<br>"; 
8 9 // 사용자 salt 10 $salt = "복잡한 암호키입니다."; 11 echo "DES 기반 암호 =" .crypt('ABCD1234',$salt) . "<br>"; 
12 13 ?> 

화면 출력 
암호 = ABCD1234 DES 기반 암호 =$1$Lhg1VRxu$bLQyHdT/Cja/XbSgiNgGq. DES 기반 암호 =◆◆mEIN4PXgIk. 

### 03.12.6 str_rot13
---
내장 함수 ROT13(Rotate by 13)은 카이사르 암호 형식입니다. 알파벳에 13을 밀어서 표 
기를 합니다. 즉 A 문자는 13을 더한 N 문자로 표기합니다. str_rot13() 함수는 입력된 
문자열에 대해서 ROT13 암호화 작업을 수행합니다. 

string str_rot13 ( string $str ) 

예제 파일 | str_rot13.php 
1 <?php 2 echo str_rot13('PHP 4.3.0'); // CUC 4.3.0 3 4 ?> 

화면 출력 
CUC 4.3.0 