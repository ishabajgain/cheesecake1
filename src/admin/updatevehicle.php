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

$upd = $_GET['upd'];
$update = $pdo->query("SELECT * FROM vehicle WHERE vehicle_ID = '$upd'")->fetch();

if (isset($_POST['update'])) {

  $stmt = $pdo->prepare("UPDATE vehicle SET
        name = :name,
        brand = :brand,
        engine = :engine,
        status = :status,
        transmission = :transmission,
        features = :features,
        style = :style,
        price = :price,
        description = :description
        WHERE vehicle_ID = :upd
      ");
  $criteria = [
    'name' => $_POST['name'],
    'brand' => $_POST['brand'],
    'engine' => $_POST['engine'],
    'status' => $_POST['status'],
    'transmission' => $_POST['transmission'],
    'features' => $_POST['features'],
    'style' => $_POST['style'],
    'price' => $_POST['price'],
    'description' => $_POST['description'],
    'upd' => $_GET['upd']
  ];

  $success = $stmt->execute($criteria);

  if ($success) {
    header("Location:vehicledetails.php");
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
                  <h2 class="lgs">Update Vehicle</h2>
                  <div>
                    <form class="forms" method="POST" action="">
                      <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['admin_id']; ?>">
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Vehicle Name</label></div>
                        <div class="admform2"><input type="text" name="name" value="<?php echo $update['name']; ?>" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Brand</label></div>
                        <div class="admform2"><input type="text" name="brand" value="<?php echo $update['brand']; ?>" required></div>
                      </div>

                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Engine</label></div>
                        <div class="admform2"><input type="text" name="engine" value="<?php echo $update['engine']; ?>" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Status</label></div>
                        <div class="admform2"><input type="text" name="status" value="<?php echo $update['status']; ?>" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Transmission</label></div>
                        <div class="admform2"><input type="text" name="transmission" value="<?php echo $update['transmission']; ?>" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Features</label></div>
                        <div class="admform2"><input type="text" name="features" value="<?php echo $update['features']; ?>" required></div>
                      </div>
                      <div class="form-control form-controlss">
                        <div class="admform1"><label>Style</label></div>
                        <div class="admform2"><input type="text" name="style" value="<?php echo $update['style']; ?>" required></div>
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
                        <input type="submit" name="update" class="log" value="Update Vehicle">
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