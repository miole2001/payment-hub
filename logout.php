<?php
// To display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("location: index.php");
exit();
?>