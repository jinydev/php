---
layout: post
permalink: /function/print_r
---

# print_r
`print_r`은 변수를 사람이 쉽게 읽을 수 있는 형태로 출력을 제공합니다.

### 호환
PHP4, PHP5, PHP7

## 설명

```php
print_r ( mixed $expression [, bool $return = FALSE ] ) : mixed
```
print_r() displays information about a variable in a way that's readable by humans.

print_r(), var_dump() and var_export() will also show protected and private properties of objects. Static class members will not be shown.