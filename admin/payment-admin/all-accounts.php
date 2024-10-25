<?php     
    include('payment-header.php');
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
                                echo "<script>alert('Delete Successful!'); window.location.href = 'all-accouts.php';</script>";
                            } else {
                                echo "<script>alert('Delete Unsuccessful. There was an error deleting the student.'); window.location.href = 'all-accouts.php';</script>";
                            }
                            $stmt->close();
                        }

                        // Fetch student records to display
                        $sql = "SELECT * FROM accounts WHERE user_type != 'payment admin' ORDER BY id DESC";
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
                                            <td>
                                                <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                            </td> 
                                        </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No accounts found.</td></tr>";
                        }

                        $connection->close();
                        ?>
                    </tbody>
                    <script>
                        function confirmDelete(id) {
                            if (confirm('Are you sure you want to delete this entry?')) {
                                window.location.href = 'all-accouts.php?delete_id=' + id;
                            }
                        }
                    </script>

                </table>
            </div>
        </div>


    </main>

<?php include("../../components/footer.php"); ?>
<?php include("../../components/scripts.php"); ?>