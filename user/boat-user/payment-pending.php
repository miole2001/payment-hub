<?php     
    include('boat-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Boat Reservation Pending Payments</h3>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    // Fetch pending payments to display
                    $sql = "SELECT * FROM payments WHERE system_type = 'boat' AND status = 'pending' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['item']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['timestamp']}</td>
                            </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No pending payments found.</td></tr>";
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