# Concatenation precedence rfc
If you'd write something like this:

echo "sum: " . $a + $b;
PHP would previously interpret it like this:

echo ("sum: " . $a) + $b;
PHP 8 will make it so that it's interpreted like this:

echo "sum :" . ($a + $b);
PHP 7.4 adds a deprecation warning when encountering an unparenthesized expression containing a . before a + or - sign.
