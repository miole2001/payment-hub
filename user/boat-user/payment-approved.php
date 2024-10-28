<?php     
    include('boat-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Boat Reservation Approved Payments</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            Search your name or email to check your payments.
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                        <th>#</th>
                        <th>Boat Image</th>
                        <th>Boat Name</th>
                        <th>Boat Operation Name</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Boat Image</th>
                        <th>Boat Name</th>
                        <th>Boat Operation Name</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reservation r 
                            INNER JOIN boats b ON b.b_id = r.b_id
                            INNER JOIN tourist t ON t.tour_id = r.tour_id
                            WHERE r.status = 'pending'";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['b_img']}</td>
                                <td>{$row['b_name']}</td>
                                <td>{$row['b_on']}</td>
                                <td>{$row['r_dstntn']}</td>
                                <td>{$row['b_price']}</td>
                                <td>{$row['r_date']}</td>
                                <td>{$row['r_hr']} {$row['r_ampm']}</td>
                                <td>{$row['status']}</td>
                            </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No pending payments found.</td></tr>";
                    }

                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>