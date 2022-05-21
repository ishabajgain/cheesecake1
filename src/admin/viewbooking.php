<?php require "header.php"; ?>

<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['admin_id'])) {
  header('location:index.php');
}
?>

<?php
$con = mysqli_connect("localhost", "root", "", "vehicles");
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






require "../conection.php";
$booking = $pdo->prepare("SELECT * 
            FROM booking 
            -- JOIN vehicle v
            -- ON b.vehicle_ID = v.vehicle_ID
            -- JOIN user u
            -- ON b.user_ID = u.user_ID
            ORDER BY booking_ID DESC
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
                <th>Vehicle</th>
                <th>User</th>
                <th>Pickup Date</th>
                <th>Dropoff Date</th>
                <th>Location</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php foreach ($booking as $row) { ?>
                <tr>
                  <td><?php echo $row['vehicle_ID']; ?></td>
                  <td><?php echo $row['user_ID']; ?></td>
                  <td><?php echo $row['pickup']; ?></td>
                  <td><?php echo $row['dropoff']; ?></td>
                  <td><?php echo $row['location']; ?></td>
                  <td><?php echo $row['book_date']; ?></td>
                  <?php if ($row['status'] == "0") { ?>

                    <td><?php echo "Still Pending"; ?></td>
                  <?php } else if ($row['status' == "1"]) {
                  ?> <td><?php echo "Verified"; ?>
                    </td>
                  <?php } ?>
                  <td>
                    <a style="font-size:20px;" title="Delete Booking" <?php echo 'href="viewbooking.php?det=' . $row['booking_ID'] . '"' ?>><i class="fas fa-recycle"></i></a>

                    <?php
                    if ($row['status'] == 0) {
                      echo "<span class='btna'><a class='btn btn-success bt mb-2' href='?type=status&operation=deactive&id=" . $row['booking_ID'] . "'>Approved</a></span>&nbsp;";
                    } else {
                      echo "<span class='btnd'><a class='btn btn-warning bt mb-2' href='?type=status&operation=active&id=" . $row['booking_ID'] . "'>Disapproved</a></span>&nbsp;";
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









<?php require "footer.php"; ?>