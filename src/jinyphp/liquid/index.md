---
layout: php
title: "liquid - jinyPHP"
---

# Liquid

```php
// 테스트1
$liquid = new \Jiny\Liquid\Template;
return $liquid->liquid("Hello, {{- name -}}!", array('name' => 'Alex'));
```

```php
// 테스트2
return \jiny\liquid("Hello, {{- name -}}!", ['name' => 'hojin']);
```