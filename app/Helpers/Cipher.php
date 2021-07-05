<?php

namespace App\Helpers;
use \Illuminate\Encryption\Encrypter;
use Config;
class Cipher{

    public $key;
    public $cipher;
    public function __construct(){
        $this->key = Config::get('app.key');
        $this->cipher = Config::get('app.cipher');
    }
    public function encrypt($plain_text)
    {
        /* set the key for encryption */
        $encrypter = new Encrypter(substr($this->key, 0, 32), $this->cipher);
        /* encrypt the plain text */
        $encrypted = $encrypter->encrypt($plain_text);

        return $encrypted;
    }

    public function decrypt($cipher_text)
    {
        /* set the key for decryption */
        $decrypter = new Encrypter(substr($this->key, 0, 32), $this->cipher);
        /* decrypt the cipher text */
        $decrypted = $decrypter->decrypt($cipher_text);

        return $decrypted;
    }
}