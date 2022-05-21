<?php include "header.php";
?>
<?php
require "connection.php";
$pid = $_GET['pid'];
$details = $pdo->query("SELECT * FROM products p JOIN categories c ON p.category_id = c.id WHERE p.p_id = $pid")->fetch();



if (isset($_POST['order'])) {

    if (isset($_SESSION['customer_id'])) {
        $member = $_SESSION['customer_id'];
    }
    $stmt = $pdo->prepare("INSERT INTO cart(p_id,u_id,quantity)
                VALUES(:p_id, :u_id, :quantity)");
    $criteria = [
        'p_id' => $pid,
        'u_id' => $member,
        'quantity' => $_POST['quantity'],
    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
        echo "<script type='text/javascript'>toastr.success(`Added Successfully`)</script>";
    } else {
        echo "<script type='text/javascript'>toastr.error(`Something went wrong, unable to add product to cart`)</script>";
    }
}
?>



<section id="products-details" class="main products-details">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="products-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img <?php echo 'src="../assets/img/products/' . $details['image_path'] . '"'; ?> alt="image" class=" mt-1 img-fluid">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="products-info">
                    <h3>Cake Information</h3>
                    <ul>
                        <li><strong>Category:</strong> <?php echo  $details['title']; ?></li>
                        <li><strong>Name:</strong> <?php echo  $details['product_name']; ?></li>
                        <li><strong>Price:</strong> <?php echo "$ " . number_format($details['price'], 2); ?></li>
                    </ul>
                </div>
                <div class="products-description">
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
                            <?php if (isset($_SESSION['customer_id'])) { ?>
                            <div class="text-center"><button name="order" type="submit">Add to cart</button></div>
                            <?php } else { ?>
                            <input type="submit" name="order" class="btns book" value="Add to cart" disabled>
                            <small class="text-muted">Please login to booking</small>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End products Details Section -->

<?php include "footer.php" ?>