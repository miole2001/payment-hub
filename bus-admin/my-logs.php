<?php
include('bus-header.php');
?>

<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>My Logs</h3>
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
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Activity</th>
                        <th>Timestamp</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM logs WHERE system_type = 'bus admin' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['activity_type']}</td>
                                            <td>{$row['timestamp']}</td>
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

<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>