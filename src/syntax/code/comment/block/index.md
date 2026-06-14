---
layout: php
title: "여러 줄 주석 (Block Comment)"
description: "PHP에서 여러 줄을 한꺼번에 주석으로 처리하는 블록 주석(/* */)의 문법, 사용 예시 및 중첩 사용 금지 규칙을 알아봅니다."
keyword: "php 여러줄 주석, php 블록 주석, php block comment, php 다중 주석"
breadcrumb:
- syntax
- code
- comment
- block
---

# 여러 줄 주석 (Block Comment)
---

<div style="text-align: center; margin: 30px 0;">
  <img src="img/block_comment_cartoon.png" alt="Block Comment Concept Cartoon" style="max-width: 60%; height: auto; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);" />
  <p style="font-size: 13px; color: #64748b; margin-top: 8px;">그림: 여러 줄의 코드를 주석 덮개(/* ... */)로 덮어 실행에서 제외(Zzz...)시키는 블록 주석의 역할</p>
</div>

여러 줄 주석 처리 기능은 한 줄 처리 주석과 달리 여러 줄의 내용을 한꺼번에 주석으로 처리하고자 할 때 사용하는 방법입니다. 특정 블록 영역을 주석으로 처리할 때 매우 편리합니다.  

여러 줄을 주석으로 처리하는 방법은 `/*`로 시작해서 `*/`로 블록을 지정하면 됩니다. 해당 기호로 감싸인 모든 코드와 텍스트는 프로그램 소스 상에서 주석으로 처리되어 실행되지 않습니다.

<br>

## 기본 문법 및 예제
---
여러 줄 주석을 사용하는 실제 예시입니다. 

예제 파일 comment-02.php
{% raw %}
```php
<?php
    // This is a single-line comment
    /*
    This is a multiple-lines comment block
    that spans over multiple
    lines
    */
 
    // 코드의 일부를 제외하는 데 사용할 수도 있습니다.
    $x = 5 /* + 15 */ + 5;
    echo $x;
?>
```
{% endraw %}

결과
{% raw %}
```
10
```
{% endraw %}

<br>

## 블록 주석 사용 시 주의할 점
---

### 1. 중첩 사용 금지 (Nested Comments)
여러 줄 주석 처리(`/* */`)는 **중첩되어 사용할 수 없습니다.** `/* */`로 이미 주석 처리된 블록 안에서 또 다른 `/* */` 주석 블록을 삽입하면 PHP 파서가 `*/` 기호를 잘못 만나 에러를 발생시키고 실행을 중단합니다.

잘못된 사용 예:
{% raw %}
```php
/*
    여러 줄 주석입니다.
    /*
    서브로 여러 줄 주석을 삽입할 수 없습니다.
    */
    주석의 끝입니다. (이 부분에서 에러가 발생합니다)
*/
```
{% endraw %}

### 2. 블록 주석 내 한 줄 주석 사용
블록 주석(`/* */`) 내부에는 한 줄 주석(`//` 또는 `#`)을 자유롭게 삽입할 수 있습니다. 

올바른 사용 예:
{% raw %}
```php
/*
    여러 줄 주석입니다.
    // 중간에 한 줄 주석문은 삽입이 가능합니다.
    # 이 또한 무시됩니다.
    주석의 끝입니다.
*/
```
{% endraw %}

<br>
