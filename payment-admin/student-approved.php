<?php
include('payment-header.php');

?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Dormitory Reservation Pending Payments</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            Pending List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                    <th>#</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Balance</th>
                        <th>Payment Amount</th>
                        <th>Remaining Balance</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Balance</th>
                        <th>Payment Amount</th>
                        <th>Remaining Balance</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM payment WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'student-approved.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the payment.'); window.location.href = 'student-approved.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch pending payments to display
                    $sql = "SELECT * FROM payment WHERE status = 'approved' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['student_id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['bill_balance']}</td>
                                <td>{$row['payment_amount']}</td>
                                <td>{$row['remaining_balance']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['payment_date']}</td>
                                <td>
                                    <button class='btn btn-danger' onclick='confirmDelete({$row['id']})'>Delete</button>
                                </td> 
                            </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No pending payments found.</td></tr>";
                    }

                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'student-approved.php?delete_id=' + id;
        }
    }

</script>

<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
