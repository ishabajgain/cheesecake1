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
require "../src/connection.php";

// isset function with variable
if (isset($_POST['upload'])) {

    // image file upload
    $img = $_FILES['fileToUpload']['name'];
    $img_dir = $_FILES['fileToUpload']['tmp_name'];
    $img_size = $_FILES['fileToUpload']['size'];

    $uploading_dir = '../assets/img/products/';
    $imgExtns = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $validExtns = array('jpg', 'jpeg', 'gif', 'png');
    $imageName = rand(100, 100000) . "." . $imgExtns;
    move_uploaded_file($img_dir, $uploading_dir . $imageName);

    // insert query
    $stmt = $pdo->prepare("INSERT INTO products(product_name, price,category_id, description, image_path)
      VALUES (:product_name, :price,:category_id,  :description, :image_path)");
    $criteria = [
        'product_name' => $_POST['name'],
        'price' => $_POST['price'],
        'category_id' => $_POST['category_id'],
        'description' => $_POST['description'],
        'image_path' => $imageName
    ];
    $success = $stmt->execute($criteria);
    // checking file is successfully upload
    if ($stmt == true) {
        echo "<script type='text/javascript'>toastr.error(`Product added successfully`)</script>";
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
                                    <h2 class="lgs">Product Form</h2>
                                    <div>
                                        <form class="forms" method="POST" action="" enctype="multipart/form-data">
                                            <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['customer_id']; ?>">
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Product Name</label></div>
                                                <div class="admform2"><input type="text" name="name" required></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Price</label></div>
                                                <div class="admform2"><input type="number" name="price" required></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Category</label></div>
                                                <div class="admform2">
                                                    <select name="category_id" class="select" required>
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        $stmt = $pdo->prepare("SELECT * FROM categories");
                                                        $stmt->execute();

                                                        foreach ($stmt as $row) {
                                                            $selected = ($row['c_id'] == $catid) ? 'selected' : '';
                                                            echo "
                                        <option value='" . $row['c_id'] . "' " . $selected . ">" . $row['title'] . "</option>
                                      ";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Image</label></div>
                                                <div class="admform2"><input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required style="color: #fff; border: 1px solid #fff;"></div>
                                            </div>
                                            <div class="form-control form-controlss">
                                                <div class="admform1"><label>Description</label></div>
                                                <div class="admform2"><textarea name="description" rows="6"></textarea></div>
                                            </div>
                                            <div class="form-control logs logss appss">
                                                <input type="submit" name="upload" class="log" value="Upload">
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









<?php require "../src/footer.php"; ?>