<?php
    require 'vendor/autoload.php';
    use phpseclib\Crypt\RSA;
    use phpseclib\Math\BigInteger;

    $c = "<c>";
    $taPublicKey = "rxHJAejXwDpyWwjsMzL7D1WJ/rDCaiqvsiiHZA+8nnVHVD65oWB9HH1O+ONuhhSblWBNKB0YWeA47cS0JisTizZAvXHfRNC2Sp9ZnSQvtA67GKPZsTsvOS2AlrExvYHc7ibwVVvLoz/ByJV/N7w5lBABmu57aFuIa4GEWPfb677dqnv695D1qlbJwTI+BjPk/OPHXuudYG1bi1uE7goqStX/fL6D0joXnzzMzs2ZdUKMAV/zC/kaILlAe5qA1q3aQQfd8h+gkYCskjfOrp38abNCe/DFXceq9qQ3R5YkviCxQAZJBZYzD1FjtTsOG7xIV4uoQLJjHzsJaQLkDdrwYwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABAAE=";

    function getPublicKey(string $taPublicKey)
    {
        $key = base64_decode($taPublicKey);
        $unsignedPrefix = "\x00";
        $modulus1 = new BigInteger($unsignedPrefix . substr($key, 0, 256), 256);
        $exponent1 = new BigInteger(substr($key, 256, 256), 256);
        $rsa = new RSA();
        $rsa->loadKey(['n' => $modulus1, 'e' => $exponent1]);
        return $rsa;
    }

    $publicKey = getPublicKey($taPublicKey);
    $input = sprintf("%s%s", "00000000", $c);
    $publicKey->setEncryptionMode(RSA::ENCRYPTION_OAEP);
    $cipherText = $publicKey->encrypt($input);

    echo base64_encode($cipherText);
