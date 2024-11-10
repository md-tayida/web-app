<?php 
session_start();
include 'backend/conndb.php';
include 'backend/bootstrap.php'; 




?>

<script>
        // กำหนดเวลาในหน่วยมิลลิวินาที (5 นาที)
        const countdownTime = 1 * 60 * 1000; // 1 นาที * 60 วินาที * 1000 มิลลิวินาที

        // เวลาเริ่มต้น
        const startTime = Date.now();

        // เริ่มนับถอยหลังเมื่อหน้าเว็บโหลดเสร็จสิ้น
        window.onload = function () {
            // เริ่มนับถอยหลัง
            setTimeout(function () {
                // เมื่อเวลานับถอยหลังเสร็จสิ้น ให้เปลี่ยนหน้าไปยังหน้าอื่น.html
                window.location.href = 'index_en.php';
            }, countdownTime);

            // รอการอัปเดตเวลาทุกๆ 1 วินาที
            setInterval(updateTimer, 1000);
        };

        // ฟังก์ชันสำหรับอัปเดตเวลาที่แสดงบนหน้าเว็บ
        function updateTimer() {
            // คำนวณเวลาที่เหลือ
            const timeLeft = Math.ceil((countdownTime - (Date.now() - startTime)) / 1000);
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            // แสดงเวลาที่เหลือในรูปแบบ นาที:วินาที
            document.getElementById('timer').innerText = `Go to The Starting Page Within: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    </script> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill EN</title>
    <style> 
      body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            background-color: #561d03;}
    .count-to-restart {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-top: 2rem;
}
    
    .count-to-restart {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-top: 2rem;
}

.count-to-restart h2{
    color: #e9ddcc;;
    font-size: 40px;
}


.receipt {
    border: 1px solid #fff;
    padding: 15px;
    background-color: #fff;
    width: 600px;
    margin: 12px auto;
}

.detail-receipt p {
    font-size: 16px;
    background-color: #fff;
}

.queue {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 5px;
    margin: 12px auto;
}

.detail-receipt {
    padding: 5px;
}

.name-inReceipt h4,
.queue-inReceipt h5 {
    font-size: 28px;
}

.all-product {
    width: 100%;
    height: auto;
    
   
    padding: 5px;
    /* background-color: red; */
   
}
ul{
  list-style-type: none;
}
li {
  list-style-type: none;}

.row {
    display: flex;
}
.col-5{
    /* background-color: blue; */
    width: 300px;
    /* color: white; */
}.col-1{
    /* background-color: green; */
    width: 100px;
    /* color: white; */
}


.qty-inReciept,
.price-inReciept {
    text-align: right;
    
}

.produtct-des-inReceipt p,
.qty-inReciept,
.price-inReciept {
    font-size: 22px;
    
}

.total-price-inRecipt {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px;
    
}

.total-price-inRecipt h5 {
    font-size: 18px;
    margin-top: 10px;
    
}

.thanks {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.thanks h3 {
    font-size: 1.8vw;
}

.btn-to-restart {
    display: flex;
    justify-content: center;
    width: 100%;
}

.to-restart-page {
    background-color: #ff9b19;
    border-color: #ff9b19;
    color: white;
    width: 30%;
    font-size: 1.3vw;
    margin-top: 1rem;
    margin-bottom: 2rem;
    padding: 1vh;
    border-radius: 5px;
}

/*จบส่วนใบเสร็จ*/</style>

</head>

<body>
    <?php
    if(isset($_SESSION['order_id'])) {

        $order_id = $_SESSION['order_id']; ?>
        <div class="count-to-restart">
        <h2 id="timer">Go to The Starting Page Within: 1.00</h2>
    </div>
    
    <div class="receipt">
    <?php 
        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
         
            echo "<ul>";
            $price = 0;
            $total_price_all_items = 0;
        
            
            $location = $_SESSION['location'];
         
                
                
                ?>
        <div class="queue">
            <div class="name-inReceipt">
                <!--ชื่อร้าน-->
                <h4>RAMYEON SABB</h4>
            </div>
            <div class="queue-inReceipt">
                <!--คิว-->
                <h5><?php echo " $order_id";?></h5>
            </div>

        </div>
        <hr>
        <div class="detail-receipt">
    <?php
        $query = "SELECT * FROM orders o 
        join payments p on p.payment_id = o.payment_id WHERE order_id = '$order_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <p><strong>Type:</strong> <?php echo $row['eat_location']; ?></p>
    <p><strong>Date:</strong>  <?php echo $row['order_date']; ?></p>
    <p><strong>Time:</strong>  <?php echo $row['order_time']; ?></p>
    <p><strong>Payment Type:</strong> <?php echo $row['payment_method']; ?></p>
</div>

       <hr>
        <div class="all-product">
            
        <?php 

  

    
foreach ($_SESSION["cart"] as $key => $item) {
    

    if (!empty($item['drink_id'])){
        $drink_query = "SELECT * FROM Drinks WHERE drink_id = '{$item['drink_id']}'";
        $drink_result = mysqli_query($conn, $drink_query);
        $drink_row = mysqli_fetch_assoc($drink_result);
        $drink_price = $drink_row['drink_price'];
        $drink_name = $drink_row['drink_name_en'];
    
        // Calculate total price for the item (drink price * quantity)
        $total_price_item = $drink_price * $item['quantity'];
        $price = $drink_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h5>{$drink_name}</h5>";
    
        // Display selected toppings
       
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$item['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
        
        // Add a form to remove the item from the cart
        
        
        echo "</li></div>"; // Close the list item for the current item
    }
    

    if (!empty($item['sideDishes_id'])){
        $sideDishes_query = "SELECT * FROM SideDishes WHERE sideDishes_id = '{$item['sideDishes_id']}'";
        $sideDishes_result = mysqli_query($conn, $sideDishes_query);
        $sideDishes_row = mysqli_fetch_assoc($sideDishes_result);
        $sideDishes_price = $sideDishes_row['sideDishes_price'];
        $sideDishes_name = $sideDishes_row['sideDishes_name_en'];
    
        // Calculate total price for the item (sideDishes price * quantity)
        $total_price_item = $sideDishes_price * $item['quantity'];
        $price = $sideDishes_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h5>{$sideDishes_name}</h5>";
    
        // Display selected toppings
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$item['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
       
        
        // Add a form to remove the item from the cart
    
        
        echo "</li></div>"; // Close the list item for the current item
    }
    
    // Query to select ramyeon price
    if (!empty($item['ramyeon_id'])){
    $ramyeon_query = "SELECT * FROM Ramyeons WHERE ramyeon_id = '{$item['ramyeon_id']}'";
    $ramyeon_result = mysqli_query($conn, $ramyeon_query);
    $ramyeon_row = mysqli_fetch_assoc($ramyeon_result);
    $ramyeon_price = $ramyeon_row['ramyeon_price'];
    $ramyeon_name = $ramyeon_row['ramyeon_name_en'];

    // Calculate total price for the item (ramyeon price * quantity)
    $total_price_item = $ramyeon_price * $item['quantity'];
    $price = $ramyeon_price;

    
    echo " <div class='row'> <div class='col-5 '> 
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
            echo "<li><h6>{$topping_row['topping_name_en']}</h6></li>";
        }
        echo "</ul>";
    }
    
    
    // Add total price of the current item to total price of all items
    $total_price_all_items += $total_price_item;
    
    echo "<br></div>";
    echo "<div class='col-1'> <p><b>{$item['quantity']}</b></p> </div>";
    echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
    
    
    // Add a form to remove the item from the cart

    
    
    // Display total price per item
  

    echo "</li></div>"; // Close the list item for the current item
}





}  echo "</div>";?>

<hr>
        <div class="total-price-inRecipt">
            <div>
                <h4><b>TOTAL</b></h4>
            </div>
            <div>
                <h4><b><?php echo $row['total_price']; ?><span>&#3647;</span></b></h4>
            </div>
        </div>
        <div class="thanks">
            <h3><b>Thank You!</b></h3>
        </div>
    </div>
    <div class="btn-to-restart">
        <button class="to-restart-page" onclick="window.location.href='index_en.php'">
            <span class="text">Starting Page</span>
        </button>
    </div>
        





    </div>
    
    </div>

</div>

<?php
    }else{
   
    }
// Close the database connection

?>







        </div>
       

  
<?php
    }

      mysqli_close($conn);
    
session_destroy();

?>
</body>
</html>



