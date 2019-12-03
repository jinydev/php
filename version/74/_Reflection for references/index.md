# Reflection for references

Libraries like Symfony's var dumper rely heavily on the reflection API to reliably dump a variable. 
Previously it wasn't possible to properly reflect references, resulting in these libraries relying on hacks to detect them.

PHP 7.4 adds the ReflectionReference class which solves this issue.

