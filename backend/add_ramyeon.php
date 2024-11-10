<?php include('conndb.php'); 
    include 'bootstrap.php';

    
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
	//รับค่าไฟล์จากฟอร์ม


    if(isset($_POST["btnadd"])){
$ramyeon_id = $_POST['ramyeon_id'];
$ramyeon_name_th = $_POST['ramyeon_name_th'];
$ramyeon_name_en = $_POST['ramyeon_name_en'];
$ramyeon_price = $_POST['ramyeon_price'];
$ramyeon_quantity = $_POST['ramyeon_quantity'];
$ramyeon_img =(isset($_POST['ramyeon_img']) ? $_POST['ramyeon_img'] :'');
//img
	$upload=$_FILES['ramyeon_img'];
	if($upload <> '') {
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="img/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['ramyeon_img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname_img ='ramyeon_img'.$numrand.$date1.$type;
	$path_copy=$path.$newname_img;
	$path_link="img/".$newname_img;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['ramyeon_img']['tmp_name'],$path_copy);
   
	}
    
  
    $sql = "INSERT INTO ramyeons VALUES('$ramyeon_id', '$ramyeon_name_th', '$ramyeon_name_en', '$ramyeon_price', '$ramyeon_quantity', '$newname_img')";
    mysqli_query($conn,$sql);
    echo
   "
    <script> alert('Data Inserted Successfully'); </script>
    ";
   /* if($query){
        echo "<script type='text/javascript'>";
        echo "alert('Add Succesfuly');";
        echo "window.location = 'product.php'; ";
        echo "</script>";
        }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('Error back to upload again');";
        echo "window.location = 'product.php'; ";
        echo "</script>";
        }*/
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
    <script src="js.js"> </script>
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
            <form  name="addproduct" action="add_ramyeon.php"  method="POST" enctype="multipart/form-data"  class="form-horizontal">
            <div class="form-group">
          <div class="col-sm-9">
            <p>รหัสสินค้า</p>
            <input type="text"  name="ramyeon_id" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ชื่อสินค้าภาษาไทย</p>
            <input type="text"  name="ramyeon_name_th" class="form-control"  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ชื่อสินค้าภาษาอังกฤษ</p>
            <input type="text"  name="ramyeon_name_en" class="form-control"  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> ราคา </p>
            <input type="text"  name="ramyeon_price" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ภาพสินค้า </p>
            <br>
            <br>
            <input type="file" name="ramyeon_img" id="ramyeon_img" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9">
            <p> </p>
            <p> จำนวน </p>
            <input type="text"  name="ramyeon_quantity" class="form-control"  />
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