<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.02.2018
 * Time: 15:31
 */

$host = 'localhost'; // адрес сервера
$database = 'threads'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$link = mysqli_connect($host, $user, $password, $database)
    or die("Error " . mysqli_error($link));

