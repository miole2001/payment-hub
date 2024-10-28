<?php
include('payment-header.php');


// Handle the update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['user_type'];

    // Prepare the SQL statement
    $stmt = $connection->prepare("UPDATE accounts SET name = ?, email = ?, user_type = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $type, $id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "<script>alert('Update Successful!'); window.location.href = 'boat-accounts.php';</script>";
    } else {
        echo "<script>alert('Update Unsuccessful. Error: " . $stmt->error . "'); window.location.href = 'boat-accounts.php';</script>";
    }

    $stmt->close();
}

?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of All Accounts</h3>
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
                            echo "<script>alert('Delete Successful!'); window.location.href = 'boat-accounts.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the account.'); window.location.href = 'boat-accounts.php';</script>";
                        }
                        $stmt->close();
                    }
                    $sql = "SELECT * FROM accounts WHERE user_type = 'user boat' ORDER BY id DESC";
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
                                                <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' 
                                        onclick='editAccount({$row['id']}, \"" . addslashes($row['name']) . "\", \"" . addslashes($row['email']) . "\", \"" . addslashes($row['user_type']) . "\")'>Edit</button>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="boat-accounts.php">
                    <input type="hidden" name="id" id="accountId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="accountType" class="form-label">Account Type</label>
                        <select class="form-select" name="user_type" id="accountType" required>
                            <option value="user dormitory">Dormitory</option>
                            <option value="user boat">Boat</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'boat-accounts.php?delete_id=' + id;
        }
    }

    function editAccount(id, name, email, accountType) {
        document.getElementById('accountId').value = id;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;

        // Set the selected account type
        const accountTypeSelect = document.getElementById('accountType');
        accountTypeSelect.value = accountType; // Set the value to match the option
    }
</script>
<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>