---
layout: php
breadcrumb:
- "basic"
- "variable"
---

# 리소스(Resource)
---
특별한 유형의 리소스 타입은 실제적인 데이터 타입이 아닙니다. 리스트 타입은 함수를 참조하거나 외부 PHP 리소스를 참조할 수 있습니다.  

일반적으로 리소스 데이터 타입은 데이터 베이스를 호출할 때 많이 사용합니다.  

<br>


## 리소스 확인
---
get_resource_type() 내부 함수를 이용하면 리소스 타입을 확인할 수 있습니다.  

|관련함수|
```
string get_resource_type ( resource $handle )
```

예제 파일 resource-01.php
```
<?php
// prints: mysql link
$c = mysql_connect();
echo get_resource_type($c) . "\n";

// prints: stream
$fp = fopen("foo", "w");
echo get_resource_type($fp) . "\n";

// prints: domxml document
$doc = new_xmldoc("1.0");
echo get_resource_type($doc->doc) . "\n";
?> 
```

<br>