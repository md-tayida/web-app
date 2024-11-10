<?php include 'conndb.php'; 
    include 'bootstrap.php';
  
    if (isset($_GET['order_id_del'])) {
        $order_id = $_GET['order_id_del'];
        $sql = "UPDATE orders SET order_status = 3 where order_id = '$order_id' ;";
        $result = mysqli_query($conn, $sql);  }
     //    if($result){
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
                
                $sql = "SELECT * FROM orders where order_status = 3 ;";
                $result = mysqli_query($conn,$sql);
                
                
                echo "<table class='table table-hover'>";  echo "<tr><td>รหัสคำสั่งซื้อ</td><td>เวลาสั่งซือ
                </td><td>ราคา</td><td>สถานะ</td></td><td>รายละเอียด</td></tr>"; 
                while ($row = mysqlI_fetch_array($result)) {
                    echo "<tr><td>".$row['order_id']."</td>
                        <td>".$row['order_time']."</td>
    
                        <td>".$row['total_price']."</td>
                       
                    
                    <td>คำสั่งซื้อถูกยกเลิกเรียบร้อยแล้ว</td>
                    <td>"."<a href='show_detail.php?order_id=".$row['order_id']."&status=0' class='btn btn-warning btn-xs'> เปิด </a>"."</td></tr>";
                } "</table>" ?>
                

            </div>

            
        </div>
        <div>
            
    </div>
</body>
</html>
<?php
$conn->close();
        ?> 