---
layout: default
title: PHP BOOK
subtitle: numphp

tree: /php
---

# 5.8 상수 존재 여부 확인
---
> `넘버 PHP 1권` 보충정리 내용입니다. 원문은 도서를 참고해 주시길 바랍니다.

상수명은 중복하여 사용할 수 없습니다. 상수의 중복 사용을 방지하기 위해 또는 상수값 참조 오류를 방지하기 위해 기존 상수값이 선언되었는지 확인이필요합니다. 

PHP는 내부의 상수값이 존재하는지 확인할 수 있는 defined() 내부 함수를 제공합니다. defined() 함수는내부의 상수 목록에서 입력한 상수의 값이 존재하는지 여부를 논리값으로 결과를 반환합니다. 

|관련함수|
```
bool defined ( string $name )
```
defined("상수명")을 입력하면상수 존재 여부를 true 또는 false 형태의 논리값으로결과를 반환합니다.

예제 파일 defined.php
```
<?php
	if (defined('TEST')) {
    	            echo "상수가 존재합니다.";
	} else {
		echo "상수가 없습니다.";
	}
?> 
```

<br><br> 