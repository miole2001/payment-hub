<?php
include('payment-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Boat User Logs</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            LOGS
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Activity</th>
                        <th>Timestamp</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Activity</th>
                        <th>Timestamp</th>
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM logs WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'boat-userLogs.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the account.'); window.location.href = 'boat-userLogs.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch student records to display
                    $sql = "SELECT * FROM logs WHERE system_type = 'user boat' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['activity_type']}</td>
                                            <td>{$row['timestamp']}</td>
                                            <td>
                                                <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                            </td> 
                                        </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No accounts found.</td></tr>";
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
            window.location.href = 'boat-userLogs.php?delete_id=' + id;
        }
    }
</script>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>