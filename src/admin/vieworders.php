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
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/php/product/');
define('SITE_PATH', '');

function get_safe_value($con, $str)
{
  if ($str != '') {
    $str = trim($str);
    return mysqli_real_escape_string($con, $str);
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

if (isset($_GET['delete'])) {
  $det = $_GET['det'];
  $del = $pdo->prepare("DELETE FROM orders WHERE u_id= '$det'");
  $del->execute();
  header('refresh:1;url=vieworders.php');
}

?>
<?php
if (isset($_PUT["status"])) {
  $id = $_GET['id'];
  $status = $_PUT["status"];
  print_r($update, $status);
  $del = $pdo->prepare("UPDATE FROM orders SET order_status =$status WHERE u_id= '$det'");
  $del->execute();
  // header('refresh:1;url=vieworders.php');
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
                  <td><?php echo $row['order_status']; ?></td>
                  <td>
                    <a style="font-size:20px;" name="delete" title="Delete Booking" <?php echo 'href="viewbooking.php?det=' . $row['id'] . '"' ?>>
                      <i class="fas fa-recycle"></i></a>

                    <select name="status" onchange="this.form.submit()" <?php echo 'href="viewbooking.php?id=' . $row['id'] . '"' ?>>
                      <option <?php if ($row['order_status'] == "Delivered") ?> value="Delivered"><?php echo "Delivered" ?></option>
                      <option <?php if ($row['order_status'] == "Ready To Ship") ?> value="Ready To Ship""><?php echo "Ready To Ship" ?></option>
                        <option <?php if ($row['order_status'] == "In Transit") ?> value=" In Transit"><?php echo  "In Transit" ?></option>
                      <option <?php if ($row['order_status'] == "Cancelled") ?> value="Cancelled"><?php echo  "Cancelled" ?></option>
                    </select>
                  <?php } ?>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>









<?php require "../footer.php"; ?>