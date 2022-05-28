<?php
require 'connection.php';

$customer_id = $_SESSION['customer_id'];
$userprofile = $pdo->prepare("SELECT * FROM users WHERE u_id = '$customer_id'");
$userprofile->execute();
?>
<link href="../assets/css/adminStyle.css" rel="stylesheet">


<div>

    <div class="center">
        <!-- <img src="../assets/img/avatar.png" alt="avatar" class="img-fluid"> -->
        <?php foreach ($userprofile as $row) { ?>
        <h2><?php echo $row['full_name'] ?></h2>
        <p><?php echo $row['email']; ?></p>
        <?php } ?>
    </div>
    <div>
        <ul>
            <li class="users1"><a class="users2" href="index.php"><i class="bi bi-house-fill"></i> Home</a></li>
            <li class="users1"><a class="users2" href="profile.php" style="position: relative;"><i class="bi bi-envelope"></i> Order List</a>
            </li>
            <li class="users1"><a class="users2" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
        </ul>
    </div>
</div>