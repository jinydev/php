# Null coalescing assignment operator

null coalescing 할당 연산자를 약칭으로 사용이 가능해 졌습니다.

이전의 `??`은 
```php
<?php

$data = [];
$data['num'] = "123456";

// 값이 존재하는 경우
$data['num'] = $data['num'] ?? "000000";

// 값이 null인 경우
$data['name'] = $data['name'] ?? "jiny";

print_r($data);
```

출력결과
```
$ php null_01.php
Array
(
    [num] =>
    [name] => jiny
)
```

하지만 php 7.4 부터는 단축 연산으로 null을 처리 할 수 있습니다.


```php
<?php

$data = [];
$data['num'] = "123456";

// 값이 존재하는 경우
$data['num'] ??= "000000";

// 값이 null인 경우
$data['name'] ??= "jiny";

print_r($data);
```

