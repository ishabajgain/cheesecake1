  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title>Cheesecake shop</title>
      <meta content="" name="description">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="../assets/img/logo.png" rel="icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
      <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
      <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

      <!-- Template Main CSS File -->
      <link href="../assets/css/style.css" rel="stylesheet">
  </head>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex justify-content-between align-items-center">

          <div id="logo">
              <a href="index.php"><img src="../assets/img/logo.png" class="w-25 h-25" alt=""></a>
              <!-- Uncomment below if you prefer to use a text logo -->
              <!--<h1><a href="index.html">Regna</a></h1>-->
          </div>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto" href="index.php">Home</a></li>
                  <li><a class="nav-link scrollto" href="aboutus.php">About</a></li>

                  <li class="dropdown"><a href="#"><span>Products</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <?php
                            include "connection.php";
                            $stmt = $pdo->prepare("SELECT * FROM categories WHERE id");
                            $stmt->execute();
                            foreach ($stmt as $row) {
                            ?>
                          <li>
                              <a href="products.php?cid=<?php echo $row['id']; ?>"> <?php echo $row['title']; ?></a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  <li><a class="nav-link scrollto" href="cart.php">Cart</a></li>
                  <li><a class="nav-link scrollto" href="login.php">Login</a></li>
                  <!-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>

          </nav><!-- .navbar -->
      </div>
  </header><!-- End Header -->

  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>