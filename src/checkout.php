<?php include "header.php";
?>
<div>
    <?php
    include "connection.php";

    if (isset($_SESSION['customer_id'])) {
        $member = $_SESSION['customer_id'];
    }
    $cid = $_GET['cid'];


    $stmt = $pdo->prepare("SELECT * ,sum(price)  FROM cart c INNER JOIN products p ON c.p_id=p.p_id INNER JOIN users u ON c.u_id=u.u_id where c.id=$cid ORDER BY c.id");
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (isset($_POST['submit'])) {

        $stmt = $pdo->prepare("INSERT INTO orders(u_id, created_at,order_status,pr_id,total_quantity,total_price,address)
              VALUES( :u_id, :created_at,:order_status,:pr_id,:total_quantity,:total_price, :address)");
        $criteria = [
            'address' => $_POST['address'],
            'u_id' => $member,
            'order_status' => 'null',
            'pr_id' => $_POST['pr_id'],
            'total_quantity' => $_POST['total_quantity'],
            'total_price' => $_POST['total_price'],
            'created_at' => '',
        ];
        $stmt->execute($criteria);
        if ($stmt == true) {
            echo
            "<script type='text/javascript'>toastr.success(`Order placed successfully`)</script>";
            header('location:index.php');
        }
    }


    ?>
    <div class="row mt-3">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                $total = 0;


                foreach ($result as $cartItem) {
                ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
                        <small class="text-muted">Quantity: <?php echo $cartItem['quantity'] ?> X Price: <?php echo $cartItem['price'] ?></small>
                    </div>
                    <span class="text-muted">$<?php echo $cartItem['quantity'] * $cartItem['price'] ?></span>
                </li>
                <?php
                }
                ?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (AUD)</span>
                    <strong>$<?php echo number_format($cartItem['quantity'] * $cartItem['price'], 2); ?></strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shipping And Billing address</h4>
            <?php
            if (isset($errorMsg) && count($errorMsg) > 0) {
                foreach ($errorMsg as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            }
            ?>
            <form class="needs-validation" method="POST">
                <div class="row">
                    <div class="mb-3">

                        <?php foreach ($result as $cartItem) { ?>
                        <input hidden type="text" class="form-control" id="pr_id" name="pr_id" value="<?php echo  $cartItem['p_id'] ?>">
                        <input hidden type="text" class="form-control" id="total_quantity" name="total_quantity" value="<?php echo $cartItem['quantity'] ?>">
                        <input hidden type="text" class="form-control" id="total_price" name="total_price" value="<?php echo $cartItem['quantity'] * $cartItem['price'] ?>">

                        <label for="address">Address</label>
                        <input id="address" class="form-control" type="text" name="address" required>

                        <?php } ?>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Confirm Order</button>
            </form>
        </div>
    </div>