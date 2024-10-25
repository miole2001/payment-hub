<?php
include('payment-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of Dormitory Accounts</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            Accounts
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
                        <th>Action(s)</th>
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
                        <th>Action(s)</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM accounts WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'dormitory-accounts.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the account.'); window.location.href = 'dormitory-accounts.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch student records to display
                    $sql = "SELECT * FROM accounts WHERE user_type = 'user dormitory' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                            <td>{$count}</td>
                                            <td><img src='../../images/" . $row['image'] . "' alt='User Image' class='user-image' style='width: 100px; height: auto;'></td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['user_type']}</td>
                                            <td>{$row['date_registered']}</td>
                                            <td>
                                                <button class='btn btn-warning' onclick='openEditModal({$row['id']}, \"{$row['name']}\", \"{$row['email']}\", \"{$row['user_type']})'>Edit</button>
                                                <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                            </td> 
                                        </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No accounts found.</td></tr>";
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
            window.location.href = 'dormitory-accounts.php?delete_id=' + id;
        }
    }
</script>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>