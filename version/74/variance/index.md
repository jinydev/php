# php 7.4: type variance 개선
이는 PHP 코어 차원에서 내부적으로 개선되었습니다.

다음과 같이 상속 구조를 가지는 두개의 클래스가 있습니다.

```php
class ParentType
{
    //
}

class ChildType extends ParentType
{
    //
}
```

7.4 부터는 함께 변하는 공변(covariant) 반환 타입을 정의할 수 있습니다.

```php
class Foo
{
    public function covariant() :ParentType
    {

    }
}

class Bar extends Foo
{
    public function covariant() :ChildType
    {
        
    }
}
```

인수로도 전달이 가능합니다.

```php
class A
{
    public function contraVariantArguments(ChildType $type)
    { /* … */ }
}

class B extends A
{
    public function contraVariantArguments(ParentType $type)
    { /* … */ }
}

```