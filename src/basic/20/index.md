---
layout: home
---

20 환경 설정
PHP의 동작에 관련한 환경 설정은 php.ini에 의존합니다. php.ini 설정을 통해 PHP의 패키지 설치 및 환경 설정으로 php 실행의 제한을 설정할 수 있습니다.

20.1 정보 출력하기
현재 PHP의 환경 설정 정보를 웹에서 간단하게 확인할 수 있습니다. phpinfo(); 함수는 현재 php의 설정 사항을 웹 화면으로 출력합니다.

예제 파일 phpinfo.php
<?php
	phpinfo();
?>


20.2 php.ini 위치
위의 환경 정보 index.php 를 실행하면 전반적인 PHP 환경 정보를 확인할 수 있습니다. 출력 화면 첫 번째 블록에 보면 php.ini가 설치된 경로를 확인할 수 있습니다.

    


20.2 환경 설정 파일
php.ini는 PHP의 환경 설정 파일입니다. php.ini이 변경되면 서버의 모든 PHP 스크립트 파일에 영향을 주면서 실행하게 됩니다.

PHP 설정 파일은 세미콜론(;)으로 시작하는 행은 주석으로 처리합니다.

또한 설정값은 다음과 같은 형태로 설정합니다.

|설정|
설정 항목 = 값

php.ini 파일은 매우 방대합니다. 보다 자세한 설명은 이 책의 운영 페이지 www.jinyphp.com에서 추가로 설명하겠습니다.

20.2.1 오류 화면 출력
다음 php.ini 내용은 오류 화면 출력을 관리하는 설정입니다.

;   Default Value: On
;   Development Value: On
;   Production Value: Off

Default Value: On 주석을 해제하면 PHP에서 오류가 발생되었을 때 메시지를 화면에 출력합니다. 테스트 중일 때는 쉽게 디버깅을 위해서 켜는 것이 편하겠지만 실제 서비스할 때는 끄는 것이 좋습니다.

20.2.2 파일 업로드 허용
다음 php.ini 내용은 HTML FORM 요소를 통해 파일 업로드가 가능하도록 설정합니다.

file_uploads = On

PHP form 태그를 사용하여 서버로 바이너리 파일을 전송 가능하게 하는 설정입니다. 

upload_max_filesize = 40M

업로드 가능한 최대 파일의 크기를 설정합니다.

max_file_uploads = 20

파일 업로드 전송 시 최대 선택할 수 있는 개수를 설정합니다.
