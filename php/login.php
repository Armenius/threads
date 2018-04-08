<?php
/**
 * Created by PhpStorm.
 * User: parmenion
 * Date: 21.11.17
 * Time: 13:21
 */
    session_start();

    require_once 'bd.php';
    $_POST['email'];
    $_POST['password'];
    if ($mysqli->connect_errno) {
        printf("Error during connection: %s\n", $mysqli->connect_error);
        exit();
    }

    $result = $mysqli->query("SELECT * FROM users WHERE email='".$_POST['email']."' and password='".sha1($_POST['password'])."'");
    $data = $result->fetch_all();
    $_SESSION['id'] = $data[0][0];
    $_SESSION['login'] = $data[0][1];
    $_SESSION['photo'] = $data[0][4];
//    echo $data[0][0] + '<br>';
//    echo $data[0][1];
//    echo $data[0][5];
    if ($data[0][5] == 1){
        echo '<script>location.replace("../php/window.php");</script>';
    }
    else if($data[0][5] === 0){
        echo '<script>location.replace("../templates/verification_problem.html");</script>';
    }
    else
        echo '<script>location.replace("../templates/data_problem.html");</script>';

    $mysqli->close();