<?php require 'header.php'; ?>


<div class="body">
    <div class="search">
        <div class="search1">
            <h2>FIND CAKE OF YOUR CHOICE</h2>
            <div>
                <form method="POST" action="search.php">
                    <input type="text" id="myInput" name="search" placeholder="Search cakes...." title="Type in a name">
                    <button class="btn" name="submit-search" type="submit" hidden>Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

<section style="padding:50px 20px;">
    <div class="container">
        <div class="head">
            <h2>Searched Products</h2>
        </div>
        <div class="rows">
            <?php
            // connection with server
            $connect = mysqli_connect('localhost', 'root', '', 'cheesecakeshop');
            if (isset($_POST['submit-search'])) {
                // preventing mysql injection attack
                $search = mysqli_real_escape_string($connect, $_POST['search']);
                // perform query
                $sql = "SELECT * FROM products WHERE (product_name LIKE '%$search%' OR price LIKE '%$search%')";
                $result = mysqli_query($connect, $sql);
                $queryResult = mysqli_num_rows($result);


                if ($queryResult > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="column">
                <div style="position:relative; border: 1px solid #e8e8e8; height: 100%;">
                    <a <?php echo 'href="productDescription.php?pid=' . $row['p_id'] . '"' ?>>
                        <img <?php echo 'src="../assets/img/products/' . $row['image_path'] . '"'; ?> alt="product" class="img-fluid">

                        <div class="name">
                            <p><?php echo $row['product_name']; ?></p>

                        </div>
                        <div class="price">
                            <p>From <big>$<?php echo $row['price']; ?></big> per e.a.</p>
                        </div>
                    </a>
                </div>
            </div>
            <?php }
                } else {
                    echo "There is no such item";
                }
            } ?>
        </div>
    </div>
</section>




<?php require 'footer.php'; ?>