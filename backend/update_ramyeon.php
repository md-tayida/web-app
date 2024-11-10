<?php
include('conndb.php');
include 'bootstrap.php';

// Set timezone
date_default_timezone_set('Asia/Bangkok');

// Generate unique filename for the uploaded image
$date1 = date("Ymd_His");
$numrand = (mt_rand());
if (isset($_POST["btnadd"])) {
    $ramyeon_id = $_POST['ramyeon_id'];
    $ramyeon_name_th = $_POST['ramyeon_name_th'];
    $ramyeon_name_en = $_POST['ramyeon_name_en'];
    $ramyeon_price = $_POST['ramyeon_price'];
    $ramyeon_quantity = $_POST['ramyeon_quantity'];
    $ramyeon_img = $_POST['txtimg'];

    // Check if a new image file is uploaded
    if (isset($_FILES['ramyeon_img']) && is_uploaded_file($_FILES['ramyeon_img']['tmp_name'])) {
        $path = "img/";
        $type = strrchr($_FILES['ramyeon_img']['name'], ".");
        $newname = 'ramyeon_img' . $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "img/" . $newname;
        move_uploaded_file($_FILES['ramyeon_img']['tmp_name'], $path_copy);
    } else {
        $newname = $ramyeon_img;
    }

    // Update the ramyeon data in the database
    $query = "UPDATE ramyeons SET 
                ramyeon_name_th = '$ramyeon_name_th', 
                ramyeon_name_en = '$ramyeon_name_en', 
                ramyeon_price = '$ramyeon_price', 
                ramyeon_quantity = '$ramyeon_quantity', 
                ramyeon_img = '$newname' 
              WHERE ramyeon_id = '$ramyeon_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
        echo "<script> alert('Data Update Successfully'); window.location.href='ramyeon_stock.php'; </script>";
    } else {
        echo "<script> alert('Failed to update data'); window.location.href='ramyeon_stock.php'; </script>";
    }
}
?>
