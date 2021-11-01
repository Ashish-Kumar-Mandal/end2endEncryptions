<?php
	
	class Crypt
    {
        private $key;
        private $cipher;
        private $ivLength;
        private $options;

        function __construct(){
            $file_name = "./db/public_key_certificate.cer";
            $fp = fopen($file_name, "r");
            $public_key = fread($fp, filesize($file_name));
            fclose($fp);

            $this->key = base64_decode($public_key);
            $this->cipher = "aes-256-cbc";
            $this->ivLength = openssl_cipher_iv_length($this->cipher);
            $this->options = 0;
        }

        function encrypt($data){            
            $iv = openssl_random_pseudo_bytes($this->ivLength); 
            $encrypt_data = openssl_encrypt($data, $this->cipher, $this->key, $this->options, $iv);
            return base64_encode($encrypt_data.'::'.$iv);
        }

        function decrypt($data){
            list($encrypt_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
            return openssl_decrypt($encrypt_data, $this->cipher, $this->key, $this->options, $iv);
        }

        /** passwor encrypted by hash function **/

        function pass_hash($pass){
            return password_hash($pass, PASSWORD_DEFAULT);
        }

        function pass_verify($usrPass, $dbPass){
            return password_verify($usrPass, $dbPass);
        }

    }
?>
