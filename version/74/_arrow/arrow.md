# Arrow Functions
es6 자바스크립트에서 사용하던 화살표 함수(arrow function)를 이제 PHP에서도 사용이 가능해 졌습니다.
화살표함 수는 `short closures`라고 부르기도 합니다. 화살표 함수는 클로저를 통하여 함수를 처리할 유용한 표현식 입니다.

## 사용법
그럼 새로운 기능인 화살표 함수를 사용하는 방법에 대해서 알아 보도록 합니다.

이전 익명함수를 통한 콜백 인수 전달은 다음과 같이 하였습니다.

```php
array_map(function($n){
    return $n * $factor;
}, $data);
```

위와 같은 표현이 다음과 같이 변경합니다.

```php
fn(인자)=> 처리내역
```




`array_map()` 함수는 전달되는 요소에 대한 콜백함수를 수행합니다.

```php
<?php
echo "Arrow Function Test";

$factor = 10;
$data = [1,2,3,4];
$num = array_map(fn($n)=> $n * $factor, $data);

print_r($num);
```

출력결과
```
$ php arrow.php
Arrow Function TestArray
(
    [0] => 10
    [1] => 20
    [2] => 30
    [3] => 40
)
```

화살표 함수는 클로저의 부모 범위안을 접글 할 수 있기 때문에 별도의 `use` 키워드를 사용하지 않아도 됩니다.
`$this`를 일반 클로즈 처럼 사용할 수 있습니다.

화살표 함수는 하나의 행만을 포함합니다.

## short closure
그럼 short closure를 사용하는 방법에 대해서 좀더 자세히 알아 보도록 합니다.

화살표 함수를 사요하기 위해서는 `php 7.4` 버젼으로 업그레이드 하여야 합니다.

기존의 `function` 키워드가 단축 키워드 `fn`으로 변경 합니다.

화살표 함수는 하나의 `표현식(expression)` 입니다. 그리고 반환을 받습니다.


## 타입정의
화살표 함수는 반환을 받습니다. 반환에 타입을 정해야 하는 경우 다음과 같이 할 수 있습니다.
함수명 뒤에 타입을 지정합니다.

```php
$num = array_map(fn($n):int => $n * $factor, $data);
```
위의 예제는 반환값으로 `정수` 타입을 지정한 것입니다.

spread 연산자를 허용합니다.
참조를 허용합니다. 

만일 참조값으로 반환을 원하는 경우 다음과 깉이 `&`를 추가합니다.

```php
fn&($n)=>$n
```

## 다중줄 처리
화살표 함수는 단일 표현식 입니다. 단일 표현식의 의미는 여러개의 줄로 코드를 작성할 수 없다는 뜻입니다.


The reasoning is as follows: the goal of short closures is to reduce verbosity. fn is of course shorter than function in all cases. Nikita Popov, the creator of the RFC, however argued that if you're dealing with multi-line functions, there is less to be gained by using short closures.

After all, multi-line closures are by definition already more verbose; so being able to skip two keywords (function and return) wouldn't make much of a difference.

Whether you agree with this sentiment is up to you. While I can think of many one-line closures in my projects, there are also plenty of multi-line ones, and I'll personally miss the short syntax in those cases.

There's hope though: it is possible to add multi-line short closures in the future, but that's an RFC on its own.


## Values from outer scope
화살표 함수와 일반적인 클로저와의 차이점은 use 키워드 사용하지 않아도 외부 스코프의 데이터를 접근할 수 있다는 것입니다.


```
$modifier = 5;
array_map(fn($x) => $x * $modifier, $numbers);
```

It's important to note that you're not allowed to modify variables from the outer scope. 
Values are bound by value and not by reference. 
This means that you could change $modifier within the short closure, though it wouldn't have effect on the $modifier variable in the outer scope.

One exception is of course the $this keyword, which acts exactly the same as normal closures:

```
array_map(fn($x) => $x * $this->modifier, $numbers);
```

## Future possibilities
I already mentioned multi-line short closures, which is still a future possibility. Another idea floating around is allowing the short closure syntax in classes, for example for getters and setters:

class Post {
    private $title;
 
    fn getTitle() => $this->title;
}
All in all, short closures are a welcome feature, though there is still room for improvement. The biggest one probably being multi-line short closures.

Do you have any thoughts you'd like to share? Feel free to send a tweet or an email my way!

Would you like to stay up to date about new content? Feel free to subscribe to my newsletter and follow me on Twitter. Noticed a tpyo? You can submit a PR to fix it.