


<?php

class Encriptador
{
    function Encriptar($TextoPorEncrytar)
    {
        $simple_string = $TextoPorEncrytar;

        $ciphering = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($ciphering);

        $options = 0;

        $encryption_iv = '1234567891011121';

        $encryption_key = "Veter";

        $encryption = openssl_encrypt(
            $simple_string,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );

        return $encryption;
    }
    function Desencriptar($textoPorDesencriptar)
    {
        $ciphering = "AES-128-CTR";
        $options = 0;


        $decryption_iv = '1234567891011121';

        $decryption_key = "Veter";

        $decryption = openssl_decrypt(
            $textoPorDesencriptar,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );

        return $decryption;
    }
}


?>