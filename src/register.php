

<?php include_once('partials/header.php');?>>
		<link rel="stylesheet" type="text/css" href='css/style.css'>
		<meta name="viewport" content="width=device-width, initial-scale=1">	
 <div class="img">
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-3">
        <img class="img-fluid text-center rounded-circle mb-3" src="assets/images/common/logo.png" alt="">
        <h1 class="text-center">Not a member?</h1>
        <p>Sign Up</p><p>It is quick and easy</p>
      </div>
    </div>
      <div class="col-md-6">
        <label for="firstName" class="form-label">First name</label>
        <input type="text" class="form-control" id="firstName" name="FirstName" required="required">
      </div>
      <div class="col-md-6">
        <label for="lastName" class="form-label">Last name</label>
        <input type="text" class="form-control" id="lastName" name="LastName" required="required">
      </div>
      <div class="col-md-12">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="Email" required="required">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="Pass" required="required">
      </div>
         <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Confirm</label>
        <input type="password" class="form-control" id="inputPassword4" name="Pass" required="required">
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="u 10, Penshurst road" name="Address">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="Privacy" required="required">
        <label class="form-check-label" for="exampleCheck1">Accept term & privacy settings</label>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
      <a href="login.php" class="btn btn-light">Already have an account</button>
    </form>
  </div>


  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</div>
<?php include_once('partials/footer.php'); ?>


