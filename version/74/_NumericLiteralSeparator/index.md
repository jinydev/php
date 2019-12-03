# Numeric Literal Separator
숫자형 값을 지정할때 밑줄(underscores)를 이용하여 시각적으로 구분할 수 있습니다.

```php
<?php
$number = 123456789.987;
var_dump($number);

$formattedNumber = 123_456_789.98;
var_dump($formattedNumber);
```

출력결과
```
$ php num.php
float(123456789.987)
float(123456789.98)
```

php 엔진에서 밑줄을 무시합니다.
