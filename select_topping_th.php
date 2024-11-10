<?php
    // Include database connection
    //include 'backend/bootstrap.php';
    session_start();
    include 'backend/conndb.php'; ?>
    	  
          <script> function changecolor(checkbox) {
    var label = checkbox.parentElement;
    if (checkbox.checked) {
        label.classList.add('checked');
    } else {
        label.classList.remove('checked');
    }
}
</script>


    <!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select topping TH</title>
    <!-- link css -->
 
    <link rel="stylesheet" href="f-style.css">

    <!-- cnd -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        
        body {
            
            background-color: #fcfcfc;
        }
        
        .back-menu a {
            display: flex;
            margin-left: 20px;
    /* Ensure horizontal centering */
    justify-content: center;
    /* Ensure vertical centering */
    align-items: center;
    text-align: center;
    color: #561d03;
    font-size: 35px;
    font-weight: bold;
    width: 50px;
}

        .test {
            cursor: pointer;
            content: '';
  display: inline-block;


  }  


  
  label.test {
/* เส้นขอบให้กรอบด้วยสีเทาอ่อน */
    padding: 5px; /* ระยะห่างของเนื้อหาภายใน label กับขอบของกรอบ */
    border-radius: 5px; /* ทำให้มีเส้นรอบกรอบเป็นวงกลมขนาดเล็กเล็กน้อย */
    display: inline-block; /* ให้ label แสดงเป็นกล่องแบบ inline-block */
   
    border: 1px solid black;
    color: black;
    background-color: white;
    margin-right: 5px;
    margin-bottom: 10px;
    width: 215px;
    height: 45px;
    box-sizing: border-box;
    text-align: center;
    vertical-align: top; /* จัดแนวตั้งเป็นบน */
    line-height: 35px; /* ส่วนสูงเท่ากับความสูงของ label */
    font-family: "Prompt", sans-serif;
}
    

    


input[type="checkbox"] {
  display: none;
}

label.test {
    display: inline-block;
    padding: 5px;
    border-radius: 5px;
    transition: background-color 0.3s; /* เพิ่มการเปลี่ยนสีพื้นหลังด้วย transition เพื่อทำให้มันดูนุ่มนวล */
}

label.test.checked {
    color: white;
    background-color: #561d03;
}

  /* สไตล์สำหรับ label เมื่อถูกคลิก */



.blind-box {
    opacity: 0; /* ซ่อนกล่อง checkbox */
    /* ขยายพื้นที่ของ input ที่ซ่อนออกไปเพื่อให้สามารถคลิกได้ */
    width: 1px;
    height: 1px;
    overflow: hidden;

}



.test label {
    display: inline-block;
    padding-left: 20px;
    position: relative;
    cursor: pointer;
}


.main-cancel-button a,
.main-bag a {
    color: white !important;
    text-decoration: none !important;
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
                <div class="main-bag">
                    <a href="cart_th.php">
                        <i class="bi bi-bag-heart-fill"></i>
                        <span class="quantity"> <?php if (isset($_SESSION['cart']) ){
                echo count($_SESSION['cart']); }else{echo"0";} ?>
            </span>
                    </a>
                </div>
                <!-- cancel button -->
                <div class="main-cancel-button">
                    <a href="back_to_index_th.php">ยกเลิก</a>
                </div>
                <!-- bag logo button -->
           
            </div>
        </div>
        <br>
    </header>

        <?php 
    //echo "<script> alert('Data Deleted Successfully'); window.location.href='exam_form.php'; </script>";

    // Check if bingsu_id is provided in URL parameter
    if(isset($_GET['ramyeon_id'])) {
        $ramyeon_id = $_GET['ramyeon_id'];
        
        // Query to select bingsu name and price based on bingsu_id
        $sql = "SELECT * FROM ramyeons WHERE ramyeon_id = '$ramyeon_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the bingsu exists
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $ramyeon_name = $row['ramyeon_name_th'];
            $ramyeon_price = $row['ramyeon_price'];
            $ramyeon_quantity = $row['ramyeon_quantity'];
           ?>

        <section class="sec-custom">
            <div class="custom-topping-detail">
                <div class="row">
                    <div class="col-md-5 menu-detail">
                    <div class='back-menu'>
                        <a href="menu_ramyeon_th.php" ><i class="bi bi-chevron-left"></i></a>
                                </div> <br>
                        <div class="select-img">
                            <img src="backend/img/<?php echo $row['ramyeon_img'] ;?>">
                        </div>
                        <div class="menu-des" >
                        <div class="food-menu-name" style=' width:80%;'>
                   <br> <?=$row['ramyeon_name_th']?><br>
                    
                    
                </div>
                <div class="food-menu-price">
                <br> <?=$row['ramyeon_price']?>฿
                    
                    
                    
                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-7 summary">
                        <div>
                            <h3>ปรับแต่งมื้ออาหารของคุณ </h3>
                        </div>
                        <hr>
                       
                            <h4>เนื้อสัตว์</h4>
                         <?php   
                         
                         echo "<form action='add_to_cart_th.php' method='post'>";
                        
                         
                         $sql1 = "SELECT * FROM Toppings WHERE topping_id LIKE 'M%' AND topping_status = 1";
            $result1 = mysqli_query($conn, $sql1);

            // Check if there are any toppings
            
            if(mysqli_num_rows($result1) > 0) {
                // Display the toppings as checkboxes
              
                while($row1 = mysqli_fetch_assoc($result1)) { 

                           
echo "
<label class='test'><input  class='blind-box' type='checkbox' id='toppings[]' name='toppings[]' value='{$row1['topping_id']}' onclick= 'changecolor(this);updateTotalPrice(this)' 
data-price='{$row1['topping_price']}' >
{$row1['topping_name_th']} ({$row1['topping_price']}฿)</label>"; ?>

                                
                        <?php }  }  ;
                             $sql2 = "SELECT * FROM Toppings WHERE topping_id LIKE 'V%'AND topping_status = 1";
                             $result2 = mysqli_query($conn, $sql2);
                 
                 
                          echo  "<br><h4>ผัก</h4>";   if(mysqli_num_rows($result2) > 0) {
                            // Display the toppings as checkboxes
                       
                            while($row2 = mysqli_fetch_assoc($result2)) {
                                
                                echo "
<label class='test'><input  class='blind-box' type='checkbox' id='toppings[]' name='toppings[]' value='{$row2['topping_id']}' onclick='changecolor(this);updateTotalPrice(this)'
data-price='{$row2['topping_price']}' >
{$row2['topping_name_th']} ({$row2['topping_price']}฿)</label>"; 
                            }
                  }      } ?>
<script>
    function updateTotalPrice(checkbox) {
        var totalPrice = <?php echo $ramyeon_price; ?>;
        var checkboxes = document.querySelectorAll('input[name="toppings[]"]');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });
        var quantity = parseInt(document.getElementById('quantity').value);
        totalPrice *= quantity;
        document.getElementById('totalPrice').innerText = 'ราคาทั้งหมด: ' + totalPrice + '฿';
    }
</script>

 



   
           
                            
                            
                            <h4>จำนวน</h4>
                            <div class="qty">
                                <button type="button" class="btn-qty"
                                    onclick="decrementQuantity()">-</button>
                                    <input type="text" class="btn btn-qty" id="quantity" name="quantity" value="1" min="1" max="<?php echo $ramyeon_quantity; ?>">

                                <button type="button" class="btn-qty"
                                    onclick="incrementQuantity()">+</button>



                                    <script>
    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotalPrice(); // Update total price when quantity changes
        }
    }
    
    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        var maxQuantity = <?php echo $ramyeon_quantity; ?>;
        var currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity < maxQuantity) {
            quantityInput.value = currentQuantity + 1;
            updateTotalPrice(); // Update total price when quantity changes
        } else {
            alert('คุณไม่สามารถเพิ่มจำนวนสินค้าเกิน ' + maxQuantity + ' ได้');
        }
    }
</script>

                

                            </div>
                            <br>
                            <div class="cal-price">
                                <h5 id='totalPrice'>ราคาทั้งหมด: <?php echo $ramyeon_price; ?>฿ </h5>
                             
                            </div>
                            
                            
                            <hr>
                            <div class="back-and-addToBag">
                         
                                    
                                    <input type='hidden' name='ramyeon_id' value='<?php echo $ramyeon_id; ?>'>

                                <input type="submit"  class="add-to-bag" value="เพิ่มลงตะกร้า">
                            </div>
                            </form>
                    </div>
                </div>

            </div>
        </section>

    <?php  $conn->close();  }?>
</body>

</html>