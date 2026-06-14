---
layout: php
title: "자동 전역변수 (Superglobals)"
description: "PHP에서 스코프에 상관없이 항상 전역적으로 접근할 수 있는 자동 전역변수(Superglobals)의 개념과 특징을 알아봅니다."
keyword: "php 자동 전역변수, php superglobals, register_globals, phpinfo"
breadcrumb:
- syntax
- variable
- global
---

# 자동 전역변수
---

<div style="text-align: center; margin: 30px 0;">
  <img src="img/global_concept_cartoon.png" alt="Superglobals Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: PHP 어디서나 사전 동의 없이 접근 가능한 자동 전역변수(Superglobals)들의 모습</p>
</div>

자동 전역변수는 phpinfo() 함수를 통해 확인할 수 있습니다.  

예제 파일 info-02.php
{% raw %}
```php
 <?php 
 	echo "casting <br>";

 	$a = "변수를 삭제합니다."; 
 	echo $a."<br>";
 	echo "변수 삭제 = ".(unset)$a; // 결과:  
 ?>
```
{% endraw %}

화면 출력
{% raw %}
```
``` 
{% endraw %}

자동 전역변수는 PHP에서 미리 설정되어 있는 변수입니다. 하지만 전역변수들은 서버의 정보를 포함한 보완적인 민감한 내용도 같이 출력됩니다.  

PHP 4.2.0 이후부터는 환경 설정 파일 php.ini에서 register_global 값을 기본 off로 설정합니다.  

<br>