<?php
require 'connection.php';

$admin_id = $_SESSION['customer_id'];
$userprofile = $pdo->prepare("SELECT * FROM users WHERE u_id = '$admin_id'");
$userprofile->execute();
?>


<div>
    <div class="center">
        <?php foreach ($userprofile as $row) { ?>
        <h2><?php echo $row['full_name'] ?></h2>
        <p><?php echo $row['email']; ?></p>
        <?php } ?>
    </div>
    <div>
        <ul class="users">
            <li class="users1"><a class="users2" href="home.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="users1"><a class="users2" href="#" style="position: relative;"><i class="fas fa-envelope"></i> Products</a>
                <ul class="dropdown">
                    <li><a href="addcategory.php">Add Categories</a></li>
                    <li><a href="viewcategory.php">View Categories</a></li>
                    <li><a href="addproduct.php">Add Products</a></li>
                    <li><a href="productdetails.php">View Products</a></li>
                </ul>
            </li>
            <li class="users1"><a class="users2" href="#" style="position: relative;"><i class="fas fa-envelope"></i> Booking Details</a>
                <ul class="dropdown">
                    <li><a href="vieworders.php">View Booking</a></li>
                </ul>
            </li>
            <li class="users1"><a class="users2" href="#" style="position: relative;"><i class="fas fa-user"></i> User Management</a>
                <ul class="dropdown">
                    <li><a href="userdetails.php">View Total Users</a></li>
                    <li><a href="contactdetails.php">View Contact</a></li>
                </ul>
            </li>
            <li class="users1"><a class="users2" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
</div>