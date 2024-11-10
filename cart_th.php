<?php
session_start(); 

// Include database connection
include 'backend/conndb.php';
include 'backend/bootstrap.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart TH</title>
    <!--bootstrap cnd -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- css -->
    <link rel="stylesheet" href="f-style.css">
    <style> 
     .bag {
    margin: 30px auto;
    max-width: 1200px;
    width: 1100px;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 16px; /* 1rem = 16px */
}

.shopping-bag {
    background-color: #fff;
    padding: 4vh 5vh;
    border-top-right-radius: 16px;
    border-top-left-radius: 16px;
}

.main {
   
    padding: 2vh 0;
    width: 100%;
    display: grid;
    grid-template-columns: 64% 20% 8% 8%;
    align-items: center;
}

.summary-inSum {
    background-color: #ddd;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
    padding: 4vh;
    color: rgb(65, 65, 65);
}

.title-inSum h4,
.title-inSum h5 {
    font-size: 24px; /* 1.5vw เปลี่ยนเป็น px แทน */
}

.loca-inSum p {
    font-size: 19.2px; /* 1.2vw เปลี่ยนเป็น px แทน */
}

.product-name-inSum h6 {
    font-size: 17.6px; /* 1.1vw เปลี่ยนเป็น px แทน */
    margin-left: 16px; /* 1rem เปลี่ยนเป็น px แทน */
}

.topping-detail-inSum p {
    font-size: 16px; /* 1vw เปลี่ยนเป็น px แทน */
    margin-left: 48px; /* 3rem เปลี่ยนเป็น px แทน */
    margin-bottom: 2px;
}

.price-inSum,
.qty-inSum {
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-trash {
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.price-inSum p,
.btn-trash i {
    font-size: 19.2px; /* 1.2vw เปลี่ยนเป็น px แทน */
    margin: 0;
}

.qty-inSum {
    display: flex;
    align-items: center;
}

.qty-inSum button {
    background-color: #fff;
    border: 1px solid rgb(65, 65, 65);
    border-radius: 5px;
    color: black;
    padding: 12.8px 32px; /* 8px 20px เปลี่ยนเป็น px แทน */
    font-size: 19.2px; /* 1.2vw เปลี่ยนเป็น px แทน */
    cursor: pointer;
}

.qty-inSum input {
    border: none;
    color: black;
    text-align: center;
    padding: 12.8px 9.6px; /* 8px 6px เปลี่ยนเป็น px แทน */
    font-size: 19.2px; /* 1.2vw เปลี่ยนเป็น px แทน */
    width: 50px;
    margin: 0 5px;
    background-color: #fff;
}

.total-price-des-inSum {
    display: flex;
    justify-content: space-between;
}

.total-price-des-inSum h5 {
    font-size: 19.2px; /* 1.3vw เปลี่ยนเป็น px แทน */
}

.cal-price {
    display: flex;
    justify-content: start;
    align-items: center;
    margin-top: 16px; /* 1rem เปลี่ยนเป็น px แทน */
}

.cal-price h6 {
    font-size: 19.2px; /* 1.3vw เปลี่ยนเป็น px แทน */
}

.cal-total-price {
    margin-left: 8px; /* 0.5rem เปลี่ยนเป็น px แทน */
}


ul{
  list-style-type: none;
}
li {
  list-style-type: none;}

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
.col-5, .col-3, .col-2{
    float: left;
}
.btn-qty {
    background-color: #fff;
    border: 1px solid rgb(65, 65, 65);
    border-radius: 5px;
    color: black;
    padding: 8px 20px;
    font-size: 1.2vw;
    cursor: pointer;
    align-items: center;
}
.btn-btn-qty{
    border: 1px solid rgb(65, 65, 65);
    color: black;
    text-align: center;
    padding: 8px 5px;
    font-size: 1.2vw;
    width: 85px;
    border-radius: 5px;
    margin: 0 5px;
    background-color: #fff;

    

}

.delete-btn {
    border: none; /* ลบเส้นขอบ */
    background-color: transparent; /* ลบสีพื้นหลัง */
    cursor: pointer; /* เปลี่ยน cursor เมื่อชี้ไปที่ปุ่ม */
}

.sr-only {
    position: absolute; /* ช่วยให้ label ถูกซ่อนออกจากหน้าจอ */
    width: 2px;
    height: 2px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap; /* ป้องกันการขึ้นบรรทัดใหม่ */
    border: 0; /* ลบเส้นขอบ */
}
.btn-qty {
    padding: 8px 20px;
    font-size: 19.2px;
}





.main-cancel-button a,
.main-bag a {
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

                <!-- cancel button -->
                <div class="main-cancel-button">
                    <a href="back_to_index_th.php">ยกเลิก</a>
                </div>

            </div>
        </div>
        
    </header>
    <section>
        
  <div class="bag">
        <div class="col-md-12 shopping-bag">
            <div class="title-loca-des-inSum"></div>
            <div class="title-inSum">
            <span class='back-menu'>
                        <a href="menu_ramyeon_th.php" ><i class="bi bi-chevron-left"></i></a>
                              
           
                <h4>ตะกร้าสินค้า</h4> </span> 
            </div>
            <?php 
        
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
 
    echo "<ul>";
    $price = 0;
    $total_price_all_items = 0;

    
    $location = $_SESSION['location'];
 
        
        
        ?>
            <div class="loca-inSum">
         
                <p><?php echo  $location;?></p>
            </div>
            <hr>
            
            <div class='row' >
                

<?php 

  

    
    foreach ($_SESSION["cart"] as $key => $item) {

        if (!empty($item['drink_id'])){
            $drink_query = "SELECT * FROM Drinks WHERE drink_id = '{$item['drink_id']}'";
            $drink_result = mysqli_query($conn, $drink_query);
            $drink_row = mysqli_fetch_assoc($drink_result);
            $drink_price = $drink_row['drink_price'];
            $drink_name = $drink_row['drink_name_th'];
        
            // Calculate total price for the item (drink price * quantity)
            $total_price_item = $drink_price * $item['quantity'];
            $price = $drink_price;
        
            echo "<div>
                <div class='col-5'>
                    <li><h5>{$drink_name} </h5>";
        
         
            
            // Add total price of the current item to total price of all items
            $total_price_all_items += $total_price_item;
            
            echo "<br></div><div class='col-3'>";
            echo "    <form action='update_quantity_th.php' method='post'>";
            echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
            echo "        <input type='hidden' name='cur_price' value='{$price}'>";
            echo "        <input type='hidden' name='current_quantity' value='{$item['quantity']}'>";
            echo "        <button type='submit' class='btn-qty' name='action' value='decrement'>-</button>";
            echo "        <input type='text' class='btn-btn-qty' id='quantity' name='quantity' value='{$item['quantity']}' min='1' max='4'>";
            echo "        <button type='submit' class='btn-qty' name='action' value='increment'>+</button>";
            echo "    </form>";
            echo "</div>";
            echo "<div class='col-2'> <p>{$total_price_item}฿</p> </div>";
            
            // Add a form to remove the item from the cart
            echo "<div class='col-2'>";
            echo "    <form action='delete_item_th.php' method='post'>";
            echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
            echo "        <button type='submit' class='delete-btn'>";
            echo "            <label for='deleteItem' class='sr-only'>Delete Item</label>";
            echo "            <i class='bi bi-trash3-fill'></i>";
            echo "        </button>";
            echo "    </form>";
            echo "</div>";
            
            echo "</li></div>"; // Close the list item for the current item
        }
        

        if (!empty($item['sideDishes_id'])){
            $sideDishes_query = "SELECT * FROM SideDishes WHERE sideDishes_id = '{$item['sideDishes_id']}'";
            $sideDishes_result = mysqli_query($conn, $sideDishes_query);
            $sideDishes_row = mysqli_fetch_assoc($sideDishes_result);
            $sideDishes_price = $sideDishes_row['sideDishes_price'];
            $sideDishes_name = $sideDishes_row['sideDishes_name_th'];
        
            // Calculate total price for the item (sideDishes price * quantity)
            $total_price_item = $sideDishes_price * $item['quantity'];
            $price = $sideDishes_price;
        
            echo "<div>
                <div class='col-5'>
                    <li><h5>{$sideDishes_name}</h5>";
        
            // Add total price of the current item to total price of all items
            $total_price_all_items += $total_price_item;
            
            echo "<br></div><div class='col-3'>";
            echo "    <form action='update_quantity_th.php' method='post'>";
            echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
            echo "        <input type='hidden' name='cur_price' value='{$price}'>";
            echo "        <input type='hidden' name='current_quantity' value='{$item['quantity']}'>";
            echo "        <button type='submit' class='btn-qty' name='action' value='decrement'>-</button>";
            echo "        <input type='text' class='btn-btn-qty' id='quantity' name='quantity' value='{$item['quantity']}' min='1' max='4'>";
            echo "        <button type='submit' class='btn-qty' name='action' value='increment'>+</button>";
            echo "    </form>";
            echo "</div>";
            echo "<div class='col-2'> <p>{$total_price_item}฿</p> </div>";
            
            // Add a form to remove the item from the cart
            echo "<div class='col-2'>";
            echo "    <form action='delete_item_th.php' method='post'>";
            echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
            echo "        <button type='submit' class='delete-btn'>";
            echo "            <label for='deleteItem' class='sr-only'>Delete Item</label>";
            echo "            <i class='bi bi-trash3-fill'></i>";
            echo "        </button>";
            echo "    </form>";
            echo "</div>";
            
            echo "</li></div>"; // Close the list item for the current item
        }
        
        // Query to select ramyeon price
        if (!empty($item['ramyeon_id'])){
        $ramyeon_query = "SELECT * FROM Ramyeons WHERE ramyeon_id = '{$item['ramyeon_id']}'";
        $ramyeon_result = mysqli_query($conn, $ramyeon_query);
        $ramyeon_row = mysqli_fetch_assoc($ramyeon_result);
        $ramyeon_price = $ramyeon_row['ramyeon_price'];
        $ramyeon_name = $ramyeon_row['ramyeon_name_th'];

        // Calculate total price for the item (ramyeon price * quantity)
        $total_price_item = $ramyeon_price * $item['quantity'];
        $price = $ramyeon_price;

        
        echo " <div> <div class='col-5 '> 
       <li><h5>{$ramyeon_name}</h5>";

        // Display selected toppings
        if (!empty($item['toppings'])) {
            echo "<ul>";
            foreach ($item['toppings'] as $topping_id) {
                // Query to select topping price
                $topping_query = "SELECT * FROM Toppings WHERE topping_id = '$topping_id'";
                $topping_result = mysqli_query($conn, $topping_query);
                $topping_row = mysqli_fetch_assoc($topping_result);
                $topping_price = $topping_row['topping_price'];

                // Calculate total price for the topping (topping price * quantity)
                $total_price_item += $topping_price * $item['quantity'];
                $price += $topping_price;
                
                // Display topping name and price
                echo "<li>{$topping_row['topping_name_th']} ({$topping_price}฿)</li>";
            }
            echo "</ul>";
        }
        
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div><div class='col-3'>";
        echo "    <form action='update_quantity_th.php' method='post'>";
        echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
        echo "        <input type='hidden' name='cur_price' value='{$price}'>";
        echo "        <input type='hidden' name='current_quantity' value='{$item['quantity']}'>";
        echo "        <button type='submit' class='btn-qty' name='action' value='decrement'>-</button>";
        echo "        <input type='text' class='btn-btn-qty' id='quantity' name='quantity' value='{$item['quantity']}' min='1' max='4'>";
        echo "        <button type='submit' class='btn-qty' name='action' value='increment'>+</button>";
        echo "    </form>";
        echo "</div>";
        echo "<div class='col-2'> <p>{$total_price_item}฿</p> </div>";
        
        // Add a form to remove the item from the cart
        echo "<div class='col-2'>";
echo "    <form action='delete_item_th.php' method='post'>";
echo "        <input type='hidden' name='indexes' value='" . $key . "'>";
echo "        <button type='submit' class='delete-btn'>"; // เพิ่ม class 'delete-btn' เพื่อใช้ CSS
echo "            <label for='deleteItem' class='sr-only'>Delete Item</label>"; // เพิ่ม class 'sr-only' เพื่อทำให้ label เป็น content ที่ไม่เห็นในหน้าเว็บ
echo "            <i class='bi bi-trash3-fill'></i>";
echo "        </button>";
echo "    </form>";
echo "</div>";

        
        
        // Display total price per item
      

        echo "</li></div>"; // Close the list item for the current item
    }
    
    
   
    
    
    }  echo "</div>";?>


            





        </div>

        <div class="col-md-12 summary-inSum">

            <div class="title-inSum">
                <h5>สรุปรายละเอียดคำสั่งซื้อ</h5>
            </div>
            <hr>

            <div class="total-price-des-inSum">
                <div class="total-price-title">
                    <h5>ยอดรวม</h5>
                </div>
                <div class="total-price">
                    <h5><?php echo "$total_price_all_items"; ?><span>&#3647;</span></h5>
                </div>
            </div>
            <div class="back-and-addToBag">
              
            <form action='select_payment_th.php' method='post' >
            <button type='submit'  class="add-to-bag">
                    <span class="text">ดำเนินการชำระเงิน</span>
            </button>
</form>

            
         
        </div>

    </div>
    </div>
</section>
    
<?php
        }else{
       
        }
// Close the database connection
mysqli_close($conn);
?>

</body>

</html>





