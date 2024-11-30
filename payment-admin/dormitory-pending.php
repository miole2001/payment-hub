<?php
include('payment-header.php');

// Handle the approval update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_id'])) {
    $approve_id = $_POST['approve_id'];

    // Prepare the SQL statement to update the status
    $stmt = $connection->prepare("UPDATE payments SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $approve_id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "<script>alert('Payment Approved!'); window.location.href = 'dormitory-pending.php';</script>";
    } else {
        echo "<script>alert('Approval Unsuccessful. Error: " . $stmt->error . "'); window.location.href = 'dormitory-pending.php';</script>";
    }

    $stmt->close();
}
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action(s)</th>
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
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM payments WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'dormitory-pending.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the payment.'); window.location.href = 'dormitory-pending.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch pending payments to display
                    $sql = "SELECT * FROM payments WHERE system_type = 'dormitory' AND status = 'pending' ORDER BY id DESC";
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
                                <td>
                                    <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#approveModal' 
                                        onclick='setApproveId({$row['id']})'>Approve</button>
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

<!-- Approval Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve this payment?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="dormitory-pending.php">
                    <input type="hidden" name="approve_id" id="approveId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'dormitory-pending.php?delete_id=' + id;
        }
    }

    function setApproveId(id) {
        document.getElementById('approveId').value = id;
    }
</script>

<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>