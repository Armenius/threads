<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.03.2018
 * Time: 23:53
 */
require_once ('bd.php');
$uuid = 444;  // GIVE UUID HERE ARMEN !!!!!!!!!!!!!!!

//header('Content-type: text/privKey');
//header('Content-disposition: attachment;filename=privKey'.$uuid.'.txt');
//echo $privKey;
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 1024,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

$data = 'plaintext data goes here';

// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, $privKey);

echo $privKey;
echo $pubKey.'</br>';
echo $decrypted;
