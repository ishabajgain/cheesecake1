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
$con = mysqli_connect("localhost", "root", "", "cheesecakeshop");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/php/vehicle/');
define('SITE_PATH', '');

function get_safe_value($con, $str)
{
  if ($str != '') {
    $str = trim($str);
    return mysqli_real_escape_string($con, $str);
  }
}

if (isset($_GET['type']) && $_GET['type'] != '') {
  $type = get_safe_value($con, $_GET['type']);
  if ($type == 'status') {
    $operation = get_safe_value($con, $_GET['operation']);
    $id = get_safe_value($con, $_GET['id']);
    if ($operation == 'active') {
      $status = '0';
    } else {
      $status = '1';
    }
    $update_status_sql = "update booking set status='$status' where booking_ID='$id'";
    mysqli_query($con, $update_status_sql);
  }
}





require "../connection.php";

$booking = $pdo->prepare("SELECT * 
            FROM orders o 
            JOIN products p
            ON  o.pr_id = p.p_id
            JOIN users u
            ON o.u_id = u.u_id
            ORDER BY id DESC
              ");
$booking->execute();


//  $sql="select * from booking  


//     order by booking_ID asc";
// $res=mysqli_query($con,$sql); 

if (isset($_GET['det'])) {
  $det = $_GET['det'];
  $del = $pdo->prepare("DELETE FROM booking WHERE booking_ID = '$det'");
  $del->execute();
  header('refresh:1;url=viewbooking.php');
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
                                <h3>View Booking Details</h3>
                            </div>
                            <div class="sort">
                                <input type="text" class="sorts" id="myInput" onkeyup="myFunction()" placeholder="Search ...." title="Type in a name">
                            </div>
                        </div>

                        <table id="myTable">
                            <tr class="header">
                                <th>Product Name</th>
                                <th>User</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($booking as $row) { ?>
                            <tr>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['total_quantity']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <?php if ($row['order_status'] == "Delivered") { ?>

                                <td><?php echo "Delivered"; ?></td>
                                <?php } else if ($row['order_status' == "In Transit"]) {
                  ?> <td><?php echo "Cancelled"; ?>
                                </td>
                                <?php } ?>
                                <td>
                                    <a style="font-size:20px;" title="Delete Booking" <?php echo 'href="viewbooking.php?det=' . $row['id'] . '"' ?>><i class="fas fa-recycle"></i></a>

                                    <?php
                    if ($row['order_status'] == "Cancelled") {
                      echo "<span class='btna'><a class='btn btn-success bt mb-2' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Approved</a></span>&nbsp;";
                    } else {
                      echo "<span class='btnd'><a class='btn btn-warning bt mb-2' href='?type=status&operation=active&id=" . $row['id'] . "'>Disapproved</a></span>&nbsp;";
                    }
                    ?>
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









<?php require "../footer.php"; ?>