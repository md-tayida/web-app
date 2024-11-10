<?php include('conndb.php'); 
    include 'bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <!-- <div> add new Ramen </div> -->

            <div class="col-sm-9 bg-light p-3 border">
    
          <div>  <?php include 'menu_stock.php';  ?> </div>
            
           
           <div>    <br> <a class="btn btn-info" href="add_drink.php"> เพิ่มสินค้า </a> </div>
           <div>
                <?php 

                $sql = "SELECT * FROM drinks ;";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='table table-hover'>";
                    echo "<tr><td>รหัสสินค้า</td><td>ชื่อสินค้า</td><td>รูปภาพสินค้า</td><td>ราคา</td><td>คงเหลือ</td><td>สถานะสินค้า</td><td>แก้ไขสินค้า</td><td>ลบสินค้า</td></tr>";
                
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$row['drink_id']."</td>";
                        echo "<td>".$row['drink_name_th']." ".$row['drink_name_en']."</td>";
                        echo "<td align=center><img src='img/".$row['drink_img']."' width='100'></td>";
                        echo "<td>".$row['drink_price']."</td>";
                        echo "<td>".$row['drink_quantity']."</td>";
                
                        if ($row['drink_quantity'] == 0) {
                            echo "<td style=color:red;>หมด</td>";
                        } else {
                            echo "<td></td>";
                        }
                
                        echo "<td><a href='edit_drink.php?iddrink=".$row['drink_id']."' class='btn btn-warning btn-xs'>แก้ไข</a></td>";
                        echo "<td><a href='delete_drink.php?iddrink=".$row['drink_id']."' class='btn btn-danger btn-xs'>ลบ</a></td>";
                        echo "</tr>";
                    }
                
                    echo "</table>";
                } else {
                    echo "0 rows available";
                }
                
        $conn->close();
        ?> </div> </div>
        </div>
    </div>
</body>
</html>
