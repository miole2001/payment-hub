<?php
    //to display errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    $id = $_SESSION['id'];
    
    include('../../connection/connection.php');

    $sql = "SELECT * FROM accounts WHERE id = $id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die('Account not found.');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Payment Hub | USER</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../css/dashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="payment-approved.php">Payment Hub</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Payments</div>
                            <a class="nav-link" href="payment-pending.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                Pending Payments
                            </a>
                            <a class="nav-link" href="payment-approved.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                Approved Payments
                            </a>
                            <div class="sb-sidenav-menu-heading">Logs</div>
                            <a class="nav-link" href="my-logs.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                                Logs
                            </a>
                            <a class="nav-link" href="../../logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                            <?php echo $user['name']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">