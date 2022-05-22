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


if (isset($_POST['login'])) {
    $customer = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $criteria = [
        'username' => $_POST['username']
    ];
    $fault = false;
    $customer->execute($criteria);
    if ($customer->rowCount() > 0) {
        $user = $customer->fetch();
        if (password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['admin'] = $user['username'];
            $_SESSION['admin_id'] = $user['admin_ID'];
            $_SESSION['admins'] = $user['name'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (1800);
            header('location:home.php');
        } else
            $fault = true;
    } else $fault = true;

    if ($fault == true) {
        echo "<script>alert('Username and Password doesn\'t matched!<br>Please try again!');</script>";
    }
}

?>


<section class="login">
    <div class="loginss">
        <div class="admlogin">
            <h2 class="admlgs">Car Rental</h2>
            <p class="admlgs1">Admin Login Form</p>
            <div>
                <form class="forms" method="POST" action="#">
                    <div class="form-control">
                        <div class="form1 admlog"><label>Username</label></div>
                        <div class="form2"><input type="text" name="username" required></div>
                    </div>
                    <div class="form-control">
                        <div class="form1 admlog"><label>Password</label></div>
                        <div class="form2"><input type="password" name="password" required></div>
                    </div>
                    <div class="form-control keep">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["admin_id"])) { ?> checked <?php } ?>><i></i>Keep me logged in
                        </label>
                    </div>
                    <div class="form-control logs">
                        <input type="submit" name="login" class="log" value="Log in">
                    </div>

                    <div class="extra">
                        <a href="../index.php" class="homes">Back Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require "../footer.php"; ?>