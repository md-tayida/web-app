<?php
    session_start();

    include 'backend/conndb.php';

    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side EN</title>

    <!-- link css -->
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   

    <style>
        body {
           
            background-color: #fcfcfc;
        }
    </style>
</head>

<body>
   
<header>
        <!-- header -->
        <div class="main-head-container">
            <!-- logo -->
            <div class="head-left">
                <div class="logo">
                    <img src="img/restaurantPic.PNG">
                </div>
            </div>
            <!-- right header -->
            <div class="head-right">
                <!-- change lang button -->
                
                <!-- cancel button -->
              
                <!-- bag logo button -->
                <div class="main-bag">
                    <a href="cart_en.php">
                        <i class="bi bi-bag-heart-fill"></i>
                        <span class="quantity"><?php if (isset($_SESSION['cart']) ){
                echo count($_SESSION['cart']); }else{echo"0";} ?></span>
                    </a>
                </div>
                <div class="main-cancel-button">
                    <a href="back_to_index_en.php">CANCEL</a>
                </div>

               
            </div>
        </div>
    </header>

    <!-- navigator -->
    <nav>
    <div class="main-nav">
       <div class='box-back'> 
        <a href="select_location_en.php" class="back-btn"><i class="bi bi-chevron-left"></i></a></div>
        <div class='box-2'>     <a href="menu_ramyeon_en.php" class="main-btn">RAMYEONS</a></div>
           <div class='box-1'> <a href="menu_side_en.php" class="main-btn-1">SIDE DISHES</a></div>
           <div class='box-2'> <a href="menu_drink_en.php" class="main-btn">DRINKS</a> </div>
        <div class="line">
            <hr>
        </div>
    </nav>


 


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
         <!--ตรงนี้จ้า   ลองเพิ่มเมนูดูได้แล้วจ้าาาาาาาาาาาาาาาาา-->
            <?php 
         
            if(isset($_SESSION['location'])) {
              
            
            $sql = "SELECT * FROM sidedishes where sideDishes_quantity>0";
             $result = mysqli_query($conn, $sql);
                    while ($row = mysqlI_fetch_array($result)){?>



<a href="select_side_en.php?sideDishes_id=<?php echo $row['sideDishes_id']; ?>">

            <div class="food-menu-box">
                <div class="food-menu-img">
                <img src="./backend/img/<?php echo $row['sideDishes_img']; ?>">
                </div>
                   

                <div class="food-menu-name">
                    <?=$row['sideDishes_name_en']?>
                    
                    
                </div>
                <div class="food-menu-price">
                    <?=$row['sideDishes_price']?>฿

                </div>
                
               
            </div> </a>

            <?php  }}
$conn->close();?>

           

    </section>
    <!-- fOOD Menu Section Ends Here -->



</body>

</html>
