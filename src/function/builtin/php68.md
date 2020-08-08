---
layout: php
title: "PHP"
keyword: "jinyphp, php"
---

19. 정보
====================

PHP는 내부함수들을 통하여 PHP의 버전 및 설정 상태등의 다양한 정보를 읽어서 처리할 수 있습니다.

19.1 시스템
====================

내부함수 phpversion()는 현재 PHP 버전을 가져옵니다.

|내부함수|
string phpversion ([ string $extension ] )

예제) phpversion.php
<?php
	echo phpversion();
?>

화면출력)
7.1.4

|내부함수|
mixed version_compare ( string $version1 , string $version2 [, string $operator ] )

내부함수 version_compare()는 두 개의 PHP 버전 번호를 비교합니다.

예제) version_compare.php
<?php
if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
    echo 'I am at least PHP version 7.0.0, my version: ' . PHP_VERSION . "<br>";
}

if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
    echo 'I am at least PHP version 5.3.0, my version: ' . PHP_VERSION . "<br>";
}

?>

화면출력)
I am at least PHP version 7.0.0, my version: 7.1.4
I am at least PHP version 5.3.0, my version: 7.1.4

|내부함수|
string zend_version ( void )

내부함수 zend_version()는 Zend 엔진의 버전을 가져옵니다.

예제) zend_version.php
<?php
	echo "Zend engine version: " . zend_version();
?>

화면출력)
Zend engine version: 3.1.0

|내부함수|
int zend_thread_id ( void )

내부함수 zend_thread_id()는 현재 스레드의 고유 Id를 반환합니다. 이 함수는 PHP가 ZTS (Zend Thread Safety) 지원 및 디버그 모드 (--enable-debug)로 빌드 된 경우에만 사용할 수 있습니다.

예제) zend_thread_id.php
<?php
	$thread_id = zend_thread_id();
	echo 'Current thread id is: ' . $thread_id;
?>

|내부함수|
string php_uname ([ string $mode = "a" ] )

내부함수 php_uname()는 PHP가 실행되는 운영 체제 정보를 반환합니다.

예제) php_uname.php
<?php
	echo php_uname() ."<br>";
	echo PHP_OS;
?>

화면출력)
Windows NT LAPTOP-M0820HEF 10.0 build 15063 (Windows 10) i586
WINNT


19.2 정보함수
====================

PHP 환경설정과 정보들을 내부함수를 통하여 읽어올 수 있습니다.

|내부함수|
bool phpinfo ([ int $what = INFO_ALL ] )

내부함수 phpinfo()는 PHP의 설정에 관한 정보 출력합니다 전반적인 PHP의 설치환경 정보를 웹페이지를 통하여 출력할 수 있습니다. 또는, 지정 모듈만 선택하여 출력을 할 수도 있습니다.

	INFO_GENERAL
	INFO_CREDITS
	INFO_CONFIGURATION
	INFO_MODULES
	INFO_ENVIRONMENT
	INFO_VARIABLES
	INFO_LICENSE
	INFO_ALL

예제) phpinfo.php
<?php

	// 전체 정보를 출력합니다.
	phpinfo();

	// 지정한 모듈 정보만 출력합니다.
	phpinfo(INFO_MODULES);

?>

|내부함수|
string get_cfg_var ( string $option )

내부함수 get_cfg_var()는 PHP의 설정 옵션 값을 확인할 수 있습니다. 

get_cfg_var() 함수는 컴파일하여 PHP를 설치를 하였을 때 또는 아파치등의 웹서버에서 정보를 읽어 참조하였을 때는 값을 반환하지 않습니다.

예제) get_cfg_var.php
<?php
	// php.ini 값을 확인 합니다.
	echo "SMTP Server = ". get_cfg_var("SMTP") ."<br>";
	echo "SMTP Server = ". get_cfg_var("smtp_port") ."<br>";
?>

화면출력)
SMTP Server = localhost
SMTP Server = 25

|내부함수|
string getenv ( string $varname )

내부함수 getenv()는 환경변수 값을 읽어 올 수 있습니다.

예제) getenv.php
<?php
	$ip = getenv('REMOTE_ADDR');
	echo "접속주소 : $ip <br>";

	// 글로벌 환경 변수 값을 통하여도 읽어 올 수 있습니다.
	$ipAddr = $_SERVER['REMOTE_ADDR'];
	echo "접속주소 : $ipAddr <br>";
?>

|내부함수|
bool putenv ( string $setting )

내부함수 putenv()는 환경변수 값을 설정합니다.

예제) putenv.php
<?php
	print "env is: ".$_ENV["USER"]."<br>";

	putenv("USER=jiny");
	print "getenv is: ".getenv("USER")."<br>";

?>

화면출력)
env is:
getenv is: jiny


19.3 ini
====================

PHP의 환경 설정파일 ini에 대한 정보을 읽거나 설정을 할 수 있습니다. 이와 관련된 몇 개의 내부함수들을 제공합니다.

|내부함수|
string ini_get ( string $varname )

내부함수 ini_get()는 구성 옵션의 값을 가져옵니다.

예제) ini_get.php
<?php
	echo 'display_errors = ' . ini_get('display_errors') . "<br>";
	echo 'register_globals = ' . ini_get('register_globals') . "<br>";
	echo 'post_max_size = ' . ini_get('post_max_size') . "<br>";
	echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) . "<br>";
	echo 'post_max_size in bytes = ' . ini_get('post_max_size');
?>

화면출력)
display_errors =
register_globals =
post_max_size = 8M
post_max_size+1 = 9
post_max_size in bytes = 8M

|내부함수|
array ini_get_all ([ string $extension [, bool $details = true ]] )

내부함수 ini_get_all()는 모든 구성 옵션을 가져옵니다.

예제) ini_get_all.php
<?php
	print_r(ini_get_all("pcre"));
	print_r(ini_get_all());
?>


|내부함수|
string ini_set ( string $varname , string $newvalue )

내부함수 ini_set()는 구성 옵션의 값을 설정합니다.

예제) ini_set.php
<?php
	echo ini_get('display_errors');

	if (!ini_get('display_errors')) {
    	ini_set('display_errors', '1');
	}

	echo ini_get('display_errors');
?>

화면출력)
1

|내부함수|
void ini_restore ( string $varname )

내부함수 ini_restore()는 구성 옵션의 값을 복원합니다.

예제) ini_restore.php
<?php
	$setting = 'y2k_compliance';

	echo 'Current value for \'' . $setting . '\': ' . ini_get($setting), "<br>";

	ini_set($setting, ini_get($setting) ? 0 : 1);
	echo 'New value for \'' . $setting . '\': ' . ini_get($setting), "<br>";

	ini_restore($setting);
	echo 'Original value for \'' . $setting . '\': ' . ini_get($setting), "<br>";
?>

화면출력)
Current value for 'y2k_compliance':
New value for 'y2k_compliance':
Original value for 'y2k_compliance': 

|내부함수|
string php_ini_loaded_file ( void )

내부함수 php_ini_loaded_file()는 php.ini 파일의 경로 검색합니다.

예제) php_ini_loaded_file.php
<?php
	$inipath = php_ini_loaded_file();

	if ($inipath) {
    	echo 'Loaded php.ini: ' . $inipath;
	} else {
    	echo 'A php.ini file is not loaded';
	}
?>

화면출력)
Loaded php.ini: C:\php-7.1.4-Win32-VC14-x86\php.ini

|내부함수|
string php_ini_scanned_files ( void )

내부함수 php_ini_scanned_files()는 ini 디렉토리에서 파싱 된 .ini 파일 목록을 반환합니다.


19.4 프로세스
====================
PHP가 동작되는 프로세스에 대한 정보와 처리를 할 수 있습니다. 이와 관련된 몇 개의 내부함수들을 제공합니다.

|내부함수|
string cli_get_process_title ( void )

내부함수 cli_get_process_title()는 현재 프로세스 제목을 반환합니다.

예제) cli_get_process_title.php
<?php
echo "Process title: " . cli_get_process_title() . "\n";
?>

화면출력)
Process title: 명령 프롬프트 - php -S localhost:8000 

|내부함수|
bool cli_set_process_title ( string $title )

내부함수 cli_set_process_title()는 프로세스 제목을 설정합니다.

예제) cli_set_process_title.php
<?php
	$title = "jiny PHP Script";

	cli_set_process_title($title);
	echo "Process title: " . cli_get_process_title() . "\n";
?>

화면출력)
Process title: jiny PHP Script 

|내부함수|
int getmypid ( void )

내부함수 getmypid()는 현재 PHP의 프로세스 ID를 확인할 수 있습니다.

예제) getmypid.php
<?php
	echo getmypid();
?>

화면출력)
3868

|내부함수|
int getmyuid ( void )

내부함수 getmyuid()는 현재 PHP의 UID를 확인할 수 있습니다.

예제) getmyuid.php
<?php
	echo getmyuid();
?>

|내부함수|
int getmyinode ( void )

내부함수 getmyinode()는 현재 스크립트의 inode값을 구합니다. inode는 유닉스 계통에서 사용하는 자료 구조 입니다. 각각의 파일은 1개의 inode값을 가지고 있습니다.

예제) getmyinode.php
<?php
	echo getmyinode();
?>

|내부함수|
string uniqid ([ string $prefix = "" [, bool $more_entropy = false ]] )

내부함수 uniqid()는 고유 ID를 생성합니다. 마이크로 세컨드 단위로 현재 시각에 따라 접두사를 포함한 식별자를 생성합니다.

예제) uniqid.php
<?php
	// 고유 ID값을 생성합니다.
	printf("uniqid(): %s <br>", uniqid());

	// 접두사를 붙여서 고유 ID값을 생성하빈다.
	$prefix = "php_";
	printf("uniqid('$prefix'): %s <br>", uniqid($prefix));

	// more_entropy
	printf("uniqid('', true): %s <br>", uniqid('', true));
?>

화면출력)
uniqid(): 599934c16f714
uniqid('php_'): php_599934c16f71a
uniqid('', true): 599934c16f71b2.39586057 


19.5 리소스
====================

PHP 동작상태에 대한 메모리등 리소스등을 확인할 수 있습니다. 이와 관련된 몇 개의 내부함수를 제공합니다.

|내부함수|
array get_resources ([ string $type ] )

내부함수 get_resources()는 활성화된 리소스를 반환합니다.

예제) get_resources.php
<?php
	$fp = tmpfile();
	var_dump(get_resources());
?>

화면출력)
array(1) { [2]=> resource(2) of type (stream) } 


|내부함수|
array getrusage ([ int $who = 0 ] )

내부함수 getrusage()는 현재 리소스 사용량을 가지고 옵니다.

예제) getrusage.php
<?php
	$dat = getrusage();
	print_r($dat);
?>

화면출력)
Array ( [ru_majflt] => 3686 [ru_maxrss] => 12852 [ru_utime.tv_usec] => 31250 [ru_utime.tv_sec] => 0 [ru_stime.tv_usec] => 78125 [ru_stime.tv_sec] => 0 ) 

|내부함수|
int memory_get_usage ([ bool $real_usage = false ] )

내부함수 memory_get_usage()는 PHP에 할당 된 메모리 양을 반환합니다.

예제) memory_get_usage.php
<?php
	// 시작전 메모리
	echo memory_get_usage() . "<br>";

	// 메모리 할당 
	$a = str_repeat("Hello", 4242);
	echo memory_get_usage() . "<br>";

	// 메모리 해제
	unset($a);
	echo memory_get_usage() . "<br>";
	
?>

화면출력)
344128
368704
344128

|내부함수|
int memory_get_peak_usage ([ bool $real_usage = false ] )

내부함수 memory_get_peak_usage()는 PHP가 할당 한 메모리 피크치를 반환합니다.


19.6 include
====================

내부함수 get_included_files()는 include 또는 require 파일의 이름을 가진 배열을 반환합니다.

|내부함수|
array get_included_files ( void )

예제) get_included_files.php
<?php

	include 'test1.php';
	include_once 'test2.php';
	require 'test3.php';
	require_once 'test4.php';

	$included_files = get_included_files();

	foreach ($included_files as $filename) {
    	echo "$filename\n";
	}

?>

|내부함수|
string set_include_path ( string $new_include_path )

내부함수 set_include_path()는 include_path 구성 옵션을 설정합니다.

예제) set_include_path.php
<?php
	set_include_path('/usr/lib/pear');

	// 또는 ini_set()를 사용할 수도 있습니다.
	ini_set('include_path', '/usr/lib/pear');
?>

|내부함수|
void restore_include_path ( void )

내부함수 restore_include_path()는 include_path 구성 옵션의 값을 복원합니다.

예제) restore_include_path.php
<?php

	echo get_include_path();  
	set_include_path('/inc');

	echo get_include_path(); 
	restore_include_path();

?>

|내부함수|
string get_include_path ( void )

내부함수 get_include_path()는 현재 include_path 구성 옵션을 가져옵니다.

예제) get_include_path.php
<?php
	echo get_include_path();
	echo ini_get('include_path');
?>


19.7 extention
====================

내장함수 extension_loaded()를 확장 프로그램이 로드 되었는지 확인합니다. 콘솔상에서 php -m 옵션을 통하여 설치된 모든 확장 모듈을 확인해 볼 수 있습니다.

|내부함수|
bool extension_loaded ( string $name )

예제) extension_loaded.php
<?php
	if (extension_loaded('curl')) {
    	echo "모듈 설치됨";
	} else {
		echo "모듈이 설치되지 않았습니다.";
	}
?>

화면출력)
모듈 설치됨

|내부함수|
array get_loaded_extensions ([ bool $zend_extensions = false ] )

내부함수 get_loaded_extensions()를 컴파일된 모든 모듈명을 배열로 반환합니다.

예제) get_loaded_extension.php
<?php
	print_r(get_loaded_extensions());
?>

화면출력)
Array ( [0] => Core [1] => bcmath [2] => calendar [3] => ctype [4] => date [5] => filter [6] => hash [7] => iconv [8] => json [9] => mcrypt [10] => SPL [11] => pcre [12] => readline [13] => Reflection [14] => session [15] => standard [16] => mysqlnd [17] => tokenizer [18] => zip [19] => zlib [20] => libxml [21] => dom [22] => PDO [23] => Phar [24] => SimpleXML [25] => xml [26] => wddx [27] => xmlreader [28] => xmlwriter [29] => cli_server [30] => curl ) 

|내부함수|
array get_extension_funcs ( string $module_name )

내부함수 get_extension_funcs()는 모듈의 함수 이름을 가진 배열을 반환합니다.

예제) get_extension_funcs.php
<?php
	print_r(get_extension_funcs("xml"));
?>


19.8 그외
====================

|내부함수|
string php_sapi_name ( void )

내부함수 php_sapi_name()는 웹 서버와 PHP 사이의 인터페이스 유형을 반환합니다.

예제) php_sapi_name.php
<?php
	$sapi_type = php_sapi_name();
	echo $sapi_type;
?>

화면출력)
cli-server

|내부함수|
array getopt ( string $options [, array $longopts [, int &$optind ]] )

내부함수 getopt ()는 콘솔상에서 명령 행 인수 목록 옵션을 가지고 옵니다. 콘솔모드를 이용한 응용프로그램을 개발할 때 인수 분석용으로 매우 유용합니다.

예제) getopt.php
<?php
	$options = getopt("f:hp:");
	var_dump($options);
?>

출력)
C:\php-7.1.4-Win32-VC14-x86>php getopt.php -fvalue -h
array(2) {
  ["f"]=>
  string(5) "value"
  ["h"]=>
  bool(false)
}

|내부함수|
array get_defined_constants ([ bool $categorize = false ] )

내부함수 get_defined_constants()는 정의된 모든 상수를 이름과 값을 가진 연관 배열 형태로 반환합니다.

예제) get_defined_constants.php
<?php
	print_r(get_defined_constants());
?>

|내부함수|
bool get_magic_quotes_gpc ( void )

내부함수 get_magic_quotes_gpc()는 자동 따옴표 기능 활성화 상태를 체크할 수 있습니다.

예제) get_magic_quotes_gpc.php
<?php
	if(get_magic_quotes_gpc()){
		echo "자동 따옴표 기능 활성화";
	} else {
		echo "자동 따옴표 기능 비활성화";
	}
?>

화면출력)
자동 따옴표 기능 비활성화

|내부함수|
bool phpcredits ([ int $flag = CREDITS_ALL ] )

내부함수 phpcredits()는 PHP에 대한 크레딧을 출력합니다.

예제) phpcredits.php
<?php
	phpcredits(CREDITS_GENERAL);
?>

<br><br>