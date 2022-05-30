<?php include('header.php'); ?>

<?php
ob_start();
require "connection.php";
$nameError = "";
$emailError = "";

function emailExists($pdo, $email)
{
  $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email=?");
  $stmt->execute([$email]);
  return $stmt->fetchColumn();
}
function check_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['signup'])) {
  $password = $_POST['password'];
  $confpassword = $_POST['confpassword'];
  $email = $_POST['email'];

  if ($password != $confpassword) {
    echo "<script type='text/javascript'>toastr.error(`Password don't match. Please try again`)</script>";
  } else if (emailExists($pdo, $email)) {
    echo "<script type='text/javascript'>toastr.error(`Email already exists, please login or use another email`)</script>";
  } else {
    if (empty($_POST["full_name"])) {
      $nameError = "Name is required";
    } else {
      $name = check_input($_POST["full_name"]);
      // check name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameError = "Only letters and white space allowed";
      }
    }
    if (empty($_POST["email"])) {
      $emailError = "Email is required";
    } else {
      $email = $_POST["email"];
      // check if e-mail address syntax is valid or not

    }

    $stmt = $pdo->prepare("INSERT INTO users(full_name, email, address, password, is_admin, dateJoined)
                VALUES(:full_name, :email, :address, :password, :is_admin, :dateJoined)");
    $criteria = [
      'full_name' => $_POST['full_name'],
      'email' => $_POST['email'],
      'address' => $_POST['address'],
      'is_admin' => 'client',
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
      'dateJoined' => date('Y-m-d h:i:s')
    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
      echo `<script type="text/javascript">toastr.success("Registered Sucessfully, Please login")</script>`;
      ('location:login.php');
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
                            <span class="error"> <?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="address" class="form-control" placeholder="Enter Address" required>

                        </div>
                        <div class="form-group mt-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                            <span class="error"> <?php echo $emailError; ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="confpassword" placeholder="Enter Password Again" required>
                        </div>

                        <div class="my-3">
                            <button type="submit" name="signup" class=" btn btn-primary">Register</button>
                            <a href="login.php" class="btn btn-light">Already have an account? Login here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Contact Section -->
<?php include('footer.php');

ob_end_flush();
?>