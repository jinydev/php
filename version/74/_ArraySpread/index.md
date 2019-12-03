# Array spread operator

Next up, it's now possible to use the spread operator in arrays:

$arrayA = [1, 2, 3];

$arrayB = [4, 5];

$result = [0, ...$arrayA, ...$arrayB, 6 ,7];


출력결과
```
$ php array_01.php
Array       
(
    [0] => 0
    [1] => 1
    [2] => 2
    [3] => 3
    [4] => 4
    [5] => 5
    [6] => 6
    [7] => 7
)
```

이 방법은 numerical keys를 가지는 배열만 가능합니다.

