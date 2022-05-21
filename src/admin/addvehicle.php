<?php require "header.php"; ?>


<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['admin_id'])) {
  header('location:index.php');
}
?>

<?php
require '../conection.php';
// isset function with variable
if (isset($_POST['upload'])) {

  // image file upload
  $img = $_FILES['fileToUpload']['name'];
  $img_dir = $_FILES['fileToUpload']['tmp_name'];
  $img_size = $_FILES['fileToUpload']['size'];

  $uploading_dir = '../image/product/';
  $imgExtns = strtolower(pathinfo($img, PATHINFO_EXTENSION));
  $validExtns = array('jpg', 'jpeg', 'gif', 'png');
  $imageName = rand(100, 100000) . "." . $imgExtns;
  move_uploaded_file($img_dir, $uploading_dir . $imageName);

  // insert query
  $stmt = $pdo->prepare("INSERT INTO vehicle(name, brand, type, engine, status, transmission, features, style, price, description, submitted_by, image)
      VALUES (:name, :brand, :type, :engine, :status, :transmission, :features, :style, :price, :description, :submitted_by,  :image)");
  $criteria = [
    'name' => $_POST['name'],
    'brand' => $_POST['brand'],
    'type' => $_POST['type'],
    'engine' => $_POST['engine'],
    'status' => $_POST['status'],
    'transmission' => $_POST['transmission'],
    'features' => $_POST['features'],
    'style' => $_POST['style'],
    'price' => $_POST['price'],
    'description' => $_POST['description'],
    'submitted_by' => $_POST['submitted_by'],
    'image' => $imageName
  ];
  $success = $stmt->execute($criteria);
  // checking file is successfully upload
  if ($stmt == true) {
    echo "<script>alert('Vehicle uploaded successfully');</script>";
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
                  <h2 class="lgs">Vehicle Form</h2>
                  <div>
                    <form class="forms" method="POST" action="" enctype="multipart/form-data">
                      <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['admin_id']; ?>">
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Vehicle Name</label></div>
                        <div class="admform2"><input type="text" name="name" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Brand</label></div>
                        <div class="admform2"><input type="text" name="brand" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Type</label></div>
                        <div class="admform2">
                          <select name="type" class="select" required>
                            <option value="">Select Category</option>
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM category");
                            $stmt->execute();

                            foreach ($stmt as $row) {
                              $selected = ($row['category_ID'] == $catid) ? 'selected' : '';
                              echo "
                                        <option value='" . $row['category_ID'] . "' " . $selected . ">" . $row['name'] . "</option>
                                      ";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Engine</label></div>
                        <div class="admform2"><input type="text" name="engine" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Status</label></div>
                        <div class="admform2"><input type="text" name="status" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Transmission</label></div>
                        <div class="admform2"><input type="text" name="transmission" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Features</label></div>
                        <div class="admform2"><input type="text" name="features" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Style</label></div>
                        <div class="admform2"><input type="text" name="style" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Price</label></div>
                        <div class="admform2"><input type="text" name="price" required></div>
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









<?php require "footer.php"; ?>