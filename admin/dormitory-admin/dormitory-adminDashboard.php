<?php     
    include('dormitory-header.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>

        <div class="row mt-5">

            <!-- total dormitory accounts  -->
            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Dormitory Accounts</h2>
                        <?php
                            $query = "SELECT * FROM accounts WHERE user_type = 'user dormitory'";
                            $run_query = mysqli_query($connection, $query);

                            if ($run_query) {
                                $row = mysqli_num_rows($run_query);
                                echo '<h3>' . $row . '</h3>';
                            } else {
                                echo '<h3>Error: Could not retrieve data.</h3>';
                            }
                        ?>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Total Dormitory Payments -->
            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Dormitory Payments</h2>
                        <h3>12</h3>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                PAYMENT LOGS
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Date Registered</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Date Registered</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM accounts WHERE user_type = 'user dormitory' ORDER BY id DESC";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row['image']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['user_type']}</td>
                                            <td>{$row['date_registered']}</td>
                                        </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No students found.</td></tr>";
                        }

                        $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>