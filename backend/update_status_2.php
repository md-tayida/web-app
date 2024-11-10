
<?php include 'conndb.php'; 
    include 'bootstrap.php';
    if(isset($_GET['order_id'])){
   $order_id = $_GET['order_id'];}
   
   $sql = "UPDATE orders SET order_status = 2 where order_id = '$order_id' ;";
   $result = mysqli_query($conn, $sql);  
   
   
   if($result){
    echo "<script>  alert('Data Confirmed Successfully');  window.location.href='list_confirmed.php'; </script>";
   }
    

    $conn->close();

         ?>