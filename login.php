

<?php include_once('partials/header.php'); ?>
<link rel="stylesheet" type="text/css" href='css/style.css'>
<div class = "bg-image">
  <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-3">
          <img class="img-fluid text-center rounded-circle mb-3" src="assets/images/common/logo.png" alt="">
          <h1 class="text-center">Cheesecake System</h1>
        </div>
      </div>
         <form class="row g-3" method="post" action="lib/auth/login.php">
              <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required="required">
              </div>
              <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="password"  required="required">
              </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
            <a href="register.php" class="btn btn-light">Don't have an account? Register Now.</button>
        </form>
  </div>
</div>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
<?php include_once('partials/footer.php'); ?>


