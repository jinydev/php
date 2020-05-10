---
layout: php
title: "PSR 코드 스타일"
keyword: "php, psr-2"
breadcrumb:
- "basic"
- "psr"
- "psr2"
---

# PSR-2 코딩 스타일
---
`PSR-2`는 PSR-1의 확장 규칙입니다. 또한 일관적인 코드 스타일과 관련된 권고안입니다.  

PSR-2의 일관적인 코드 스타일은 여러 사람이 한 명이 작성한 것과 같이 보이는 효과를 주기 위함입니다. 여러 개발자와 공동 작업을 하거나 작성된 코드가 공개가 될 때 일관성은 매우 중요합니다.  

<br>

## 들여쓰기
---
들여쓰기는 코드의 가독성을 위해서 매우 중요한 코딩 스타일입니다. 들여쓰기는 에디터마다 적용하는 스타일이 다르고, 개발자들 사이에서도 공백 수, 탭 키 등 다양한 방식으로 들여쓰기를 합니다.  

PSR-2에서는 일관된 들여쓰기를 위해서 tab 대신에 공백 문자 4개를 기본으로 들여쓰기를 합니다. 사용하는 에디터마다 tab 키의 크기는 각기 다를 수 있습니다. 미리 에디터 환경설정에서 tab의 크기를 지정해 놓으면 편리합니다.  

<br>

## 파일
---
PHP 파일은 각 줄의 끝에는 유닉스 개행 문자(Unix LF)를 사용해야 합니다. 또한 파일의 맨 마지막 줄에는 공백의 한 줄을 포함합니다.  

그리고 PHP 파일의 종료 태그 ?>를 생략합니다.?>를 생각하게 되면 예상치 않은 출력 오류를 방지할 수도 있습니다.  

<br>

## 줄
---
한 줄에 수많은 코드를 작성한다면 코드의 줄이 너무 길어 읽기가 불편할 것입니다. 그래서 PSR-2에서는 각 줄의 길이를 80자 이내 작성을 권고합니다. 만일 80자를 넘더라도 최대 120자를 넘지 않도록 하고 있습니다.  

또한 각 줄의 마지막에는 공백 문자가 들어가지 않도록 합니다.  

<br>

## 키워드
---
PSR-2에서 PHP의 키워드는 소문자 사용을 권고합니다. 또한 상수도 true, false, null 등 소문자로 사용할 것을 권고합니다. 대문자로 TRUE, FALSE, NULL로 쓰고 있다면 PSR-2 스타일로 바꾸도록 합니다.  

<br>

## 네임스페이스
---
네임스페이스 키워드와 use 키워드 다음에는 비어 있는 한 줄을 추가합니다.
한 줄을 추가함으로써 문장을 쉽게 구분할 수 있고 가독성을 높입니다.  

```php
<?php
namespace Vendor\Package;

use FooClass;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

// ... additional PHP code …
```

<br>

## 클래스
---
클래스, 인터페이스, 트레이트도 이와 같은 스타일 코딩 권고를 따릅니다.  

`extends`와 `implements` 키워드는 클래스명과 함께 한 줄에 위치해야 합니다. 그리고 본문을 감싸고 있는 중괄호 { 시작은 class 키워드와 같은 위치의 다음 줄에 위치합니다.  

```php
<?php
	namespace Vendor\Package;

	use FooClass;
	use BarClass as Bar;
	use OtherVendor\OtherPackage\BazClass;

	class ClassName extends ParentClass implements \ArrayAccess, \Countable
	{
		// constants, properties, methods
	}
```

### 프로퍼티  
모든 프로퍼티는 접근 권한 속성을 앞에 선언해야 합니다. 접근 속성은 public, protected, private 세 가지가 있습니다. var와 같은 속성 키워드는 사용하지 않습니다.  
 
프로퍼티 이름은 밑줄 “_”과 같은 개인적인 접두사를 사용하지 않습니다. 또한 메서드 이름 다음은 공백 문자를 삽입하지 않습니다.   

```php
<?php
	namespace Vendor\Package;

	class ClassName
	{
		public $foo = null;
	}
```

<br>

### 매서드
---
모든 메서드는 접근 권한 속성을 앞에 선언해야 합니다. 접근 속성은 public, protected, private 세 가지가 있습니다.  

메서드 이름은 밑줄 “_”과 같은 개인적인 접두사를 사용하지 않습니다. 또한 메서드 이름 다음은 공백 문자를 삽입하지 안습니다.  

메서드의 내용을 담고 있는 중괄호는 다음 줄 자신의 위치를 시작으로 그 다음 줄에 닫는 중괄호를 작성합니다. 여는 괄호 뒤에 공백이 있으면 안 되며 닫는 괄호 앞에 공백이 있어서는 안 됩니다.  

메서드 선언은 다음과 같습니다. 괄호, 쉼표, 공백 및 중괄호의 배치에 유의합니다.  

```php
<?php
namespace Vendor\Package;

class ClassName
{
    public function fooBarBaz($arg1, &$arg2, $arg3 = [])
    {
        // method body
    }
}
```

### 메서드 인자
메서드 인자 뒤에는 공백이 들어가면 안 됩니다. 여러 개의 인자를 전달할 경우 인자명 뒤에 쉼표를 삽입을 하고 공백을 하나 추가합니다.  

```php
<?php
namespace Vendor\Package;

class ClassName
{
    public function foo($arg1, &$arg2, $arg3 = [])
    {
        // method body
    }
}
```

만일 매개변수 인자가 많아서 여러 줄로 구성해야 할 때도 있습니다. 이런 경우에는 들여쓰기를 적용합니다.  

매개변수는 한 줄에 하나씩만 작성합니다. 닫는 괄호와 여는 중괄호는 한 줄의 공백을 사용하여 각각의 줄에 함께 있어야 합니다.  

```php
<?php
namespace Vendor\Package;

class ClassName
{
    public function aVeryLongMethodName(
        ClassTypeHint $arg1,
        &$arg2,
        array $arg3 = []
    ) {
        // method body
    }
}
```

* abstract, final, static
abstract와 final 은 가시성 키워드 앞에 선언돼야 합니다. static은 가시성 키워드 다음에 선언해야 합니다.  

```php
<?php
namespace Vendor\Package;

abstract class ClassName
{
    protected static $foo;

    abstract protected function zim();

    final public static function bar()
    {
        // method body
    }
}
```

### 메서드와 함수의 호출
메서드와 함수를 호출할 때 이름 뒤 소괄호 시작 사이에는 공백이 없어야 합니다. 또한 소괄호 시작과 인수명 사이, 소괄호가 끝나는 앞에도 공백이 없어야 합니다.  

또한 여러 인수가 전달될 때 구분자 쉼표 앞에도 공백이 없어야 합니다.  

```php
<?php
bar();
$foo->bar($arg1);
Foo::bar($arg2, $arg3);
```

인수가 여러 개일 때는 다음 줄에 시작하여 들여쓰기를 할 수 있습니다. 여러 줄로 인수를 작성할 때 첫 번째 항목은 다음 줄에 있어야 하며 한 줄에 하나의 인수만 있어야 합니다.  

```php
<?php
$foo->bar(
    $longArgument,
    $longerArgument,
    $muchLongerArgument
);
```

<br>

## 제어 구조
---
모든 제어 구조문 키워드 다음에는 하나의 공백을 포함합니다. if, elsif, else, switch, while, do wile, for, foreach, try, catch입니다.  

제어문의 본문을 담는 중괄호는 앞뒤에 공백을 포함하지 않습니다. 또한 중괄호 안에는 들여쓰기를 권장합니다.  

PSR-2 코딩 스타일: 조건문  

다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호의 배치에 유의합니다.  

```php
<?php
if ($expr1) {
    // if body
} elseif ($expr2) {
    // elseif body
} else {
    // else body;
}
```

조건문의 거짓 조건 else if 처럼 두 개의 키워드 말고 else if처럼 하나의 단어로 공백 없이 붙여서 사용합니다.  

PSR-2 코딩 스타일: 스위치, 케이스  

다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호 배치에 유의합니다.  

스위치의 케이스 문장은 들여쓰기를 적용합니다. 브레이크 키워드는 한 단계 더 들여쓰기합니다.  
```php
<?php
switch ($expr) {
    case 0:
        echo 'First case, with a break';
        break;
    case 1:
        echo 'Second case, which falls through';
        // no break
    case 2:
    case 3:
    case 4:
        echo 'Third case, return instead of break';
        return;
    default:
        echo 'Default case';
        break;
}
```

* PSR-2 코딩 스타일: while  
다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호의 배치에 유의합니다.  

```php
<?php
while ($expr) {
    // structure body
}
```

* PSR-2 코딩 스타일: do~while  
다음은 PSR-2 권고의 코딩 스타일입니다.  괄호, 공백 및 중괄호의 배치에 유의합니다.  

```php
<?php
do {
    // structure body;
} while ($expr);
```

* PSR-2 코딩 스타일 : for  
다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호의 배치에 유의합니다.  

```php
<?php
for ($i = 0; $i < 10; $i++) {
    // for body
}
```

* PSR-2 코딩 스타일: foreach  
다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호의 배치에 유의합니다.  

```php
<?php
foreach ($iterable as $key => $value) {
    // foreach body
}
```

* PSR-2 코딩 스타일: try~catch  
다음은 PSR-2 권고의 코딩 스타일입니다. 괄호, 공백, 중괄호의 배치에 유의합니다.  

```php
<?php
try {
    // try body
} catch (FirstExceptionType $e) {
    // catch body
} catch (OtherExceptionType $e) {
    // catch body
}
```

<br><br>