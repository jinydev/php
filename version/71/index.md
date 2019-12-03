# 새로운 기능 7.1

https://www.php.net/manual/en/migration72.php


## Nullable 타입
Type declarations for parameters and return values can now be marked as nullable by prefixing the type name with a question mark. 
This signifies that as well as the specified type, 
NULL can be passed as an argument, 
or returned as a value, respectively.

```php
<?php

function testReturn(): ?string
{
    return 'elePHPant';
}

var_dump(testReturn());

function testReturn(): ?string
{
    return null;
}

var_dump(testReturn());

function test(?string $name)
{
    var_dump($name);
}

test('elePHPant');
test(null);
test();
```


## Void functions

A void return type has been introduced. Functions declared with void as their return type must either omit their return statement altogether, or use an empty return statement. NULL is not a valid return value for a void function.

```php
<?php
function swap(&$left, &$right): void
{
    if ($left === $right) {
        return;
    }

    $tmp = $left;
    $left = $right;
    $right = $tmp;
}

$a = 1;
$b = 2;
var_dump(swap($a, $b), $a, $b);

```
Attempting to use a void function's return value simply evaluates to NULL, with no warnings emitted. The reason for this is because warnings would implicate the use of generic higher order functions.


# Symmetric array destructuring 
The shorthand array syntax ([]) may now be used to destructure arrays for assignments (including within foreach), as an alternative to the existing list() syntax, which is still supported.

```php
<?php
$data = [
    [1, 'Tom'],
    [2, 'Fred'],
];

// list() style
list($id1, $name1) = $data[0];

// [] style
[$id1, $name1] = $data[0];

// list() style
foreach ($data as list($id, $name)) {
    // logic here with $id and $name
}

// [] style
foreach ($data as [$id, $name]) {
    // logic here with $id and $name
}
```


## Class constant visibility
Support for specifying the visibility of class constants has been added.

```php
<?php
class ConstDemo
{
    const PUBLIC_CONST_A = 1;
    public const PUBLIC_CONST_B = 2;
    protected const PROTECTED_CONST = 3;
    private const PRIVATE_CONST = 4;
}
```

## iterable pseudo-type
A new pseudo-type (similar to callable) called iterable has been introduced. It may be used in parameter and return types, where it accepts either arrays or objects that implement the Traversable interface. With respect to subtyping, parameter types of child classes may broaden a parent's declaration of array or Traversable to iterable. With return types, child classes may narrow a parent's return type of iterable to array or an object that implements Traversable.

```php
<?php
function iterator(iterable $iter)
{
    foreach ($iter as $val) {
        //
    }
}
```

## Multi catch exception handling
Multiple exceptions per catch block may now be specified using the pipe character (|). This is useful for when different exceptions from different class hierarchies are handled the same.

```php
<?php
try {
    // some code
} catch (FirstException | SecondException $e) {
    // handle first and second exceptions
}
```

## Support for keys in list()
You can now specify keys in list(), or its new shorthand [] syntax. This enables destructuring of arrays with non-integer or non-sequential keys.

```php
<?php
$data = [
    ["id" => 1, "name" => 'Tom'],
    ["id" => 2, "name" => 'Fred'],
];

// list() style
list("id" => $id1, "name" => $name1) = $data[0];

// [] style
["id" => $id1, "name" => $name1] = $data[0];

// list() style
foreach ($data as list("id" => $id, "name" => $name)) {
    // logic here with $id and $name
}

// [] style
foreach ($data as ["id" => $id, "name" => $name]) {
    // logic here with $id and $name
}
```

## Support for negative string offsets
Support for negative string offsets has been added to the string manipulation functions accepting offsets, as well as to string indexing with [] or {}. In such cases, a negative offset is interpreted as being an offset from the end of the string.

```php
<?php
var_dump("abcdef"[-2]);
var_dump(strpos("aabbcc", "b", -3));
The above example will output:

string (1) "e"
int(3)
```

Negative string and array offsets are now also supported in the simple variable parsing syntax inside of strings.

```php
<?php
$string = 'bar';
echo "The last character of '$string' is '$string[-1]'.\n";
?>
```

## Support for AEAD in ext/openssl
Support for AEAD (modes GCM and CCM) have been added by extending the openssl_encrypt() and openssl_decrypt() functions with additional parameters.


## Convert callables to Closures with Closure::fromCallable()
A new static method has been introduced to the Closure class to allow for callables to be easily converted into Closure objects.

```php
<?php
class Test
{
    public function exposeFunction()
    {
        return Closure::fromCallable([$this, 'privateFunction']);
    }

    private function privateFunction($param)
    {
        var_dump($param);
    }
}

$privFunc = (new Test)->exposeFunction();
$privFunc('some value');
```

## Asynchronous signal handling ¶
A new function called pcntl_async_signals() has been introduced to enable asynchronous signal handling without using ticks (which introduce a lot of overhead).

```php
<?php
pcntl_async_signals(true); // turn on async signals

pcntl_signal(SIGHUP,  function($sig) {
    echo "SIGHUP\n";
});

posix_kill(posix_getpid(), SIGHUP);
```

## HTTP/2 server push support in ext/curl
Support for server push has been added to the CURL extension (requires version 7.46 and above). This can be leveraged through the curl_multi_setopt() function with the new CURLMOPT_PUSHFUNCTION constant. The constants CURL_PUSH_OK and CURL_PUSH_DENY have also been added so that the execution of the server push callback can either be approved or denied.

## Stream Context Options
The tcp_nodelay stream context option has been added.

