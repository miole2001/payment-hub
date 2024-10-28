<?php
include('boat-header.php');
?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Boat Reservation Approved Payments</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            Approved List
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
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM reservation WHERE r_id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'payment-approved.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the payment.'); window.location.href = 'payment-approved.php';</script>";
                        }
                        $stmt->close();
                    }

                    $sql = "SELECT * FROM reservation r 
                            INNER JOIN boats b ON b.b_id = r.b_id
                            INNER JOIN tourist t ON t.tour_id = r.tour_id
                            WHERE r.status = 'approved'";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['b_img']}</td>
                                <td>{$row['b_name']}</td>
                                <td>{$row['b_on']}</td>
                                <td>{$row['r_dstntn']}</td>
                                <td>{$row['b_price']}</td>
                                <td>{$row['r_date']}</td>
                                <td>{$row['r_hr']} {$row['r_ampm']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                <button class='btn btn-danger' onclick='confirmDelete({$row['r_id']})'>Delete</button>
                                </td> 
                                <td>{$count}</td>
                                </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No accounts found.</td></tr>";
                    }

                    $connection->close();
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</main>
<script>
    function confirmDelete(r_id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'payment-approved.php?delete_id=' + r_id;
        }
    }
</script>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>