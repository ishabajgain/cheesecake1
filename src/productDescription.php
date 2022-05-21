<?php include "header.php";
?>
<?php
require "connection.php";
$pid = $_GET['pid'];
$details = $pdo->query("SELECT * FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = $pid")->fetch();



if (isset($_POST['order'])) {

    // if (isset($_SESSION['customer_id'])) {
    //     $member = $_SESSION['customer_id'];
    // }

    $stmt = $pdo->prepare("INSERT INTO booking(pickup, dropoff, location, vehicle_ID, user_ID, status)
                VALUES(:pickup, :dropoff, :location, :vehicle_ID, :user_ID, '0')");
    $criteria = [
        'pickup' => $_POST['pickup'],
        'dropoff' => $_POST['dropoff'],
        'location' => $_POST['location'],
        'vehicle_ID' => $_POST['vehicle_ID'],
        'user_ID' => $member
    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
        echo "<script>alert('Thank your for booking Car Rental!!');</script>";
    }
}
?>



<section id="portfolio-details" class="main portfolio-details">


    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img <?php echo 'src="../assets/img/products/' . $details['image_path'] . '"'; ?> alt="image" class=" mt-1 img-fluid">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Cake Information</h3>
                    <ul>
                        <li><strong>Category:</strong> <?php echo  $details[8]; ?></li>
                        <li><strong>Name:</strong> <?php echo  $details['title']; ?></li>
                        <li><strong>Price:</strong> <?php echo "$ " . number_format($details['price'], 2); ?></li>
                    </ul>
                </div>
                <div class="portfolio-description">
                    <h2>Description</h2>
                    <p>
                        <?php echo  $details['description']; ?>
                    </p>
                </div>
                <div class="col-lg-12 col-md-8">
                    <h2>Add to cart</h2>
                    <div class="form">
                        <form action="" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="number" min=1 max=100 name="quantity" class="form-control" id="quantity" placeholder="Please enter quantity" required>
                            </div>
                            <div class="my-3">
                            </div>
                            <?php if (isset($_SESSION['id'])) { ?>
                            <div class="text-center"><button type="submit">Add to cart</button></div>
                            <?php } else { ?>
                            <input type="submit" name="signup" class="btns book" value="Book Now" disabled>
                            <small class="text-muted">Please login to booking</small>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Portfolio Details Section -->

<?php include "footer.php" ?>