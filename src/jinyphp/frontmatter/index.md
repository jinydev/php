---
layout: php
title: "frontmatter - jinyPHP"
---

# FrontMatter란?
---
FrontMatter는 문서의 포맷형태로 머리말을 의미합니다.

```html
---
layout: "home"
---

# Hello World
---
<?php echo "Hello"; ?>
```

다음과 같이 html 문서 내의 상단에 `---`로 둘러싼 yaml 타입의 데이터를 추출 할 수 있습니다.

## 패키지 설치
---

```console
composer require jiny/frontmatter
```

## 헬퍼함수
---
쉽게 프론트메터를 분리하기 위해서 전용함수를 제공합니다.

```php
\jiny\frontMatter($content);
```

예제코드
```php
<?php
// 컴포저 로드
require "../../../autoload.php";
$content = file_get_contents("test.php.html");
echo $content;

$body = \jiny\frontMatter($content);
var_dump($body);
```