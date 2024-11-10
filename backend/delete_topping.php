<?php
include('conndb.php'); 
include 'bootstrap.php';
if (isset($_GET['idtopping'])) {
    $r_id = $_GET['idtopping'];
    $query = "DELETE FROM toppings WHERE topping_id = '$r_id'";
    $result = mysqli_query($conn, $query) or die("Error in query: $query " . mysqli_error($conn));

    if ($result) {
        echo "<script> alert('Data Deleted Successfully'); window.location.href='topping_stock.php'; </script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
