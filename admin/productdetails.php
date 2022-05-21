<?php require "header.php"; ?>


<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['customer_id'])) {
    header('location:index.php');
}
?>
<?php
require "../src/connection.php";

$certificate = $pdo->prepare("SELECT * 
            FROM vehicle
            ");
$certificate->execute();

if (isset($_GET['det'])) {
    $det = $_GET['det'];
    $del = $pdo->prepare("DELETE FROM vehicle WHERE vehicle_ID = '$det'");
    $del->execute();
    header('refresh:1;url=vehicledetails.php');
}
?>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="first">
                <?php require "sidebar.php"; ?>
            </div>
            <div class="second">
                <div class="right">
                    <div class="detail">
                        <div class="row">
                            <div class="sort1">
                                <h3>View Vehicle Details</h3>
                            </div>
                            <div class="sort">
                                <input type="text" class="sorts" id="myInput" onkeyup="myFunction()" placeholder="Search ...." title="Type in a name">
                            </div>
                        </div>

                        <table id="myTable">
                            <tr class="header">
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Type</th>
                                <th>Engine</th>
                                <th>Status</th>
                                <th>Features</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($certificate as $row) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['brand']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['engine']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['features']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo substr($row['description'], 0, 200); ?>...</td>
                                    <td>
                                        <a style="font-size:20px;" title="Delete Vehicle" <?php echo 'href="vehicledetails.php?det=' . $row['vehicle_ID'] . '"' ?>><i class="fas fa-recycle"></i></a>
                                        <a style="font-size:20px;" title="Update Vehicle" <?php echo 'href="updatevehicle.php?upd=' . $row['vehicle_ID'] . '"' ?>><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "../src/footer.php"; ?>