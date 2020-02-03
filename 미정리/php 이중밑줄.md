# 이중밑줄
php에서 이중밑줄(__)을 사용한 코드들을 확인할 수 있습니다.

다음은 클래스에서 사용되는 매직 메서드들의 이름입니다.

```
__construct, 
__destruct, 
__call, 
__callStatic, 
__get, 
__set, 
__isset, 
__unset, 
__sleep, 
__wakeup, 
__toString, 
__invoke, 
__set_state 
__clone
```

PHP reserves all function names
starting with __ as magical. 
It is
recommended that you do not use
function names with __ in PHP unless
you want some documented magic
functionality