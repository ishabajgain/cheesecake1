<?php include('header.php'); ?>

<?php
require "connection.php";

function emailExists($pdo, $email)
{
  $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email=?");
  $stmt->execute([$email]);
  return $stmt->fetchColumn();
}

const NAME_REQUIRED = 'Please enter your name';
const EMAIL_REQUIRED = 'Please enter your email';
const EMAIL_INVALID = 'Please enter a valid email';

if (isset($_POST['signup'])) {
  $password = $_POST['password'];
  $confpassword = $_POST['confpassword'];
  $email = $_POST['email'];


  if ($password != $confpassword) {
    echo "<script type='text/javascript'>toastr.error(`Password don't match. Please try again`)</script>";
  } else if (emailExists($pdo, $email)) {
    echo "<script type='text/javascript'>toastr.error(`Email already exists, please login or use another email`)</script>";
  } else {
    $stmt = $pdo->prepare("INSERT INTO users(full_name, email, address, password, is_admin)
                VALUES(:full_name, :email, :address, :password, :is_admin)");
    $criteria = [
      'full_name' => $_POST['full_name'],
      'email' => $_POST['email'],
      'address' => $_POST['address'],
      'is_admin' => false,
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
      header('location:login.php');
      echo `<script type="text/javascript">toastr.success("Registered Sucessfully, Please login")</script>`;
    }
  }
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<section id="login">
    <div class="container mt-5">
        <div class="section-header">
            <h3 class="section-title">Register</h3>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="form">
                    <form action="#" method="POST" role="form" class="php-email-form">
                        <div class="form-group mt-3">
                            <input type="text" name="full_name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="address" class="form-control" placeholder="Enter Address" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="confpassword" placeholder="Enter Password Again" required>
                        </div>

                        <div class="my-3">
                            <button type="submit" name="signup" class=" btn btn-primary">Login</button>
                            <a href="login.php" class="btn btn-light">Don't have an account? Signup here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Contact Section -->
<?php include('footer.php'); ?>