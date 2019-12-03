# Left-associative ternary operator deprecation rfc
The ternary operator has some weird quirks in PHP. 
This RFC adds a deprecation warning for nested ternary statements. 

In PHP 8, this deprecation will be converted to a compile time error.

1 ? 2 : 3 ? 4 : 5;   // deprecated
(1 ? 2 : 3) ? 4 : 5; // ok
