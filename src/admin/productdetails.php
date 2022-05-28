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

$certificate = $pdo->prepare("SELECT * 
            FROM products
            ");
$certificate->execute();

if (isset($_GET['det'])) {
    $det = $_GET['det'];
    $del = $pdo->prepare("DELETE FROM products WHERE p_id = '$det'");
    $del->execute();
    header('refresh:1;url=productdetails.php');
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
                    <div class="detail">
                        <div class="row">
                            <div class="sort1">
                                <h3>View Product Details</h3>
                            </div>
                            <div class="sort">
                                <input type="text" class="sorts" id="myInput" onkeyup="myFunction()" placeholder="Search ...." title="Type in a name">
                            </div>
                        </div>

                        <table id="myTable">
                            <tr class="header">
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($certificate as $row) { ?>
                            <tr>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo substr($row['description'], 0, 200); ?>...</td>
                                <td>
                                    <a style="font-size:20px;" title="Delete Product" <?php echo 'href="productdetails.php?det=' . $row['p_id'] . '"' ?>><i class="fas fa-recycle"></i></a>
                                    <a style="font-size:20px;" title="Update Product" <?php echo 'href="updateproduct.php?upd=' . $row['p_id'] . '"' ?>><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php require "../footer.php"; ?>