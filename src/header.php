<?php
$cssFile = "../static/css/style.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>
<?php
$cssFile = "../static/css/nav.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>

<nav>
    <div class="logo">
        <img src="../static/images/logo.png" alt="Logo Image">
    </div>
    <div class="hamburger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Our Products</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a class="login-button" href="login.php"> Login</a></li>
        <!-- <li><button class="join-button" href="#">Join</button></li> -->
    </ul>

</nav>
<script src="../static/js/nav.js"></script>