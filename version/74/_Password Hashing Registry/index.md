# Password Hashing Registry
Internal changes have been made to how hashing libraries are used, 
so that it's easier for userland to use them.

More specifically, 
a new function password_algos has been added which returns a list of all registered password algorithms.

The RFC was a little unclear about the benefits, 
luckily Sara was able to provide some more context:

It means that ext/sodium (or anyone really) can register password hashing algorithms dynamically. 
The upshot of which is that argon2i and argon2id will be more commonly available moving forward
