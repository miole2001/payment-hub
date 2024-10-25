<?php 
    // connection for account
    $connection = mysqli_connect("localhost", "root", "", "payment_hub");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

?>