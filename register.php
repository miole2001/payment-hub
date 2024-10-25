<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('./connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $image = $_POST["image"]; // Assuming you'll handle this differently
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $type = $_POST["type"];

    // Check if passwords match
    if ($password === $confirm_password) {
        // Prepare SQL statement
        $register = "INSERT INTO `accounts`(`image`, `name`, `email`, `password`, `user_type`, `date_registered`)
                     VALUES ('$image', '$name', '$email', '$password', '$type', NOW())";

        // Execute the query
        if (mysqli_query($connection, $register)) {
            header("Location: index.php");
            exit; // Ensure no further code is executed after redirection
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "<script> alert('Passwords do not match'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration | Payment Hub</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form action="" method="post">
            <div class="input-box">
                <input type="text" placeholder="Enter your image" name="image" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Enter your name" name="name" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Enter your email" name="email" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Create password" name="password" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Confirm password" name="confirm-password" required>
            </div>
            <div class="input-box">
                <select name="type" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="user dormitory">Dormitory Account</option>
                    <option value="user boat">Boat Reservation Account</option>
                </select>
            </div>
            <div class="input-box button">
                <input type="submit" value="Register Now">
            </div>
            <div class="text">
                <p>Already have an account? <a href="index.php">Login now</a></p>
            </div>
        </form>
    </div>
</body>
</html>
