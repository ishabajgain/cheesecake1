<?php include "header.php";
?>

<body>
    <section id="products" class="content">
        <!-- ======= products Section ======= -->
        <section id="products" class="main products">
            <div class="container" data-aos="fade-up">

                <div class="col-12">
                    <?php
                    include "connection.php";

                    $stmt = $pdo->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    array_unshift($result, []);

                    foreach ($result as $row) {
                    ?>

                        <div class="row products-container products-inline-break" data-aos="fade-up" data-aos-delay="200">
                            <div class=" products-item filter-app">
                                <a <?php echo 'href="productDescription.php?pid=' . $row['p_id'] . '"' ?>>
                                    <img src="../assets/img/products/<?php echo $row['image_path']; ?>" class="img-fluid" alt="image of product"></a>
                                <div class="products-info">
                                    <h4><?php echo $row['product_name']; ?></h4>
                                    <p><?php echo "$ " . number_format($row['price'], 2); ?></p>
                                    <a <?php echo 'href="wishlist.php?pid=' . $row['p_id'] . ' ' ?> calss="details-link" title="wishlist"><i class="bi bi-heart"></i> </a>
                                    <a <?php echo 'href="productDescription.php?pid=' . $row['p_id'] . '"' ?> class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php

                    } ?>
                </div>
            </div>
        </section><!-- End products Section -->


    </section>
</body>
<?php include_once("footer.php"); ?>