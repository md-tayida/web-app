<?php
include('conndb.php'); 
include 'bootstrap.php';


  
date_default_timezone_set('Asia/Bangkok');
//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_His");
//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());
//รับค่าไฟล์จากฟอร์ม

if(isset($_POST["btnadd"])){
    // Retrieve form data
    $sideDishes_id = $_POST['sideDishes_id'];
    $sideDishes_name_th = $_POST['sideDishes_name_th'];
    $sideDishes_name_en = $_POST['sideDishes_name_en'];
    $sideDishes_price = $_POST['sideDishes_price'];
    $sidedishes_quantity = $_POST['sideDishes_quantity'];

    // Check if a file is uploaded
    if(isset($_FILES['sideDishes_img']) && is_uploaded_file($_FILES['sideDishes_img']['tmp_name'])){
        // Set upload parameters
        $path = "img/";
        $type = strrchr($_FILES['sideDishes_img']['name'],".");
        $newname_img = 'sideDishes_img'.$numrand.$date1.$type;
        $path_copy = $path.$newname_img;
        // Move uploaded file to destination folder
        if(move_uploaded_file($_FILES['sideDishes_img']['tmp_name'],$path_copy)){
            echo "<script>alert('File uploaded successfully: $newname_img');</script>";
        } else {
            echo "<script>alert('Error uploading file');</script>";
        }
    } else {
        // Set default image filename if no file is uploaded
        $newname_img = '';
    }

    // Insert data into the database
    $sql = "INSERT INTO sideDishes (sideDishes_id, sideDishes_name_th, sideDishes_name_en, sideDishes_price, sidedishes_quantity, sideDishes_img) VALUES ('$sideDishes_id', '$sideDishes_name_th', '$sideDishes_name_en', '$sideDishes_price', '$sidedishes_quantity', '$newname_img')";
    mysqli_query($conn,$sql);

    // Display success message
    echo "<script>alert('Data Inserted Successfully');</script>";
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
</head>
<body>
    <header> <h1 class="title"> RAMYEON SABB Mangement </h1>
</header>
    <div class="container">
        <div class="row">
            <div class="col-3 bg-light p-3 border">
            
                <!-- Left side column. contains the logo and sidebar -->
                <?php include('menu_left.php');?>
                <!-- Content Wrapper. Contains page content -->
            </div>
            <!-- <div> add new Ramen </div> -->

            <div class="col-sm-9 bg-light p-3 border">
            <form  name="addproduct" action="add_sideDishes.php"  method="POST" enctype="multipart/form-data"  class="form-horizontal">
            <div class="form-group">
          <div class="col-sm-9">
            <p>รหัสสินค้า</p>
            <input type="text"  name="sideDishes_id" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ชื่อสินค้าภาษาไทย</p>
            <input type="text"  name="sideDishes_name_th" class="form-control"  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ชื่อสินค้าภาษาอังกฤษ</p>
            <input type="text"  name="sideDishes_name_en" class="form-control"  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ราคา </p>
            <input type="text"  name="sideDishes_price" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ภาพสินค้า </p>
            <br>
            <br>
            <input type="file" name="sideDishes_img" id="sideDishes_img" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> จำนวน </p>
            <input type="text"  name="sideDishes_quantity" class="form-control"  />
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
</body>
</html>