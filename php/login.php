<?php
/**
 * Created by PhpStorm.
 * User: parmenion
 * Date: 21.11.17
 * Time: 13:21
 */
    include('db.php');

    $_POST['email'];
    $_POST['password'];

    mysqli_query ($conn,"INSERT INTO users ('email', 'password', 'nickname')");

