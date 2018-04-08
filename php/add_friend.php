<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.02.2018
 * Time: 18:21
 */
session_start();
require_once 'bd.php';

function gen_uuid() {
    return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

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

$room_id = gen_uuid();

$mysqli->query("INSERT INTO relations( id_from, id_to, relations.uuid, is_verified) VALUES (".$_SESSION['id'].", ".$_POST['id'].",'".$room_id."', 0 );");
$mysqli->query("INSERT INTO pubkeys(id_from, id_to,pubkey) VALUES(".$_SESSION['id'].", ".$_POST['id'].", '".$pubKey."')");
$mysqli->close();

//$text='111211';

if ( !file_exists( "C:\\Users\\".getenv("username")."\\Downloads\\Threads\\".$room_id."_".$_POST['id'].".txt" ) ) { // если файл НЕ существует
    $fp = fopen ("C:\\Users\\".getenv("username")."\\Downloads\\Threads\\".$room_id."_".$_POST['id'].".txt", "w");
    fwrite($fp,$privKey);
    fclose($fp);
} else {
    echo 'FILE ALREADY EXISTS';
}

echo '<script>location.replace("../php/window.php");</script>'; exit;