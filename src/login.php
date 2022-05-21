<?php include('header.php'); ?>
<!-- ======= Login  Section ======= -->
<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['customer_id'])) {
?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
}
?>

<?php
require "connection.php";

if (isset($_POST['login'])) {
    $customer = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $criteria = [
        'email' => $_POST['email']
    ];
    $fault = false;
    $customer->execute($criteria);
    if ($customer->rowCount() > 0) {
        $user = $customer->fetch();
        if (password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['customer'] = $user['email'];
            $_SESSION['customer_id'] = $user['id'];
            $_SESSION['customers'] = $user['full_name'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (1800);
            header('location:index.php');
        } else {
            echo 'else';
            $fault = true;
        }
    } else $fault = true;
    echo 'else';

    if ($fault == true) {
        echo "<script>alert('Email address and Password doesn\'t matched!<br>Please try again!');</script>";
    }
}

?>


<body>
    <section id="login">
        <div class="container mt-5">
            <div class="section-header">
                <h3 class="section-title">Login</h3>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="form">
                        <form action="" method="post" class=" php-email-form">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>

                            <div class="my-3">

                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <a href="register.php" class="btn btn-light">Don't have an account? Register here </a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

</body>
<?php include('footer.php'); ?>