<?php include "header.php";
?>
<div>
    <section class="content">
        <!-- ======= products Section ======= -->
        <section id="products" class="main products">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">
                        Your Cart</h3>

                </div>
                <div class="col-12">
                    <?php
                    include "connection.php";
                    $cid = $_GET['cid'];
                    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = $cid");

                    $stmt->execute();
                    foreach ($stmt as $row) {
                    ?>
                    <div class="row products-container products-inline-break" data-aos="fade-up" data-aos-delay="200">
                        <div class=" products-item filter-app">
                            <img src="../assets/img/products/<?php echo $row['image_path']; ?>" class="img-fluid" alt="image of product">
                            <div class="products-info">
                                <h4><?php echo $row['title']; ?></h4>
                                <p><?php echo "$ " . number_format($row['price'], 2); ?></p>
                                <a <?php echo 'href="productDescription.php?pid=' . $row['id'] . '"' ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <?php } ?>


                </div>
            </div>
        </section><!-- End products Section -->


    </section>
</div>
<?php include "footer.php"; ?>