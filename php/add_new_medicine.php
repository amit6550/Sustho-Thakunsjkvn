<?php
include "php/db_connection.php";
if (isset($_POST['submit'])) {
  if ($con) {
    $name = ($_POST["name"]);
    $packing = ($_POST["packing"]);
    $generic_name = ($_POST["generic_name"]);
    $price = ($_POST["price"]);
    $description = ($_POST["description"]);

    $suppliers_name = "12";

    $uid2 = microtime();
    $target_dir = "/php/images/";
    $target_file = $target_dir .$uid2.".png";
    $target_file=str_replace(" ", "_", $target_file);
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
      move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    }

    $query = "INSERT INTO medicines (NAME, PACKING, GENERIC_NAME, SUPPLIER_NAME,price,description,image) VALUES('$name', '$packing', '$generic_name', '$suppliers_name','$price','$description','$target_file')";
    $result = mysqli_query($con, $query);
    if (!empty($result)){
      echo "$name added...";
      header('location: add_medicine.php');
    }else
      echo "Failed to add $name!";
  }
}
?>