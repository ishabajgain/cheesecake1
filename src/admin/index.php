<?php require "header.php"; ?>


<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['customer_id'])) {
    header('location:index.php');
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
                    <div class="welcome">
                        <h2>Welcome to the Dashboard of Cheesecake Shop</h2>
                    </div>

                    <div class="row">
                        <div class="dash1">
                            <div class="record1">
                                <div class="row tls">
                                    <div class="total">
                                        <h2>Total</h2>
                                    </div>
                                    <div class="data">
                                        <p>Products</p>
                                    </div>
                                </div>
                                <div class="row tlss">
                                    <div class="da">
                                        <?php
require "../connection.php";

$total = $pdo->query("SELECT count(*) as total FROM products")->fetch();
?>
                                        <span><?php echo $total['total']; ?></span><br>
                                        <a href="productdetails.php" class="vi">View Details</a>
                                    </div>
                                    <div class="graph">
                                        <span><i class="fas fa-signal"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash1">
                            <div class="record2">
                                <div class="row tls">
                                    <div class="total">
                                        <h2>Total</h2>
                                    </div>
                                    <div class="data">
                                        <p>Users</p>
                                    </div>
                                </div>
                                <div class="row tlss">
                                    <div class="da">
                                        <?php
require "../connection.php";

$verify = $pdo->query("SELECT count(*) as verify FROM users")->fetch();
?>
                                        <span><?php echo $verify['verify']; ?></span><br>
                                        <a href="userdetails.php" class="vi">View Details</a>
                                    </div>
                                    <div class="graph">
                                        <span><i class="fas fa-signal"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash1">
                            <div class="record3">
                                <div class="row tls">
                                    <div class="total">
                                        <h2>Total</h2>
                                    </div>
                                    <div class="data">
                                        <p>Booking</p>
                                    </div>
                                </div>
                                <div class="row tlss">
                                    <div class="da">
                                        <?php
require "../connection.php";

$pending = $pdo->query("SELECT count(*) as pending FROM orders")->fetch();
?>
                                        <span><?php echo $pending['pending']; ?></span><br>
                                        <a href="viewbooking.php" class="vi">View Details</a>
                                    </div>
                                    <div class="graph">
                                        <span><i class="fas fa-signal"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash1">
                            <div class="record4">
                                <div class="row tls">
                                    <div class="total">
                                        <h2>Total</h2>
                                    </div>
                                    <div class="data">
                                        <p>Categories</p>
                                    </div>
                                </div>
                                <div class="row tlss">
                                    <div class="da">
                                        <?php
require "../connection.php";

$category = $pdo->query("SELECT count(*) as category FROM categories")->fetch();
?>
                                        <span><?php echo $category['category']; ?></span><br>
                                        <a href="viewcategory.php" class="vi">View Details</a>
                                    </div>
                                    <div class="graph">
                                        <span><i class="fas fa-signal"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "../footer.php"; ?>