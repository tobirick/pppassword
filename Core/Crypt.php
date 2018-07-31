<?php

namespace Core;

class Crypt 
{
    public static function decrypt($encrypted) 
    {
        $key = getenv('SECRET_KEY');
        $c = base64_decode($encrypted);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertextRaw = substr($c, $ivlen+$sha2len);
        $decrypted = openssl_decrypt($ciphertextRaw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertextRaw, $key, $as_binary=true);

        if (hash_equals($hmac, $calcmac)) {
            return $decrypted;
        }

        return false;
    }

    public static function encrypt($plaintext) 
    {
        $key = getenv('SECRET_KEY');
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $encrypted = base64_encode( $iv.$hmac.$ciphertext_raw );

        return $encrypted;
    }
}