<?php 
include('conndb.php'); 
include 'bootstrap.php'; 
$d_id2 = $_GET['iddrink']; 
$sql = "SELECT * FROM drinks WHERE drink_id = '$d_id2';"; 
$result = mysqli_query($conn, $sql); 
$rs = mysqli_fetch_array($result); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Drink</title>
    <style> 
.title{
    text-align: center;
}</style>
    <script src="js.js"> </script>
</head>
<body>
    <header> <h1 class="title"> RAMYEON SABB Management </h1> </header>
    <div class="container">
        <div class="row">
            <div class="col-3 bg-light p-3 border">
                <!-- Left side column. contains the logo and sidebar -->
                <?php include('menu_left.php'); ?>
                <!-- Content Wrapper. Contains page content -->
            </div>
            <div class="col-sm-9 bg-light p-3 border">
                <form name="addproduct" action="update_drink.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p>รหัสสินค้า</p>
                            <input type="text" name="drink_id" class="form-control" readonly value=<?= $rs['drink_id'] ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ชื่อสินค้าภาษาไทย</p>
                            <input type="text" name="drink_name_th" class="form-control" value=<?= $rs['drink_name_th'] ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ชื่อสินค้าภาษาอังกฤษ</p>
                            <input type="text" name="drink_name_en" class="form-control" value=<?= $rs['drink_name_en'] ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> ราคา </p>
                            <input type="number" name="drink_price" class="form-control" readonly value=<?= $rs['drink_price'] ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <p> ภาพสินค้า </p>
                            <br>
                            <br>
                            <img src="img/<?= $rs['drink_img'] ?>" width="120"> <br> <p> </p>
                            <input type="file" name="drink_img" id="drink_img" class="form-control"  />
                            <input type="hidden" name="txtimg" class="from-control" value=<?= $rs['drink_img'] ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <p> </p>
                            <p> จำนวน </p>
                            <input type="number" name="drink_quantity" class="form-control" value=<?= $rs['drink_quantity'] ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <Br>
                            <button type="submit" class="btn btn-success" name="btnadd"> อัปเดต </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
