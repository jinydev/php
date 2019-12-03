# New in PHP 7.3
Released on December 6, 2018
Trailing commas are now allowed in function calls
The is_countable function
Improvements to the Heredoc syntax makes it more flexible to use
array_key_first and array_key_last are two new array helper functions
ads via Carbon
Adobe Creative Cloud for Teams starting at $33.99 per month.
ads via Carbon

# is_countable rfc
PHP 7.2 added a warning when counting uncountable objects. The is_countable function can help prevent this warning.

$count = is_countable($variable) ? count($variable) : null;
#array_key_first and array_key_last rfc
These two functions basically do what the name says.

$array = [
    'a' => '…',
    'b' => '…',
    'c' => '…',
];

array_key_first($array); // 'a'
array_key_last($array); // 'c'
The original RFC also proposed array_value_first and array_value_last, but these were voted against by the majority of people.

Another idea for array_first and array_last was proposed which would return a tuple [$key => $value], but opinions were mixed. For now we only have two functions to get the first and last key of an array.

# Flexible Heredoc syntax rfc
Heredoc can be a useful tool for larger strings, though they had an indentation quirk in the past.

// Instead of this:

$query = <<<SQL
SELECT * 
FROM `table`
WHERE `column` = true;
SQL;

// You can do this:

$query = <<<SQL
    SELECT * 
    FROM `table`
    WHERE `column` = true;
    SQL;
This is especially useful when you're using Heredoc in an already nested context.

The whitespaces in front of the closing marker will be ignored on all lines.

An important note: because of this change, some existing Heredocs might break, when they are using the same closing marker in their body.

$str = <<<FOO
abcdefg
    FOO
FOO;

// Parse error: Invalid body indentation level in PHP 7.3

# Trailing commas in function calls rfc
What was already possible with arrays, can now also be done with function calls. Note that it's not possible in function definitions!

$compacted = compact(
    'posts',
    'units',
);
#Better type error reporting
TypeErrors for integers and booleans used to print out their full name, it has been changed to int and bool, to match the type hints in the code.

Argument 1 passed to foo() must be of the type int/bool
In comparison to PHP 7.2:

Argument 1 passed to foo() must be of the type 
integer/boolean

# JSON errors can be thrown rfc
Previously, JSON parse errors were a hassle to debug. The JSON functions now accept an extra option to make them throw an exception on parsing errors. This change obviously adds a new exception: JsonException.

json_encode($data, JSON_THROW_ON_ERROR);

json_decode("invalid json", null, 512, JSON_THROW_ON_ERROR);

// Throws JsonException
While this feature is only available with the newly added option, there's a chance it'll be the default behaviour in a future version.

# list reference assignment rfc
The list() and its shorthand [] syntax now support references.

$array = [1, 2];

list($a, &$b) = $array;

$b = 3;

// $array = [1, 3];

# Undefined variables in compact rfc
Undefined variables passed to compact will be reported with a notice, they were previously ignored.

$a = 'foo';

compact('a', 'b'); 

// Notice: compact(): Undefined variable: b

# Case-insensitive constants rfc
There were a few edge cases were case-insensitive constants were allowed. These have been deprecated.

# Same site cookie rfc
This change not only adds a new parameter, it also changes the way the setcookie, setrawcookie and session_set_cookie_params functions work in a non-breaking manner.

Instead of one more parameters added to already huge functions, they now support an array of options, whilst still being backwards compatible. An example:

bool setcookie(
    string $name 
    [, string $value = "" 
    [, int $expire = 0 
    [, string $path = "" 
    [, string $domain = "" 
    [, bool $secure = false 
    [, bool $httponly = false ]]]]]] 
)

bool setcookie ( 
    string $name 
    [, string $value = "" 
    [, int $expire = 0 
    [, array $options ]]] 
)

// Both ways work.

# PCRE2 migration rfc
PCRE — short for "Perl Compatible Regular Expressions" — has been updated to v2.

The migration had a focus on maximum backwards compatibility, though there are a few breaking changes. Be sure to read the RFC to know about them.

#String search functions README
You can no longer pass a non-string needle to string search functions. These are the affected functions:

strpos()
strrpos()
stripos()
strripos()
strstr()
strchr()
strrchr()
stristr()

# MBString updates README
MBString is PHP's way of handling complex strings. This module has received some updates in this version of PHP. You can read about it here.

#Several deprecations rfc
Several small things have been deprecated, there's a possibility errors can show up in your code because of this.

Undocumented mbstring function aliases
String search functions with integer needle
fgetss() function and string.strip_tags filter
Defining a free-standing assert() function
FILTER_FLAG_SCHEME_REQUIRED and FILTER_FLAG_HOST_REQUIRED flags
pdo_odbc.db2_instance_name php.ini directive
Please refer to the RFC for a full explanation of each deprecation.

## 참고문서 및 Blog
https://stitcher.io/blog/new-in-php-73
