<?php
include "php/db_connection.php";
if (isset($_POST['submit'])) {
  if ($con) {
    $name = ($_POST["medicine_name"]);
    $packing = ($_POST["packing"]);
    $generic_name = ($_POST["generic_name"]);
    $price = ($_POST["price"]);
    $description = $con->real_escape_string($_POST["description"]);

    $suppliers_name = "12";

    $uid2 = microtime();
    $target_dir = "../images/";
    $target_file = $target_dir . $uid2 . ".png";
    $target_file_name= 'images/' . $uid2 . ".png";
    $target_file = str_replace(" ", "_", $target_file);
    $target_file_name = str_replace(" ", "_", $target_file_name);

    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
      move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    }else{
      $target_file = 'no image';
    }

    $query = "INSERT INTO medicines (NAME, PACKING, GENERIC_NAME, SUPPLIER_NAME,price,description,image) VALUES('$name', '$packing', '$generic_name', '$suppliers_name','$price','$description','$target_file_name')";
    $result = mysqli_query($con, $query);
    if (!empty($result)) {
      echo "$name added...";
      header('location: index.php');
    } else
      echo "Failed to add $name!".$query;
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Add New Medicine</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/suggestions.js"></script>
  <script src="js/validateForm.js"></script>
  <script src="js/restrict.js"></script>
</head>

<body>
  <div id="add_new_supplier_model">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #ff5252; color: white">
          <div class="font-weight-bold">Add New Supplier</div>
          <button class="close" style="outline: none;"
            onclick="document.getElementById('add_new_supplier_model').style.display = 'none';"><i
              class="fa fa-close"></i></button>
        </div>
        <div class="modal-body">
          <?php
            include('sections/add_new_supplier.html');
            ?>
        </div>
      </div>
    </div>
  </div>
  <!-- including side navigations -->
  <?php include("sections/sidenav.html"); ?>

  <div class="container-fluid">
    <div class="container">

      <!-- header section -->
      <?php
        require "php/header.php";
        createHeader('shopping-bag', 'Add Medicine', 'Add New Medicine');
        ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">
        <div class="row col col-md-6">
          <form action="" method="post" enctype="multipart/form-data">

            <div class="row col col-md-12">

              <div class="col col-md-8 form-group">
                <label class="font-weight-bold" for="medicine_name">Medicine Name :</label>
                <input type="text" class="form-control" name="medicine_name" id="medicine_name"
                  placeholder="Medicine Name" onblur="notNull(this.value, 'medicine_name_error');">
              </div>
              <div class="col col-md-4 form-group">
                <label class="font-weight-bold" for="packing">Packing :</label>
                <input type="text" class="form-control" name="packing" id="packing"
                  placeholder="Packing e.g. 10 TAB / 100 ML" onblur="notNull(this.value, 'pack_error');">
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="generic_name">Generic Name :</label>
                <input type="text" class="form-control" name="generic_name" id="generic_name" placeholder="Generic Name"
                  onblur="notNull(this.value, 'generic_name_error');">
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="price">Price :</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Price">
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="description">Description :</label>
                <textarea name="description" type="text" class="form-control" id="description"
                  placeholder="Description"></textarea>
              </div>
            </div>
            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="image">Image :</label>
                <input type="file" accept="image/*" class="form-control" id="image" name="img"
                  placeholder="Select image">
              </div>
            </div>

            <div class="col col-md-12">
              <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
            </div>

            <!-- new user button -->
            <div class="row col col-md-12">
              &emsp;
              <div class="form-group m-auto">
                <button type="submit" name="submit" class="btn btn-primary form-control">ADD</button>
              </div>
              <!--
&emsp;
<div class="form-group">
  <button class="btn btn-success form-control">Save and Add Another</button>
</div>
-->
            </div>
            <!-- customer details content end -->
            <!-- result message -->
            <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
              style="font-family: sans-serif;"></div>
          </form>
        </div>
      </div>

      <hr style="border-top: 2px solid #ff5252;">
      <!-- form content end -->
    </div>
  </div>
</body>

</html>