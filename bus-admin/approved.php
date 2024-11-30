<?php
include('bus-header.php');
?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>Bus Reservation Approved Payments</h3>
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
                        <th>Tourist</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Bus Name</th>
                        <th>Operation Name</th>
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
                        <th>Tourist</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Bus Name</th>
                        <th>Operation Name</th>
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
                                echo "<script>alert('Delete Successful!'); window.location.href = 'approved.php';</script>";
                            } else {
                                echo "<script>alert('Delete Unsuccessful. Error: " . $stmt->error . "'); window.location.href = 'approved.php';</script>";
                            }
                            $stmt->close();
                        }                    

                        // Fetch reservation details
                        $sql = "SELECT * FROM reservation r 
                                INNER JOIN boats b ON b.b_id = r.b_id
                                INNER JOIN tourist t ON t.tour_id = r.tour_id WHERE status = 'approved' AND system_type = 'bus'";
                        
                        $res = $connection->query($sql);

                        if ($res) {
                            $count = 1;
                            foreach ($res as $r) {
                                $r_id = $r['r_id'];
                                $tfn = $r['tour_fN'];
                                $tmn = $r['tour_mN'];
                                $tln = $r['tour_lN'];
                                $tcontact = $r['tour_contact'];
                                $taddress = $r['tour_address'];
                                $img = $r['b_img'];
                                $bn = $r['b_name'];
                                $bon = $r['b_on'];
                                $dstntn = $r['r_dstntn'];
                                $bprice = $r['b_price'];
                                $rdate = $r['r_date'];
                                $rhr = $r['r_hr'];
                                $rampm = $r['r_ampm'];
                                $status = $r['status'];
                                $oras = $rhr . ' ' . $rampm;

                                echo "
                                    <tr>
                                        <td>{$count}</td>
                                        <td class='align-img'>{$tfn} {$tmn} {$tln}</td>
                                        <td class='align-img'>{$tcontact}</td>
                                        <td class='align-img'>{$taddress}</td>
                                        <td class='align-img'><center><img src='{$img}' width='50' height='50'></center></td>
                                        <td class='align-img'>{$bn}</td>
                                        <td class='align-img'>{$bon}</td>
                                        <td class='align-img'>{$dstntn}</td>
                                        <td class='align-img'>{$rdate}</td>
                                        <td class='align-img'>{$oras}</td>
                                        <td class='align-img'>Php " . number_format($bprice, 2) . "</td>
                                        <td class='align-img'>{$status}</td>
                                        <td class='align-img'>
                                            <button class='btn btn-danger' onclick='confirmDelete({$r_id})'>Delete</button>
                                        </td>
                                    </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='13' class='text-center'>No pending payments found.</td></tr>";
                        }
                    
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</main>
<script>
    function confirmDelete(r_id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'approved.php?delete_id=' + r_id;
        }
    }
</script>
<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>