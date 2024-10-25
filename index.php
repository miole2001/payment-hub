<?php
  include("./connection/connection.php");
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["login-email"];
      $password = $_POST["login-password"];

      $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($connection, $sql);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        
        // user boat
        if ($row["user_type"] == "user boat") {
            $_SESSION['id'] = $row['id'];
            $_SESSION["email"] = $email;
            header("location: user/boat-user/boat-userDashboard.php");
        } 

        //user dormitory
        elseif ($row["user_type"] == "user dormitory"){
            $_SESSION['id'] = $row['id'];
            $_SESSION["email"] = $email;
            header("location: user/dormitory-user/dormitory-userDashboard.php");
        }
        
        //admin payment
        elseif ($row["user_type"] == "payment admin") {
            $_SESSION['id'] = $row['id'];
            $_SESSION["email"] = $email;
            header("location: admin/payment-admin/payment-adminDashboard.php");
        } 

        //admin boat
        elseif ($row["user_type"] == "boat admin") {
          $_SESSION['id'] = $row['id'];
          $_SESSION["email"] = $email;
          header("location: admin/boat-admin/boat-adminDashboard.php");
      } 

      //admin dormitory
      elseif ($row["user_type"] == "dormitory admin") {
        $_SESSION['id'] = $row['id'];
        $_SESSION["email"] = $email;
        header("location: admin/dormitory-admin/dormitory-adminDashboard.php");
      } 
        
        else {
            echo "invalid";
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="./css/login.css" />
    <title>Login | Payment Hub</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form login">
          <span class="title">Login</span>

          <form action="#" method="post">
            <div class="input-field">
              <input type="text" placeholder="Enter your email" name="login-email" required />
              <i class="uil uil-envelope icon"></i>
            </div>
            <div class="input-field">
              <input type="password" class="password" placeholder="Enter your password" name="login-password" required />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>

            <div class="input-field button">
              <input type="submit" value="Login" />
            </div>
          </form>

          <div class="login-signup">
            <span class="text">
              Not a member?
              <a href="register.php" class="text">Signup Now</a>
            </span>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/login.js"></script>
  </body>
</html>