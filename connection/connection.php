<?php 
    // connection for account
    $connection = mysqli_connect("localhost", "root", "", "payemnt_hub");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

?>