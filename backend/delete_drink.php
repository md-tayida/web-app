<?php
    include('conndb.php'); 
    include 'bootstrap.php';
    if (isset($_GET['iddrink'])) {
        $d_id = $_GET['iddrink'];
        $query = "DELETE FROM drinks WHERE drink_id = '$d_id'";
        $result = mysqli_query($conn, $query) or die("Error in query: $query " . mysqli_error($conn));
    
        if ($result) {
            echo "<script> alert('Data Deleted Successfully'); window.location.href='drink_stock.php'; </script>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request";
    }
    
    $conn->close();

         
?>
