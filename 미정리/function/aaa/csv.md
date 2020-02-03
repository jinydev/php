jinyPHP 3권 - 07. CSV

07. CSV
====================

CSV 파일은 엑셀등 데이터베이스의 자료들을 서로 주고 받을 때 자주 사용하는 순수 데이터 포맷 파일의 일종입니다. CSV는 데이터를 외부 파일로 출력하고, 외부 데이터를 일괄처리하여 입력 받을 때 많이 사용을 합니다.

07.1 샘플데이터
====================

엑셀 프로그램등을 통하여 작성한 데이터를 CVS 포멧으로 저장을 하면 됩니다. 파일 저장형식을 선택하면 다양한 파일 형식을 선택할 수 있습니다.

 

CSV 파일로 엑셀파일을 저장을 각각의 데이터는 콤마(,)로 구분하여 한 줄에 한개의 레코드 데이터를 저장합니다.

07.2 CSV 쓰기
====================

PHP에서 생성한 데이터를 CSV 형태의 파일로 출력할 수 있습니다. 출력된 CSV 파일은 엑셀등의 응용프로그램에서 읽고, 데이터를 가공할 수 있습니다.

fputcsv() 함수는 입력된 Array 배열을  CSV 형식으로 줄을 만들고 파일 포인터에 씁니다.

|내부함수|
int fputcsv ( resource $handle , array $fields [, string $delimiter = "," [, string $enclosure = '"' [, string $escape_char = "\" ]]] )

fputcsv ()는 필드 배열로 전달 된 행을 CSV로 형식으로 지정합니다. 지정된 파일 핸들에 새 행으로 끝내도록 출력합니다.

예제) csv_write.php
<?php

	$list = array (
    	array(1, "aaa", 18, "Seoul"),
    	array(2, "bbb", 20, "Daejeon"),
    	array(3, "ccc", 30, "Incheon ")
	);

	$csvFile = "sample.csv";

	$fp = fopen($csvFile, 'w');
	if (!is_resource($fp)) {
		die("저장할 파일 포인터를 생성할 수 없습니다.");
	} else {

		// 파일 독점 잠금 설정
		flock($fp,LOCK_EX);

		// 배열을 CSV 파일로 저장
		foreach ($list as $fields) {
    			fputcsv($fp, $fields);
		}

		// 파일잠금 해제
		fflush($fp);
		flock($fp,LOCK_UN);
		
		fclose($fp);
	}
	
?>

지정한 Array 데이터를 sample.csv 파일로 출력을 합니다.

파일내용)
1,aaa,18,Seoul
2,bbb,20,Daejeon
3,ccc,30,"Incheon "


07.3 CSV 읽기
====================

PHP는 CVS 파일의 데이터를 쉽게 읽고 처리하기 위해서 fgetcsv() 함수를 제공합니다. fgetcsv() 함수는 파일 포인터에서 한 줄 단위로 데이터를 읽어와 $delimiter 기호를 기준으로 CSV 필드를 구문 분석합니다.

|내부함수|
array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\" ]]]] )

fgetcsv()가 CSV 형식의 필드에 대해 읽은 행을 구문 분석하고 읽은 필드가 들어있습니다. 배열을 반환한다는 점을 제외하면 fgets()와 비슷한 동작을 수행합니다.

예제) csv_read.php.php
<?php
	$csvFile = "sample.csv";

	// 먼저 CSV 파일 존재 유무를 확인합니다.
	if(!file_exists($csvFile)){
		die("CVS 파일이 존재하지 않습니다.");
	} else {

		// CSV 파일을 읽어옵니다.
		$row = 1;
		if (($fp = fopen($csvFile, "r")) !== FALSE) {
			// CSV 데이터 한줄을 읽어 옵니다.
			$length = 1000;
			$delimiter = ",";
    			while (($data = fgetcsv($fp, $length, $delimiter)) !== FALSE) {
        				$colums = count($data);

        				echo "라인($row): 컬럼수($colums)<br/>";
        				$row++;
        				for ($i=0; $i < $colums; $i++) {
            				echo $data[$i] . "<br />";
        				}
    			}
    			fclose($fp);
		}

	}

?>

화면출력)
라인(1): 컬럼수(4)
1
aaa
18
Seoul
라인(2): 컬럼수(4)
2
bbb
20
Daejeon
라인(3): 컬럼수(4)
3
ccc
30
Incheon 


|내부함수|
array str_getcsv ( string $input [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\\" ]]] )

내부함수 str_getcsv()는 CSV 문자열을 배열로 구문 분석합니다.

예제) str_getcsv.php
<?php

	$csv = array_map('str_getcsv', file('sample.csv'));
	print_r($csv);
?> 

화면출력)
Array ( [0] => Array ( [0] => 1 [1] => aaa [2] => 18 [3] => Seoul ) [1] => Array ( [0] => 2 [1] => bbb [2] => 20 [3] => Daejeon ) [2] => Array ( [0] => 3 [1] => ccc [2] => 30 [3] => Incheon ) ) 



