<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.03.2018
 * Time: 23:44
 */
session_start();
require_once ('bd.php');
// Proccess of creating and saving keys
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 1024,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];
$mysqli->query("INSERT INTO pubkeys(id_from, id_to, pubkey) VALUES(".$_SESSION['id'].", ".$_GET['fid'].", '".$pubKey."')");

if ( !file_exists( "C:\\Users\\".getenv("username")."\\Downloads\\Threads\\".$_GET['uuid']."_".$_GET['fid'].".txt" ) ) { // если файл НЕ существует
    $fp = fopen ("C:\\Users\\".getenv("username")."\\Downloads\\Threads\\".$_GET['uuid']."_".$_GET['fid'].".txt", "w");
    fwrite($fp,$privKey);
    fclose($fp);
}


$mysqli->query("UPDATE relations SET relations.is_verified=1 WHERE uuid='" . $_GET['uuid'] . "';");

$mysqli->close();

echo '<script>location.replace("window.php");</script>';
