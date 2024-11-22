<?php
    //to display errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    $id = $_SESSION['id'];
    
    include('../connection/connection.php');

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
        <title>Payment Hub | Super Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/dashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="payment-adminDashboard.php">Payment Hub</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="payment-adminDashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="all-accounts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                All Accounts
                            </a>

                            <!-- dormitory components -->
                            <a class="nav-link" href="dormitory-accounts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Dormitory Accounts
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Dormitory Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dormitory-pending.php">Pending</a>
                                    <a class="nav-link" href="dormitory-approved.php">Approved</a>
                                </nav>
                            </div>


                            <!-- boat reservation components -->
                            <a class="nav-link" href="boat-accounts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Boat Reservation Accounts
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Boat" aria-expanded="false" aria-controls="Boat">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Boat Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Boat" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="boat-pending.php">Pending</a>
                                    <a class="nav-link" href="boat-approved.php">Approved</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Student" aria-expanded="false" aria-controls="Student">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Student Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Student" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="student-pending.php">Pending</a>
                                    <a class="nav-link" href="student-approved.php">Approved</a>
                                </nav>
                            </div>

                            <!-- admin logs -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#AdminLogs" aria-expanded="false" aria-controls="AdminLogs">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Logs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="AdminLogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="boat-adminLogs.php">Boat Reservation</a>
                                    <a class="nav-link" href="dormitory-adminLogs.php">Dormitory Reservation</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="my-logs.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                My Logs
                            </a>

                            <a class="nav-link" href="../logout.php">
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