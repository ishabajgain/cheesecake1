<?php
require '../connection.php';

$admin_id = $_SESSION['customer_id'];
$userprofile = $pdo->prepare("SELECT * FROM users WHERE u_id = '$admin_id'");
$userprofile->execute();
?>


<div>
    <div class="center">
        <img src="../image/avatar.png" alt="avatar" class="img-fluid adimg">
        <?php foreach ($userprofile as $row) { ?>
        <h2><?php echo $row['name'] ?></h2>
        <p><?php echo $row['email']; ?></p>
        <?php } ?>
    </div>
    <div>
        <ul class="users">
            <li class="users1"><a class="users2" href="home.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="users1"><a class="users2" href="addadmin.php"><i class="fas fa-user"></i> Admin</a></li>
            <li class="users1"><a class="users2" href="#" style="position: relative;"><i class="fas fa-envelope"></i> Vehicle</a>
                <ul class="dropdown">
                    <li><a href="addcategory.php">Add Categories</a></li>
                    <li><a href="viewcategory.php">View Categories</a></li>
                    <li><a href="addvehicle.php">Add Vehicles</a></li>
                    <li><a href="vehicledetails.php">View Vehicles</a></li>
                </ul>
            </li>
            <li class="users1"><a class="users2" href="#" style="position: relative;"><i class="fas fa-envelope"></i> Booking Details</a>
                <ul class="dropdown">
                    <li><a href="viewbooking.php">View Booking</a></li>
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