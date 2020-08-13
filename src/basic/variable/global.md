---
layout: php
---

# 자동 전역변수
---
자동 전역변수는 phpinfo() 함수를 통해 확인할 수 있습니다.  

예제 파일 info-02.php
```php
 <?php 
 	echo "casting <br>";

 	$a = "변수를 삭제합니다."; 
 	echo $a."<br>";
 	echo "변수 삭제 = ".(unset)$a; // 결과:  
 ?>
```

화면 출력
```
``` 

자동 전역변수는 PHP에서 미리 설정되어 있는 변수입니다. 하지만 전역변수들은 서버의 정보를 포함한 보완적인 민감한 내용도 같이 출력됩니다.  

PHP 4.2.0 이후부터는 환경 설정 파일 php.ini에서 register_global 값을 기본 off로 설정합니다.  

<br><br>