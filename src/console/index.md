---
layout: php
---

# console CLI 프로그래밍
---
콘솔에서 동작하는 cli 프로그램을 php로 작성할때 사용자의 데이터를 입력받아야 합니다.  
php는 streams을 통하여 input 과 output을 처리 할 수 있습니다.

```php
<?php
$stdin = fopen('php://stdin', 'r');
$contents = fread($stdin, 1024);
fclose($stdin);

echo $contents;
```

fopen으로 파일스트림을 열고, 스트림을 통하여 데이터를 입력 받습니다.
데이터 입력은 엔터가 입력될때 까지의 값을 최대 1024 까지 받을 수 있습니다.


만일 들어오는 값이 정수등 특수한 포맷으로 필터링이 필요한 경우 
fcanf 함수를 이용하여 할 수도 있습니다.

```php
<?php
$stdin = fopen('php://stdin', 'r');
fscanf($stdin, "%d\n", $number); // reads number from STDIN
echo $number;
```

