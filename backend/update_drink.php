<?php
include('conndb.php');
include 'bootstrap.php';

// Set timezone
date_default_timezone_set('Asia/Bangkok');

// Generate unique filename for the uploaded image
$date1 = date("Ymd_His");
$numrand = (mt_rand());
if (isset($_POST["btnadd"])) {
    $drink_id = $_POST['drink_id'];
    $drink_name_th = $_POST['drink_name_th'];
    $drink_name_en = $_POST['drink_name_en'];
    $drink_price = $_POST['drink_price'];
    $drink_quantity = $_POST['drink_quantity'];
    $drink_img = $_POST['txtimg'];

    // Check if a new image file is uploaded
    if (isset($_FILES['drink_img']) && is_uploaded_file($_FILES['drink_img']['tmp_name'])) {
        $path = "img/";
        $type = strrchr($_FILES['drink_img']['name'], ".");
        $newname = 'drink_img' . $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "img/" . $newname;
        move_uploaded_file($_FILES['drink_img']['tmp_name'], $path_copy);
    } else {
        $newname = $drink_img;
    }

    // Update the drink data in the database
    $query = "UPDATE drinks SET 
                drink_name_th = '$drink_name_th', 
                drink_name_en = '$drink_name_en', 
                drink_price = '$drink_price', 
                drink_quantity = '$drink_quantity', 
                drink_img = '$newname' 
              WHERE drink_id = '$drink_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
        echo "<script> alert('Data Update Successfully'); window.location.href='drink_stock.php'; </script>";
    } else {
        echo "<script> alert('Failed to update data'); window.location.href='drink_stock.php'; </script>";
    }
}
?>
