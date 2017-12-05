<?php
/**
 * Created by PhpStorm.
 * User: parmenion
 * Date: 28.11.17
 * Time: 12:56
 */

    $servername = "localhost";
    $username = "root";
    $password = "1223345kt";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

?>