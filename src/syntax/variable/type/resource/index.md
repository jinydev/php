---
layout: php
title: "리소스 (Resource) 자료형"
description: "PHP 외부의 파일 핸들러나 데이터베이스 커넥션 등의 외부 시스템 자원을 가리키는 특수 포인터 자료형인 리소스(Resource)의 기본 개념과 확인 방법을 배웁니다."
keyword: "php 리소스, php resource, 외부 자원, get_resource_type"
breadcrumb:
- syntax
- variable
- type
- resource
---

# 리소스(Resource)
---
리소스(Resource)는 PHP 내부에서 직접 데이터를 갖고 있는 일반적인 자료형이 아닙니다. 파일 열기(`fopen`), 데이터베이스 연결 등 PHP 외부의 하드웨어나 데이터베이스 자원, 운영체제 리소스를 가리키는 특수 '포인터/핸들(Handle)' 역할을 하는 특별한 변수 타입입니다.

<div style="text-align: center; margin: 30px 0;">
  <img src="img/resource_concept_cartoon.png" alt="Resource Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 리모컨(Resource Handle)을 통해 외부에 있는 파일 금고나 데이터베이스 서버(External Resources)를 제어하는 원리</p>
</div>

<br>
## 리소스 확인
---
get_resource_type() 내부 함수를 이용하면 리소스 타입을 확인할 수 있습니다.  

|관련함수|
{% raw %}
```
string get_resource_type ( resource $handle )
```
{% endraw %}

예제 파일 resource-01.php
{% raw %}
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
{% endraw %}

<br>