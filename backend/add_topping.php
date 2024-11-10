<?php
include('conndb.php');
include 'bootstrap.php';



if (isset($_POST["btnadd"])) {
    $topping_id = $_POST['topping_id'];
    $topping_name_th = $_POST['topping_name_th'];
    $topping_name_en = $_POST['topping_name_en'];
    $topping_price = $_POST['topping_price'];
    $topping_status = $_POST['topping_status'];
   

    // Insert topping data into the database
    $sql = "INSERT INTO toppings (topping_id, topping_name_th, topping_name_en, topping_price, topping_status) 
            VALUES ('$topping_id', '$topping_name_th', '$topping_name_en', '$topping_price', '$topping_status')";


    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Data Inserted Successfully');</script>";
    } else {
        echo "<script>alert('Failed to insert data');</script>";
    }
}
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
    <script src="js.js"></script>
</head>
<body>
    <header>
        <h1 class="title">RAMYEON SABB Management</h1>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-3 bg-light p-3 border">
                <!-- Left side column. contains the logo and sidebar -->
                <?php include('menu_left.php'); ?>
                <!-- Content Wrapper. Contains page content -->
            </div>
            <div class="col-sm-9 bg-light p-3 border">
                <form name="addproduct" action="add_topping.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p>รหัสสินค้า</p>
                            <input type="text" name="topping_id" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ชื่อสินค้าภาษาไทย</p>
                            <input type="text" name="topping_name_th" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ชื่อสินค้าภาษาอังกฤษ</p>
                            <input type="text" name="topping_name_en" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ราคา </p>
                            <input type="text" name="topping_price" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> status </p>
                            <input type="radio" name="topping_status" value="1" required > มี
            <input type="radio" name="topping_status" value="0" required> หมด
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                        <br>
                            <button type="submit" class="btn btn-success" name="btnadd"> บันทึก </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
