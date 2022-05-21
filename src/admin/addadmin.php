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

if (isset($_POST['signup'])) {

    $stmt = $pdo->prepare("INSERT INTO admin(name, email, username, password)
              VALUES(:name, :email, :username, :password)");
    $criteria = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
        echo "<script>alert('Admin registered successfully.');</script>";
    }
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
                    <div>
                        <section>
                            <div class="apps">
                                <div class=" app" style="background: #001489;">
                                    <h2 class="lgs">Admin Form</h2>
                                    <div>
                                        <form class="forms" method="POST" action="">
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Admin Name</label></div>
                                                <div class="admform2"><input type="text" name="name" required></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Email</label></div>
                                                <div class="admform2"><input type="email" name="email" required></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Username</label></div>
                                                <div class="admform2"><input type="text" name="username" required></div>
                                            </div>

                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Password</label></div>
                                                <div class="admform2"><input type="password" name="password" required></div>
                                            </div>
                                            <div class="form-control logs logss appss">
                                                <input type="submit" name="signup" class="log" value="Add">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "footer.php"; ?>