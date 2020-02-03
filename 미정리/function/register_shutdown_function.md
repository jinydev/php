---
layout: post
permalink: /function/register_shutdown_function
---

# register_shutdown_function
프로그램이 종료할때 실행되는 콜백함수를 등록합니다.

함수로 등록할때
```php
register_shutdown_function('finish');
```

객체로 등록할때