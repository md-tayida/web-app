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
    <title>select drink EN</title>
    <!-- link css -->
 
    <link rel="stylesheet" href="f-style.css">

    <!-- cnd -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   

    <style>

        
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
                <!-- change lang button -->
                <div class="main-bag">
                    <a href="cart_en.php">
                        <i class="bi bi-bag-heart-fill"></i>
                        <span class="quantity"> <?php if (isset($_SESSION['cart']) ){
                echo count($_SESSION['cart']); }else{echo"0";} ?>
            </span>
                    </a>
                </div>
                <!-- cancel button -->
                <div class="main-cancel-button">
                    <a href="back_to_index_en.php">CANCEL</a>
                </div>
                <!-- bag logo button -->
           
            </div>
        </div>
        <br>
    </header>

        <?php 
    //echo "<script> alert('Data Deleted Successfully'); window.location.href='exam_form.php'; </script>";

    // Check if drink_id is provided in URL parameter
    if(isset($_GET['drink_id'])) {
        $drink_id = $_GET['drink_id'];
        
        // Query to select drink name and price based on drink_id
        $sql = "SELECT * FROM drinks WHERE drink_id = '$drink_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the drink exists
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $drink_name = $row['drink_name_th'];
            $drink_price = $row['drink_price'];
            $drink_quantity = $row['drink_quantity'];
           ?>

        <section class="sec-custom">
            <div class="custom-topping-detail">
                <div class="row">
                    <div class="col-md-5 menu-detail">
                    <div class='back-menu'>
                        <a href="menu_side_en.php" ><i class="bi bi-chevron-left"></i></a>
                                </div> <br>
                        <div class="select-img">
                            <img src="backend/img/<?php echo $row['drink_img'] ;?>">
                        </div>
                        <div class="menu-des">
                        <div class="food-menu-name" style=' width:80%;'>
                   <br> <?=$row['drink_name_en']?>
                    
                    
                </div>
                <div class="food-menu-price">
                    <?=$row['drink_price']?>฿ </div>
                            
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
        var totalPrice = <?php echo $drink_price; ?>;
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
                                    <input type="text" class="btn btn-qty" id="quantity" name="quantity" value="1" min="1" max="<?php echo $drink_quantity; ?>">

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
        var maxQuantity = <?php echo $drink_quantity; ?>;
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
                                <h5 id='totalPrice'>Total Price: <?php echo $drink_price; ?>฿ </h5>
                                
                            </div>
                            
                          
                            <hr>
                            <div class="back-and-addToBag">
                         
                                    
                                    <input type='hidden' name='drink_id' value='<?php echo $drink_id; ?>'>

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
