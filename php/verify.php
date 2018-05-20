<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.02.2018
 * Time: 17:12
 */

require_once 'bd.php';
$_GET['key'];
$_GET['login'];
echo "<p> ".$_GET['login']."</p>";

$mysqli->query("UPDATE users SET is_verified=1 WHERE password='".$_GET['key']."' and login='".$_GET['login']."';");
$mysqli->close();

echo '<script>location.replace("../templates/verified.html");</script>';
