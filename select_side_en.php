<?php
    // Include database connection
    //include 'backend/bootstrap.php';
    session_start();
    include 'backend/conndb.php'; ?>
    	  


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select side EN</title>
    <!-- link css -->
 
    <link rel="stylesheet" href="style3.css">

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
                    <div class="main-bag">
                        <a href="cart_en.php">
                            <i class="bi bi-bag-heart-fill"></i>
                            <span class="quantity"><?php if (isset($_SESSION['cart']) ){
                echo count($_SESSION['cart']); }else{echo"0";} ?></span>
                        </a>
                    </div>
                    <!-- cancel button -->
                    <div class="main-cancel-button">
                        <a href="back_to_index_en.php">CANCEL</a>
                    </div>
                    
                    
                </div>
            </div>
            <br>
        </header>

        <?php 
    //echo "<script> alert('Data Deleted Successfully'); window.location.href='exam_form.php'; </script>";

    // Check if sideDishes_id is provided in URL parameter
    if(isset($_GET['sideDishes_id'])) {
        $sideDishes_id = $_GET['sideDishes_id'];
        
        // Query to select sideDishes name and price based on sideDishes_id
        $sql = "SELECT * FROM sideDishes WHERE sideDishes_id = '$sideDishes_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the sideDishes exists
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $sideDishes_name = $row['sideDishes_name_th'];
            $sideDishes_price = $row['sideDishes_price'];
            $sideDishes_quantity = $row['sideDishes_quantity'];
           ?>

        <section class="sec-custom">
            <div class="custom-topping-detail">
                <div class="row">
                    <div class="col-md-5 menu-detail">
                    <div class='back-menu'>
                        <a href="menu_side_en.php" ><i class="bi bi-chevron-left"></i></a>
                                </div> <br>
                        <div class="select-img">
                            <img src="backend/img/<?php echo $row['sideDishes_img'] ;?>">
                        </div>
                        <div class="menu-des">
                        <div class="food-menu-name" style='width:80%;'>
                 <br>   <?=$row['sideDishes_name_en']?>
                    
                    
                </div>
                <div class="food-menu-price">
                    <?=$row['sideDishes_price']?>฿

                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-7 summary">
                        <div>
                            <h3>Customize Your Meals </h3>
                        </div>
                        <hr>
                       
                           
                         <?php   
                         
                        
                        
                         
                      ?>
<script>
    function updateTotalPrice(checkbox) {
        var totalPrice = <?php echo $sideDishes_price; ?>;
        var checkboxes = document.querySelectorAll('input[name="toppings[]"]');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });
        var quantity = parseInt(document.getElementById('quantity').value);
        totalPrice *= quantity;
        document.getElementById('totalPrice').innerText = 'Total Price: ' + totalPrice + ' ฿';
    }
</script>

 



   
           
                            
                            
                            <h4>Quantity</h4>
                            <form action='add_to_cart2.php' method='post'>
                            <div class="qty" >
                                <button type="button" class="btn-qty"
                                    onclick="decrementQuantity()">-</button>
                                    <input type="text" class="btn btn-qty" id="quantity" name="quantity" value="1" min="1" max="<?php echo $sideDishes_quantity; ?>">

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
        var maxQuantity = <?php echo $sideDishes_quantity; ?>;
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
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="cal-price">
                                <h5 id='totalPrice'>Total Price: <?php echo $sideDishes_price; ?>฿</h5>
                                
                            </div>
                            
                          
                            <hr>
                            <div class="back-and-addToBag">
                         
                                    
                                    <input type='hidden' name='sideDishes_id' value='<?php echo $sideDishes_id; ?>'>

                                <input type="submit"  class="add-to-bag" value="Add to Cart">
                            </div>
                            </form>
                    </div>
                </div>

            </div>
        </section>

    <?php }  } $conn->close();?>
</body>

</html>
