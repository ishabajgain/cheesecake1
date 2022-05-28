<?php require "header.php"; ?>



<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['customer_id'])) {
    header('location:index.php');
}
?>
<?php
require "../connection.php";


$upd = $_GET['upd'];
$update = $pdo->query("SELECT * FROM products WHERE p_id= '$upd'")->fetch();

if (isset($_POST['update'])) {

    $stmt = $pdo->prepare("UPDATE products SET
        product_name = :name,
        price = :price,
        description = :description
        WHERE p_id = :upd
      ");
    $criteria = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
        'upd' => $_GET['upd']
    ];

    $success = $stmt->execute($criteria);

    if ($success) {
        header("Location:productdetails.php");
    }
}
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="first">
                <?php require "sidebar.php"; ?>
            </div>
            <div class="second">
                <div class="right">
                    <div>
                        <section>
                            <div class="apps">
                                <div class=" app" style="background: #001489;">
                                    <h2 class="lgs">Update Product</h2>
                                    <div>
                                        <form class="forms" method="POST" action="">
                                            <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['admin_id']; ?>">
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Product Name</label></div>
                                                <div class="admform2"><input type="text" name="name" value="<?php echo $update['product_name']; ?>" required></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Price</label></div>
                                                <div class="admform2"><input type="text" name="price" value="<?php echo $update['price']; ?>" required></div>
                                            </div>


                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Description</label></div>
                                                <div class="admform2"><textarea name="description" rows="6"><?php echo $update['description']; ?></textarea></div>
                                            </div>
                                            <div class="form-control logs logss appss">
                                                <input type="submit" name="update" class="log" value="Update products">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








<?php require "../footer.php"; ?>