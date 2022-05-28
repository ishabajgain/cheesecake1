<?php include "header.php";
?>
<div>
    <?php
    if (isset($_SESSION['customer_id'])) {
        $member = $_SESSION['customer_id'];
    }

    if (isset($_POST['checkout'])) {
        echo "hello";
        if (isset($_SESSION['customer_id'])) {
            $member = $_SESSION['customer_id'];
        }

        $stmt = $pdo->prepare("INSERT INTO orders(u_id, order_status, pr_id,total_quantity, total_price)
                VALUES($member, :order_status, :order_status,:pr_id,:total_quantity,:total_price)");
        $criteria = [
            'pr_id' => $row['id'],
            'order_status' => null,
            'total_quantity' => $row["sum(quantity)"],
            'total_price' => $row["sum(price)"],
        ];
        $stmt->execute($criteria);
        if ($stmt == true) {
            echo "<script>alert('Thank your for placing an order!!');</script>";
        }
    }

    if (isset($_GET['det'])) {
        $det = $_GET['det'];
        $del = $pdo->prepare("DELETE FROM cart WHERE id = '$det'");
        $del->execute();
        header('refresh:1;url=cart.php');
    }
    ?>

    ?>
    <section class="content">
        <!-- ======= products Section ======= -->
        <section id="products" class="main products">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">
                        Your Cart</h3>

                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>

                            <?php
                            include "connection.php";
                            $stmt = $pdo->prepare("SELECT *   FROM cart c INNER JOIN products p ON c.p_id=p.p_id INNER JOIN users u ON c.u_id=u.u_id where u.u_id=$member ORDER BY c.id");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $row) {
                            ?>
                            <tbody>
                                <tr>

                                    <td> <img src="../assets/img/products/<?php echo $row['image_path']; ?>" style="height:50px;width:50px;" class="img-fluid" alt="image of product"></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo "$ " . number_format($row['price'], 2); ?></td>
                                    <td><?php echo $row['quantity']; ?></td>

                                    <td>
                                        <a style="font-size:20px;" class="text-danger" title="Delete Product" <?php echo 'href="cart.php?det=' . $row['id'] . '"' ?>> Delete</a>
                                    </td>

                                </tr>
                            </tbody>
                            <?php
                            } ?>
                            <?php
                            $stmt = $pdo->prepare("SELECT sum(price),sum(quantity)   
                                        FROM cart c INNER JOIN products p ON c.p_id=p.p_id INNER JOIN users u ON c.u_id=u.u_id where u.u_id=$member ORDER BY c.id");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $row) {
                            ?>
                            <td><b>Total</b></td>
                            <td></td>
                            <td>
                                <?php echo "$ " . number_format($row["sum(price)"], 2); ?>
                            </td>
                            <td> <?php echo $row["sum(quantity)"]; ?>
                            </td>
                            <td></td>
                            <tr>
                                <td>Grand Total:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> <?php echo "$ " . number_format($row["sum(price)"] * $row["sum(quantity)"], 2); ?>
                                </td>
                                <td> <a href="payment.php" button type="submit" name="checkout"> Checkout</button></td>
                            </tr>
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