<?php require 'header.php'; ?>


<?php

require "connection.php";
$vdt = $_GET['vdt'];
$details = $pdo->query("SELECT * FROM prodcuts p JOIN categories c ON p.category_id = c.id WHERE p_id = $vdt")->fetch();

if (isset($_POST['book'])) {

    if (isset($_SESSION['customer_id'])) {
        $member = $_SESSION['customer_id'];
    }

    $stmt = $pdo->prepare("INSERT INTO orders(id, u_id, created_at)
                VALUES(:id, :u_id, :created_at)");
    $criteria = [
        'id' => $_POST['id'],
        'u_id' => $member,
        'created_at' => $date['Y-m-d h:i:s'],

    ];
    $stmt->execute($criteria);
    if ($stmt == true) {
        echo "<script>alert('Thank your for ordering with us!!');</script>";
    }
}
?>


<section style="padding:50px 20px;">
    <div class="container">
        <div class="det">
            <h2><?php echo $details['name']; ?></h2>
        </div>
        <div class="details">
            <div class="details1">
                <img <?php echo 'src="image/product/' . $details['image'] . '"'; ?> alt="car" class="img-fluid">
            </div>
            <div class="details2">
                <div style="padding: 0 20px 0 20px; ">
                    <div class="ps">
                        <p><strong><?php echo $details['price']; ?></strong> per day</p>
                    </div>
                    <div>
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo $details['p_id']; ?>">
                            <div class="flex">
                                <div class="form-control form-controls">
                                    <div class="form1 reg1"><label>Pick Up</label></div>
                                    <div class="form2"><input type="date" name="pickup" required></div>
                                </div>
                                <div class="form-control form-controls">
                                    <div class="form1 reg1"><label>Drop Off</label></div>
                                    <div class="form2"><input type="date" name="dropoff" required></div>
                                </div>
                            </div>
                            <div class="form-control" style="padding:0 8px;">
                                <div class="form1"><label>Location</label></div>
                                <div class="form2"><input type="text" name="location" placeholder="location" required></div>
                            </div>
                            <div class="form-control logs logss" style="padding:0 8px;">
                                <?php if (isset($_SESSION['customer_id'])) { ?>
                                    <input type="submit" name="book" class="btns book" value="Book Now">
                                <?php
                                } else { ?>
                                    <input type="submit" name="signup" class="btns book" value="Book Now" disabled>
                                    <small class="text-muted">Please login to booking</small>
                                <?php
                                } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require 'footer.php'; ?>