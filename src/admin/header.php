<?php 

if (session_id() == '' || !isset($_SESSION)) {
	session_start();
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Car Rental</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>

<div class="top">
	<div class="nav" id="main-nav">
	  <input type="checkbox" id="nav-check">
	  <div class="nav-header">
	    <div class="nav-title">
	      Car Rental
	    </div>
	  </div>
	  <div class="nav-btn">
	    <label for="nav-check">
	      <span></span>
	      <span></span>
	      <span></span>
	    </label>
	  </div>
	  
	  <div class="nav-links" style="float:right; padding-top: 8px;">
	    <a class="adhome" href="index.php">Home</a>
	<?php  if (isset($_SESSION['admin_id'])) { ?>
		<a class="adhome" href="logout.php">Logout</a>
	<?php } ?>
	  </div>
	</div>
</div>

