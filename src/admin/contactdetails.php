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
$contact = $pdo->prepare("SELECT * 
            FROM contact ");
$contact->execute();

if (isset($_GET['det'])) {
  $det = $_GET['det'];
  $del = $pdo->prepare("DELETE FROM contact WHERE contact_ID = '$det'");
  $del->execute();
  header('refresh:1;url=contactdetails.php');
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
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
              </tr>
              <?php foreach ($contact as $row) { ?>
                <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email'];   ?></td>
                  <td><?php echo $row['subject']; ?></td>
                  <td><?php echo $row['message']; ?></td>
                  <td><a <?php echo 'href="contactdetails.php?det=' . $row['contact_ID'] . '"' ?>><i class="fas fa-recycle"></i></a></td>
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