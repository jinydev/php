---
layout: php
---

# 변수 삭제
---
캐스팅 방식으로 생성한 변수를 삭제할 수 있습니다.  

예제 파일 casting-01.php
```php
 <?php 
 	echo "casting <br>";

 	$a = "변수를 삭제합니다."; 
 	echo $a."<br>";
 	echo "변수 삭제 = ".(unset)$a; // 결과:  
 ?>
```

결과
```
casting
변수를 삭제합니다.
변수 삭제 = 
```

위의 예제는 변수를 삭제하는 예입니다. 별도의 unset() 함수를 사용하지 않고도 케스팅이라는 간단한 표현으로 생성된 변수를 삭제하고 메모리 해제를 할 수 있습니다.  