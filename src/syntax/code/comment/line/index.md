---
layout: php
title: "한 줄 주석 (Single-line Comment)"
description: "PHP에서 단일 행을 주석으로 처리하는 방법인 // 와 # 기호의 사용법 및 특징을 학습합니다."
keyword: "php 한줄 주석, php single-line comment, php 주석 기호"
breadcrumb:
- syntax
- code
- comment
- line
---

# 한 줄 주석 (Single-line Comment)
---

<div style="text-align: center; margin: 30px 0;">
  <img src="img/line_comment_cartoon.png" alt="Single-line Comment Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 특정 줄 앞에 // 기호를 사용하여 해당 줄의 코드를 실행에서 배제(Zzz...)시키는 한 줄 주석의 역할</p>
</div>

한 줄 주석 처리는 프로그램 소스 상에서 오직 **한 줄(단일 행)만** 주석으로 처리하고자 할 때 사용합니다. 

PHP에서는 한 줄 주석 처리를 위해 두 가지 기호를 사용할 수 있습니다.
1. `//` (슬래시 두 번) - C/C++, Java 등에서 사용하는 표준 스타일
2. `#` (해시 기호) - Unix Shell, Python 등에서 사용하는 스타일

주석 처리 기호가 시작된 위치부터 해당 행의 끝(줄바꿈 문자)을 만나는 지점까지의 모든 텍스트가 컴파일/해석 단계에서 제외되어 실행되지 않습니다.

<br>

## `//` 기호 사용법 및 예제
---
`//` 기호의 삽입 위치는 행의 시작 부분일 수도 있고, 정상적인 PHP 코드의 뒷부분일 수도 있습니다.

예제 파일: comment-01.php
{% raw %}
```php
<?php
    // <-- 한 줄의 시작부터 주석을 시작할 수 있습니다.
    $name = "hello world!"; // <-- 코드 우측에 덧붙여 부연 설명을 기입할 수 있습니다.
?>
```
{% endraw %}

보통 줄 시작 부분에 작성하는 주석은 아랫줄 코드들의 전반적인 작동 방식이나 의도를 기재하고, 코드 끝부분에 작성하는 주석은 해당 변수의 상태나 간단한 팁을 기입하는 용도로 나뉘어 사용됩니다.

<br>

## `#` 기호 사용법 및 예제
---
Unix 스크립트 스타일의 `#` 기호 역시 동일한 방식으로 동작합니다. 줄의 임의 위치에 기입하여 그 뒷부분을 주석으로 처리할 수 있습니다.

{% raw %}
```php
<?php
    # 이 줄은 화면 출력 코드를 설명하는 주석입니다.
    echo "hello world"; # 뒤에 덧붙이는 것도 가능합니다.
?>
```
{% endraw %}

<br>
