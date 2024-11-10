<?php
    include('conndb.php'); 
    include 'bootstrap.php';
    if (isset($_GET['id'])) {
        $r_id = $_GET['id'];
        $query = "DELETE FROM ramyeons WHERE ramyeon_id = '$r_id'";
        $result = mysqli_query($conn, $query) or die("Error in query: $query " . mysqli_error($conn));
    
        if ($result) {
            echo "<script> alert('Data Deleted Successfully'); window.location.href='ramyeon_stock.php'; </script>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request";
    }
    
    $conn->close();

         
?>
