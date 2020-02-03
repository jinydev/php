
내부함수 strftime() 함수는 현재의 시간과 날짜를 지정한 타입으로 변환하여 출력합니다.

|내부함수|
string strftime ( string $format [, int $timestamp = time() ] )

포맷기호:
	% a 일요일부터 토요일까지의 약식 텍스트 표현
	% A 일요일부터 토요일까지의 전체 텍스트 표현
	% d 두 자리 날짜 (맨 앞에 0이 붙음) 01 – 31
	% e 달의 한 자리이며 한 자리 앞의 공백이 있습니다. 
	% j 일, 001에서 366 사이의 0을 시작하는 3 자리 숫자
	% u ISO-8601 요일의 숫자 표현 1 (월요일) ~ 7 (일요일)
	% w 요일의 숫자 표현 0 (일요일 기준) ~ 6 (토요일 기준)

주간 표시:
	% U 첫 번째 일요일을 첫 번째 주로 시작하는 해당 연도의 주 번호 13 (해당 연도의 13 번째 주 전체)
	% V ISO-8601 : 주어진 주를 1988 년 주 숫자로, 첫 주부터 시작하여 주 4 일 이상, 월요일은 주 01 ~ 53 주 (여기서 겹치는 주가는 53 일입니다)
	% W 첫 번째 월요일을 첫 번째 주로 시작하는 숫자의 주 표시입니다. 46 (월요일로 시작하는 연도의 46 번째 주)

날짜표시:
	% b 1 월에서 12 월까지 로컬을 기반으로 한 약식 월 이름
	% B 1 월에서 12 월까지의 로컬을 기반으로 한 전체의 월 이름
	% h 로케일 (% b의 별칭)을 기준으로 한 약식 월 이름 1 월에서 12 월까지
	% m 이달의 두 자리 표현 01 (1 월분) ~ 12 (12 월분)

년도 표시:
	% C 세기의 두 자리 표현 
	% g ISO-8601 : 1988 표준 (% V 참조)에 의한 연도의 두 자리 표시 
	% G 전체 네 자리 버전의 % g 
	% y 연도의 두 자릿수 표현 
	% Y 연도에 대한 네 자리 표시 

시간:
	% H 24 시간제 형식의 시를 00 자리에서 23 자리로 두 자리로 표시합니다.
	% k 24 시간 형식의 시간 (한 자리 앞의 공백은 0에서 23까지)
	% I 12 자리 형식의 두 자리 표시 01 – 12
	% l (소문자 'L') 시간은 12 시간 형식이며 한 자리 숫자는 1에서 12 사이입니다
	% M 분 표시 두자리 수 00 – 59
	% p 대문자 'AM'또는 'PM'(예 : 00:31 AM, 22:23 PM)
	% P 소문자 'am'또는 'pm'(예 : 00:31, 22:23)
	% r "% I : % M : % S % p"와 동일 예 : 09:34:17 오후 21:34:17
	% R "% H : % M"과 같습니다. 예 : 오전 12시 35 분 00:35, 오후 4:44 16:44
	% S 두 번째 00에서 59 사이의 두 자리 표시
	% T "% H : % M : % S"와 동일 예 : 오후 9:34:17의 경우 21:34:17
	% X 날짜가없는 로케일 기반의 선호 시간 표현 예 : 03:59:16 또는 15:59:16
	% z 시간대 오프셋입니다.
	% Z 시간대 약어입니다. 

시간 및 일자:
	%c 로케일에 따른 선호 날짜 및 시간 스탬프 (예 : 2 월 5 일 화요일 00:45:10 2009 년 2 월 5 일 12:45:10 AM)
	% D "% m / % d / % y"와 동일 예 : 2009 년 2 월 5 일 02/05/09
	% F "% Y- % m- % d"와 동일합니다 (예 : 2009-02-05, 2009 년 2 월 5 일)
	% s Unix Epoch 시간 타임 스탬프 (예 : 1979 년 9 월 10 일 305815200 08:40:00 AM)
	% x 로케일에 기초한 선호 날짜 표현, 시간 없음 (예 : 02/05/09 for February 5, 2009)

그외 포맷처리:
	% n 개행 문자 ( "\ n")
	% t 탭 문자 ( "\ t")
	%% 리터럴 퍼센트 문자 ( "%")

예제파일) strftime.php
<?php

	echo "축약된 요일이름 = ". strftime("%a") ."<br>";
	echo "요일이름 = ". strftime("%A") ."<br>";
	echo "날짜(10진수) = ". strftime("%d") ."<br>";

	echo "Day of the month, with a space preceding single digits. Not implemented as described on Windows. See below for more information. = ". strftime("%e") ."<br>";

	echo "Day of the year, 3 digits with leading zeros = ". strftime("%j") ."<br>";
	echo "ISO-8601 numeric representation of the day of the week = ". strftime("%u") ."<br>";
	echo "Numeric representation of the day of the week = ". strftime("%w") ."<br>";

	echo "Week number of the given year, starting with the first Sunday as the first week = ". strftime("%U") ."<br>";
	echo "ISO-8601:1988 week number of the given year, starting with the first week of the year with at least 4 weekdays, with Monday being the start of the week	01 through 53 = ". strftime("%V") ."<br>";

	echo "A numeric representation of the week of the year, starting with the first Monday as the first week	46 (for the 46th week of the year beginning with a Monday) = ". strftime("%W") ."<br>";

	echo "Abbreviated month name, based on the locale = ". strftime("%b") ."<br>";
	echo "Full month name, based on the locale = ". strftime("%B") ."<br>";
	echo "Abbreviated month name, based on the locale (an alias of %b) = ". strftime("%h") ."<br>";
	echo "Two digit representation of the month = ". strftime("%m") ."<br>";
	echo "Two digit representation of the century (year divided by 100, truncated to an integer) = ". strftime("%C") ."<br>";
	echo "Two digit representation of the year going by ISO-8601:1988 standards (see %V) = ". strftime("%g") ."<br>";
	echo "The full four-digit version of %g = ". strftime("%G") ."<br>";

	echo "Two digit representation of the year = ". strftime("%y") ."<br>";
	echo "Four digit representation for the year = ". strftime("%Y") ."<br>";
	echo "Two digit representation of the hour in 24-hour format = ". strftime("%H") ."<br>";
	echo "Hour in 24-hour format, with a space preceding single digits = ". strftime("%k") ."<br>";
	echo "Two digit representation of the hour in 12-hour format = ". strftime("%I") ."<br>";
	echo "Hour in 12-hour format, with a space preceding single digits = ". strftime("%l") ."<br>";
	echo "Two digit representation of the minute = ". strftime("%M") ."<br>";
	echo "UPPER-CASE 'AM' or 'PM' based on the given time = ". strftime("%P") ."<br>";
	echo "lower-case 'am' or 'pm' based on the given time = ". strftime("%p") ."<br>";
	
	echo "Same as %I:%M:%S %p = ". strftime("%r") ."<br>";
	echo "Same as %H:%M = ". strftime("%R") ."<br>";
	echo "Two digit representation of the second = ". strftime("%S") ."<br>";
	echo "Same as %H:%M:%S = ". strftime("%T") ."<br>";
	echo "Preferred time representation based on locale, without the date = ". strftime("%X") ."<br>";
	echo "The time zone offset. Not implemented as described on Windows. See below for more information. = ". strftime("%z") ."<br>";
	echo "The time zone abbreviation. Not implemented as described on Windows. See below for more information. = ". strftime("%Z") ."<br>";
	
	echo "Preferred date and time stamp based on locale = ". strftime("%c") ."<br>";
	echo "Same as %m/%d/%y = ". strftime("%D") ."<br>";
	echo "Same as %Y-%m-%d (commonly used in database datestamps) = ". strftime("%F") ."<br>";
	echo "Unix Epoch Time timestamp (same as the time() function) = ". strftime("%s") ."<br>";
	
	echo "Preferred date representation based on locale, without the time = ". strftime("%x") ."<br>";
	echo "A newline character = ". strftime("%n") ."<br>";
	echo "A Tab character = ". strftime("%t") ."<br>";
	echo "A literal percentage character = ". strftime("%%") ."<br>";

?>

화면출력)
축약된 요일이름 = Sun
요일이름 = Sunday
날짜(10진수) = 18
Day of the month, with a space preceding single digits. Not implemented as described on Windows. See below for more information. = 18
Day of the year, 3 digits with leading zeros = 169
ISO-8601 numeric representation of the day of the week = 7
Numeric representation of the day of the week = 0
Week number of the given year, starting with the first Sunday as the first week = 25
ISO-8601:1988 week number of the given year, starting with the first week of the year with at least 4 weekdays, with Monday being the start of the week	01 through 53 = 24
A numeric representation of the week of the year, starting with the first Monday as the first week	46 (for the 46th week of the year beginning with a Monday) = 24
Abbreviated month name, based on the locale = Jun
Full month name, based on the locale = June
Abbreviated month name, based on the locale (an alias of %b) = Jun
Two digit representation of the month = 06
Two digit representation of the century (year divided by 100, truncated to an integer) = 20
Two digit representation of the year going by ISO-8601:1988 standards (see %V) = 17
The full four-digit version of %g = 2017
Two digit representation of the year = 17
Four digit representation for the year = 2017
Two digit representation of the hour in 24-hour format = 07
Hour in 24-hour format, with a space preceding single digits =
Two digit representation of the hour in 12-hour format = 07
Hour in 12-hour format, with a space preceding single digits =
Two digit representation of the minute = 02
UPPER-CASE 'AM' or 'PM' based on the given time =
lower-case 'am' or 'pm' based on the given time = AM
Same as %I:%M:%S %p = 07:02:32 AM
Same as %H:%M = 07:02
Two digit representation of the second = 32
Same as %H:%M:%S = 07:02:32
Preferred time representation based on locale, without the date = 07:02:32
The time zone offset. Not implemented as described on Windows. See below for more information. = +0900
The time zone abbreviation. Not implemented as described on Windows. See below for more information. = ���ѹα� ǥ�ؽ�
Preferred date and time stamp based on locale = Sun Jun 18 07:02:32 2017
Same as %m/%d/%y = 06/18/17
Same as %Y-%m-%d (commonly used in database datestamps) = 2017-06-18
Unix Epoch Time timestamp (same as the time() function) =
Preferred date representation based on locale, without the time = 06/18/17
A newline character =
A Tab character = 	
A literal percentage character = %