---
layout: php
title: "view - jinyPHP"
---

# view 헬퍼함수 (jinyphp)
---
jinyphp의 view 패키지는 파사드 형태의 몇가지 헬퍼 함수들을 제공합니다.

## template()
---
html 또는 php로 작성된 리소스파일을 읽어옵니다. 
반환값은 지정한 파일의 텍스트를 반한합니다. 만일 지정한 리소스 파일이 php일때 파일의 실행 결과가 반환됩니다.
php 파일 실행시 필요한 변수가 있는 경우 배열로 인자값을 전달 할 수 있습니다.
배열은 연상배열로 작성을 합니다.

```php
function \jiny\view\template($file, $vars=[]) :string
```
