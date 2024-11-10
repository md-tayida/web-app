<?php include 'conndb.php'; 
    include 'bootstrap.php';
     
    
   
//    if($result){
//     echo "<script>  alert('Data Confirmed Successfully');  window.location.href='list_confirmed.php'; </script>";
//    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <style> 
.title{
    text-align: center;
}</style>
</head>
<body>
    <header> <h1 class="title"> RAMYEON SABB Mangement </h1></header>
    <div class="container">
        <div class="row">
            <div class="col-3 bg-light p-3 border">
            
                <!-- Left side column. contains the logo and sidebar -->
                <?php include('menu_left.php');?>
                <!-- Content Wrapper. Contains page content -->
            </div>
            

            <div class="col-9 bg-light p-9 border">
                
           
            <?php include 'menu_orders.php'; ?>
           
                <?php
                
                $sql = "SELECT * FROM orders where order_status = 2 ;";
                $result = mysqli_query($conn,$sql);
                
                
                echo "<table class='table table-hover'>";  echo "<tr><td>รหัสคำสั่งซื้อ</td><td>เวลาสั่งซือ
                </td><td>ราคา</td><td>สถานะ</td></td><td>ยกเลิกคำสั่งซื้อ</td></tr>"; 
                while ($row = mysqlI_fetch_array($result)) {
                    echo "<tr><td><a href='show_detail.php?order_id=".$row['order_id']."&status=0'>".$row['order_id']."</a></td>
                        <td>".$row['order_time']."</td>
    
                        <td>".$row['total_price']."</td>
                       
                    
                    <td>คำสั่งซื้อเสร็จสมบูรณ์</td>
                    <td>"."<a href='list_canceled.php?order_id_del=".$row['order_id']."&status=0' class='btn btn-danger'> ยกเลิก </a>"."</td></tr>";
                } "</table>" ?>
                

            </div>

            
        </div>
        <div>
            
    </div>
</body>
</html>