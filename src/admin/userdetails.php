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
require "../conection.php";
$certificate = $pdo->prepare("SELECT * 
            FROM user 
            LIMIT 15");
$certificate->execute();

if (isset($_GET['det'])) {
  $det = $_GET['det'];
  $del = $pdo->prepare("DELETE FROM user WHERE user_ID = '$det'");
  $del->execute();
  header('refresh:1;url=userdetails.php');
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
                <h3>View User Details</h3>
              </div>
              <div class="sort">
                <input type="text" class="sorts" id="myInput" onkeyup="myFunction()" placeholder="Search ...." title="Type in a name">
              </div>
            </div>

            <table id="myTable">
              <tr class="header">
                <th>S.No</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>License</th>
                <th>State</th>
                <th>Action</th>
              </tr>
              <?php foreach ($certificate as $row) { ?>
                <tr>
                  <td><?php echo $row['user_ID']; ?></td>
                  <td><?php echo $row['firstname'] . ' ' . $row['lastname']   ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['birth']; ?></td>
                  <td><?php echo $row['license']; ?></td>
                  <td><?php echo $row['state']; ?></td>
                  <td><a <?php echo 'href="userdetails.php?det=' . $row['user_ID'] . '"' ?>><i class="fas fa-recycle"></i></a></td>
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