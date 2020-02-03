---
layout: post
permalink: /database/pdo/bind/
---

# PDO bindParam

```php
public PDOStatement::bindParam ( mixed $parameter , mixed &$variable [, int $data_type = PDO::PARAM_STR [, int $length [, mixed $driver_options ]]] ) : bool
```

This works ($val by reference):
<?php
foreach ($params as $key => &$val) {
    $sth->bindParam($key, $val);
}
?>

This will fail ($val by value, because bindParam needs &$variable):
<?php
foreach ($params as $key => $val) {
    $sth->bindParam($key, $val);
}
?>