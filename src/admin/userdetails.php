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
require "../connection.php";
$certificate = $pdo->prepare("SELECT * 
            FROM users
            LIMIT 15");
$certificate->execute();

if (isset($_GET['det'])) {
    $det = $_GET['det'];
    $del = $pdo->prepare("DELETE FROM users WHERE u_id = '$det'");
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
                                <th>User Id</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Address</th>

                                <th>Action</th>
                            </tr>
                            <?php $sn = 0; ?>
                            <?php foreach ($certificate as $row) { ?>
                                <tr>
                                    <td><?php echo $sn + 1 ?></td>
                                    <td><?php echo $row['full_name']   ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><a <?php echo 'href="userdetails.php?det=' . $row['u_id'] . '"' ?>><i class="fas fa-recycle"></i></a></td>
                                </tr>
                            <?php $sn++;
                            } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "../footer.php"; ?>