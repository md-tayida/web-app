
<?php include 'conndb.php'; 
    include 'bootstrap.php';
    
   $order_id = $_GET['order_id'];
   $sql = "UPDATE orders SET order_status = 1 where order_id = '$order_id' ;";
   $result = mysqli_query($conn, $sql);  
   
   if($result){
    echo "<script>  alert('Data Confirmed Successfully');  window.location.href='index.php'; </script>";
   }
    
   

    $conn->close();

         ?>