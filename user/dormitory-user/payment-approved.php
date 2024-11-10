<?php     
    include('dormitory-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Dormitory Reservation Approved Payments</h3>
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
                        <th>Account ID</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date Payment</th>
                        <th>Date Updated</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Account ID</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date Payment</th>
                        <th>Date Updated</th>
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php

                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM payment_list WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'payment-approved.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the account.'); window.location.href = 'payment-approved.php';</script>";
                        }
                        $stmt->close();
                    }
                    // Fetch payment records to display
                    $sql = "SELECT * FROM payment_list WHERE status = 'approved' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$count}</td>
                                    <td>{$row['account_id']}</td>
                                    <td>{$row['month_of']}</td>
                                    <td>{$row['amount']}</td>
                                    <td>{$row['status']}</td>
                                    <td>{$row['date_created']}</td>
                                    <td>{$row['date_updated']}</td>
                                    <td>
                                        <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                    </td> 
                                </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No accounts found.</td></tr>";
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
            window.location.href = 'payment-approved.php?delete_id=' + id;
        }
    }
</script>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>