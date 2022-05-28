<?php require "header.php"; ?>

<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['customer_id'])) {
  header('location:login.php');
}
?>

<?php
require "connection.php";

$customer_id = $_SESSION['customer_id'];

$booking = $pdo->prepare("SELECT * 
              FROM orders 
              WHERE u_id = $customer_id ");
$booking->execute();

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
                                <h3>Order List</h3>
                            </div>
                            <div class="sort">
                                <input type="text" class="sorts" id="myInput" onkeyup="myFunction()" placeholder="Search ...." title="Type in a name">
                            </div>
                        </div>

                        <table id="myTable">
                            <tr class="header">
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($booking as $row) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td><?php echo $row['order_status']; ?></td>
                                <?php if ($row['status'] == "0") { ?>

                                <td><?php echo "Still Pending"; ?></td>
                                <?php } else if ($row['status' == "1"]) {
                  ?> <td><?php echo "Verified"; ?>
                                </td>
                                <?php } ?>
                                <td><a <?php echo 'href="profile.php?view=' . $row['id'] . '"' ?>><i class="bi bi-recycle"></i></a></td>
                            </tr>
                            <?php } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "footer.php"; ?>