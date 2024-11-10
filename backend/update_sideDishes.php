<?php
include('conndb.php');
include 'bootstrap.php';

// Set timezone
date_default_timezone_set('Asia/Bangkok');

// Generate unique filename for the uploaded image
$date1 = date("Ymd_His");
$numrand = (mt_rand());
if (isset($_POST["btnadd"])) {
    $sideDishes_id = $_POST['sideDishes_id'];
    $sideDishes_name_th = $_POST['sideDishes_name_th'];
    $sideDishes_name_en = $_POST['sideDishes_name_en'];
    $sideDishes_price = $_POST['sideDishes_price'];
    $sidedishes_quantity = $_POST['sideDishes_quantity'];
    $sideDishes_img = $_POST['txtimg'];

    // Check if a new image file is uploaded
    if (isset($_FILES['sideDishes_img']) && is_uploaded_file($_FILES['sideDishes_img']['tmp_name'])) {
        $path = "img/";
        $type = strrchr($_FILES['sideDishes_img']['name'], ".");
        $newname = 'sideDishes_img' . $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "img/" . $newname;
        move_uploaded_file($_FILES['sideDishes_img']['tmp_name'], $path_copy);
    } else {
        $newname = $sideDishes_img;
    }

    // Update the sideDishes data in the database
    $query = "UPDATE sideDishes SET 
                sideDishes_name_th = '$sideDishes_name_th', 
                sideDishes_name_en = '$sideDishes_name_en', 
                sideDishes_price = '$sideDishes_price', 
                sideDishes_quantity = '$sidedishes_quantity', 
                sideDishes_img = '$newname' 
              WHERE sideDishes_id = '$sideDishes_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
        echo "<script> alert('Data Update Successfully'); window.location.href='sideDishes_stock.php'; </script>";
    } else {
        echo "<script> alert('Failed to update data'); window.location.href='sideDishes_stock.php'; </script>";
    }
}
?>
