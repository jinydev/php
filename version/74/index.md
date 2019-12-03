# PHP 7.4
2019년 11월 28일 php 개발팀은 공식적으로 정식적으로 7.4 버전을 발표하였습니다.
7.4는 PHP7 시리즈나 출시된 이후 네번째 업데이트 배포 입니다.

7.4는 이전버젼의 수많은 개선사항과 새로운 몇가지 기능들이 추가되었습니다.

## 새로운 기능
7.4는 몇가지의 새로운 문법이 추가되었습니다.

* Typed Properties
* Arrow Functions
* Limited Return Type Covariance and Argument Type Contravariance
* Unpacking Inside Arrays
* Numeric Literal Separator
* Weak References
* Allow Exceptions from __toString()
* Opcache Preloading
* Several Deprecations
* Extensions Removed from the Core


## Invalid array access notices rfc
If you were to use the array access syntax on, say, an integer; PHP would previously return null. As of PHP 7.4, a notice will be emitted.

$i = 1;

$i[0]; // Notice

## proc_open improvements upgrading
Changes were made to proc_open so that it can execute programs without going through a shell. This is done by passing an array instead of a string for the command.

## strip_tags also accepts arrays upgrading
You used to only be able to strip multiple tags like so:

strip_tags($string, '<a><p>')
PHP 7.4 also allows the use of an array:

strip_tags($string, ['a', 'p'])

## ext-hash always enabled rfc
This extension is now permanently available in all PHP installations.

## PEAR not enabled by default externals
Because PEAR isn't actively maintained anymore, the core team decided to remove its default installation with PHP 7.4.

## Several small deprecations rfc
This RFC bundles lots of small deprecations, each with their own vote. Be sure to read a more detailed explanation on the RFC page, though here's a list of deprecated things:

* The real type
* Magic quotes legacy
* array_key_exists() with objects
* FILTER_SANITIZE_MAGIC_QUOTES filter
* Reflection export() methods
* mb_strrpos() with encoding as 3rd argument
* implode() parameter order mix
* Unbinding $this from non-static closures
* hebrevc() function
* convert_cyr_string() function
* money_format() function
* ezmlm_hash() function
* restore_include_path() function
* allow_url_include ini directive

## Other changes upgrading
You should always take a look at the full UPGRADING document when upgrading PHP versions.

Here are some changes highlighted:

* Calling parent:: in a class without a parent is deprecated.
* Calling var_dump on a DateTime or DateTimeImmutable instance will no longer leave behind accessible properties on the object.
* openssl_random_pseudo_bytes will throw an exception in error situations.
* Attempting to serialise a PDO or PDOStatement instance will generate an Exception instead of a PDOException.
* Calling get_object_vars() on an ArrayObject instance will return the properties of the ArrayObject itself, and not the values of the wrapped array or object. Note that (array) casts are not affected.
* ext/wwdx has been deprecated.


## RFC voting process improvements
This is technically not an update related to PHP 7.4, though it's worth mentioning: the voting rules for RFC's have been changed.

They always need a 2/3 majority in order to pass.
There are not more short voting periods, all RFCs must be open for at least 2 weeks.



