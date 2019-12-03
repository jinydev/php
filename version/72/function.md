# New functions ¶

## PHP Core ¶
stream_isatty()
sapi_windows_vt100_support()

## SPL ¶
spl_object_id()

## DOM ¶
DomNodeList::count()
DOMNamedNodeMap::count()

## FTP ¶
ftp_append()

## GD ¶
imagesetclip()
imagegetclip()
imageopenpolygon()
imageresolution()
imagecreatefrombmp()
imagebmp()

## Hash ¶
hash_hmac_algos()

## LDAP ¶
ldap_parse_exop()
ldap_exop()
ldap_exop_passwd()
ldap_exop_whoami()

## Multibyte String ¶
mb_chr()
mb_ord()
mb_scrub()

## Oracle OCI8 ¶
oci_register_taf_callback()
oci_unregister_taf_callback()

## Sockets ¶
socket_addrinfo_lookup()
socket_addrinfo_connect()
socket_addrinfo_bind()
socket_addrinfo_explain()

## Sodium ¶
sodium_add()
sodium_bin2hex()
sodium_compare()
sodium_crypto_aead_aes256gcm_decrypt()
sodium_crypto_aead_aes256gcm_encrypt()
sodium_crypto_aead_aes256gcm_is_available()
sodium_crypto_aead_aes256gcm_keygen()
sodium_crypto_aead_chacha20poly1305_decrypt()
sodium_crypto_aead_chacha20poly1305_encrypt()
sodium_crypto_aead_chacha20poly1305_ietf_decrypt()
sodium_crypto_aead_chacha20poly1305_ietf_encrypt()
sodium_crypto_aead_chacha20poly1305_ietf_keygen()
sodium_crypto_aead_chacha20poly1305_keygen()
sodium_crypto_auth_keygen()
sodium_crypto_auth_verify()
sodium_crypto_auth()
sodium_crypto_box_keypair_from_secretkey_and_publickey()
sodium_crypto_box_keypair()
sodium_crypto_box_open()
sodium_crypto_box_publickey_from_secretkey()
sodium_crypto_box_publickey()
sodium_crypto_box_seal_open()
sodium_crypto_box_seal()
sodium_crypto_box_secretkey()
sodium_crypto_box_seed_keypair()
sodium_crypto_box()
sodium_crypto_generichash_final()
sodium_crypto_generichash_init()
sodium_crypto_generichash_keygen()
sodium_crypto_generichash_update()
sodium_crypto_generichash()
sodium_crypto_kdf_derive_from_key()
sodium_crypto_kdf_keygen()
sodium_crypto_kx_client_session_keys()
sodium_crypto_kx_keypair()
sodium_crypto_kx_publickey()
sodium_crypto_kx_secretkey()
sodium_crypto_kx_seed_keypair()
sodium_crypto_kx_server_session_keys()
sodium_crypto_pwhash_scryptsalsa208sha256_str_verify()
sodium_crypto_pwhash_scryptsalsa208sha256_str()
sodium_crypto_pwhash_scryptsalsa208sha256()
sodium_crypto_pwhash_str_verify()
sodium_crypto_pwhash_str()
sodium_crypto_pwhash()
sodium_crypto_scalarmult_base()
sodium_crypto_scalarmult()
sodium_crypto_secretbox_keygen()
sodium_crypto_secretbox_open()
sodium_crypto_secretbox()
sodium_crypto_shorthash_keygen()
sodium_crypto_shorthash()
sodium_crypto_sign_detached()
sodium_crypto_sign_ed25519_pk_to_curve25519()
sodium_crypto_sign_ed25519_sk_to_curve25519()
sodium_crypto_sign_keypair_from_secretkey_and_publickey()
sodium_crypto_sign_keypair()
sodium_crypto_sign_open()
sodium_crypto_sign_publickey_from_secretkey()
sodium_crypto_sign_publickey()
sodium_crypto_sign_secretkey()
sodium_crypto_sign_seed_keypair()
sodium_crypto_sign_verify_detached()
sodium_crypto_sign()
sodium_crypto_stream_keygen()
sodium_crypto_stream_xor()
sodium_crypto_stream()
sodium_hex2bin()
sodium_increment()
sodium_memcmp()
sodium_memzero()
sodium_pad()
sodium_unpad()

## ZIP ¶
ZipArchive::count()
ZipArchive::setEncryptionName()
ZipArchive::setEncryptionIndex()