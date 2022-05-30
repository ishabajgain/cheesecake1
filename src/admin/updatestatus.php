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
$update = $pdo->query("SELECT * FROM orders WHERE id= '$upd'")->fetch();

if (isset($_POST['update'])) {

    $stmt = $pdo->prepare("UPDATE orders SET
        order_status = :order_status,
        pr_id=:pr_id,
        u_id=:u_id,
        total_quantity=:total_quantity,
        total_price=:total_price,
        created_at=:created_at
        WHERE id = $upd
      ");
    $criteria = [
        'order_status' => $_POST['order_status'],
        'pr_id' => $update['pr_id'],
        'u_id' => $update['u_id'],
        'total_quantity' => $update['total_quantity'],
        'created_at' => $update['created_at'],
        'total_price' => $update['total_price']
    ];

    $success = $stmt->execute($criteria);

    if ($success) {
        header("Location:vieworders.php");
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
                                    <h2 class="lgs">Update Order Status</h2>
                                    <div>
                                        <form class="forms" method="POST" action="">
                                            <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['customer_id']; ?>">
                                            <div class="form-control form-controlss">

                                                <div class="admform1"><label>Product Name</label></div>
                                                <div class="admform2">

                                                    <select name="order_status" <?php echo 'href="updatestatus.php?id=' . $row['id'] . '"' ?>>
                                                        <option value="Delivered"><?php echo "Delivered" ?></option>
                                                        <option value="Ready To Ship""><?php echo "Ready To Ship" ?></option>
                        <option value=" In Transit"><?php echo  "In Transit" ?></option>
                                                        <option value="Cancelled"><?php echo  "Cancelled" ?></option>
                                                    </select>
                                                </div>
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