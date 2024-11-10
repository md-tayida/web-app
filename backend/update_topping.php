<?php
include('conndb.php');
include 'bootstrap.php';

if (isset($_POST["topping_status"])) {
    $topping_id = $_POST['topping_id'];
    $topping_name_th = $_POST['topping_name_th'];
    $topping_name_en = $_POST['topping_name_en'];
    $topping_price = $_POST['topping_price'];
    $topping_status = $_POST['topping_status'];

    // Check if a new image file is uploaded
    

    // Update the topping data in the database
    $query = "UPDATE toppings SET 
                topping_name_th = '$topping_name_th', 
                topping_name_en = '$topping_name_en', 
                topping_price = '$topping_price', 
                topping_status = '$topping_status'
              WHERE topping_id = '$topping_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
        echo "<script> alert('Data Update Successfully'); window.location.href='topping_stock.php'; </script>";
    } else {
        echo "<script> alert('Failed to update data'); window.location.href='topping_stock.php'; </script>";
    }
}
?>
