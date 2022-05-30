<?php
ob_start();
include "header.php";
?>
<div>
    <?php
    if (isset($_SESSION['customer_id'])) {
        $member = $_SESSION['customer_id'];
    }

    if (isset($_GET['det'])) {
        $det = $_GET['det'];
        $del = $pdo->prepare("DELETE FROM wishlist_items WHERE id = '$det'");
        $del->execute();
        header('refresh:1;url=wishlist.php');
    }

    ?>
    <section class="content">
        <!-- ======= products Section ======= -->
        <section id="products" class="main products">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">
                        Wishlist</h3>

                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <?php
                            include "connection.php";
                            $stmt = $pdo->prepare("SELECT *   FROM wishlist_items c INNER JOIN products p ON c.product_id=p.p_id INNER JOIN users u ON c.user_id=u.u_id where u.u_id=$member ORDER BY c.id");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $row) {
                            ?>
                            <tbody>
                                <tr>
                                    <td> <img src="../assets/img/products/<?php echo $row['image_path']; ?>" style="height:50px;width:50px;" class="img-fluid" alt="image of product"></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo "$ " . number_format($row['price'], 2); ?></td>
                                    <td>
                                        <a style="font-size:20px;" class="text-danger" title="Delete Product" <?php echo 'href="wishlist.php?det=' . $row['id'] . '"' ?>> Delete</a>
                                    </td>
                                </tr>
                            </tbody>

                            <?php
                            } ?>
                        </table>
                    </div>

                </div>
            </div>
        </section><!-- End products Section -->


    </section>
</div>
<?php include "footer.php"; ?>