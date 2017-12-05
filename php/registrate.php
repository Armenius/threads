<?php
/**
 * Created by PhpStorm.
 * User: parmenion
 * Date: 21.11.17
 * Time: 13:18
 */
    echo $_POST['email'];
    echo $_POST['name'];
    echo $_POST['password'];

    include('db.php');

    $conn->query("INSERT INTO users ('email', 'password', 'nickname') VALUES (".$_POST['email'].",".$_POST['password'].",".$_POST['name']." )");

    $conn->close();

    header('Location: http://www.google.com/');

    ?>