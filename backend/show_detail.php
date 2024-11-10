<?php
session_start();
include('conndb.php');
include 'bootstrap.php';

// Check connection
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Query to retrieve order details
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    
    <style>
        .receipt {
            border: 2px solid black;
            width: 30%;
            margin: 0px auto;
            margin-top: 30px;
            
        }
        .btn-to-restart{
            text-align: center;
        }
     
        </style>
</head>

<body>

     
    
    <div class="receipt">
    <?php 
        
       
         
            echo "<ul>";
            $price = 0;
            $total_price_all_items = 0;
        
          
         
                
                
                ?>
                
        <div class="queue">
            <div class="name-inReceipt">
                <!--ชื่อร้าน-->
                <br>
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
        $query1 = "SELECT * FROM orders o 
        join payments p on p.payment_id = o.payment_id WHERE order_id = '$order_id'";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($result1); 
        if($row1['eat_location']=='Dine-In' || $row1['eat_location']=='Take-Away' ) {
        
            
        
    ?>
    <p><strong>Type:</strong> <?php echo $row1['eat_location']; ?></p>
    <p><strong>Date:</strong>  <?php echo $row1['order_date']; ?></p>
    <p><strong>Time:</strong>  <?php echo $row1['order_time']; ?></p>
    <p><strong>Payment Type:</strong> <?php echo $row1['payment_method']; ?></p>
</div>
<hr>
       
        <div class="all-product">
            
        <?php 

  
$sql = "SELECT *
FROM Order_details od 
JOIN orders o ON o.order_id = od.order_id
WHERE o.order_id = '$order_id'";

$result = mysqli_query($conn, $sql);

if (!empty($result)) {
    // วนลูปเพื่อแสดงรายละเอียดคำสั่งซื้อ
    while ($row = mysqli_fetch_assoc($result))  {
    

 
 $array = explode(',', $row['topping_id']);
 



    if (!empty($row['drink_id'])){
        $drink_query = "SELECT * FROM Drinks WHERE drink_id = '{$row['drink_id']}'";
        $drink_result = mysqli_query($conn, $drink_query);
        $drink_row = mysqli_fetch_assoc($drink_result);
        $drink_price = $drink_row['drink_price'];
        $drink_name = $drink_row['drink_name_en'];
    
        // Calculate total price for the item (drink price * quantity)
        $total_price_item = $drink_price * $row['quantity'];
        $price = $drink_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h6><b>{$drink_name}</b></h6>";
    
        // Display selected toppings
        
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
        
        // Add a form to remove the item from the cart
        
        
        echo "</li></div>"; // Close the list item for the current item
    }
    

    if (!empty($row['sideDishes_id'])){
        $sideDishes_query = "SELECT * FROM SideDishes WHERE sideDishes_id = '{$row['sideDishes_id']}'";
        $sideDishes_result = mysqli_query($conn, $sideDishes_query);
        $sideDishes_row = mysqli_fetch_assoc($sideDishes_result);
        $sideDishes_price = $sideDishes_row['sideDishes_price'];
        $sideDishes_name = $sideDishes_row['sideDishes_name_en'];
    
        // Calculate total price for the item (sideDishes price * quantity)
        $total_price_item = $sideDishes_price * $row['quantity'];
        $price = $sideDishes_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h6><b>{$sideDishes_name}</b></h6>";
    
        // Display selected toppings
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
       
        
        // Add a form to remove the item from the cart
    
        
        echo "</li></div>"; // Close the list item for the current item
    }

    
    
    
    // Query to select ramyeon price
    if (!empty($row['ramyeon_id'])){
    $ramyeon_query = "SELECT * FROM Ramyeons WHERE ramyeon_id = '{$row['ramyeon_id']}'";
    $ramyeon_result = mysqli_query($conn, $ramyeon_query);
    $ramyeon_row = mysqli_fetch_assoc($ramyeon_result);
    $ramyeon_price = $ramyeon_row['ramyeon_price'];
    $ramyeon_name = $ramyeon_row['ramyeon_name_en'];

    // Calculate total price for the item (ramyeon price * quantity)
    $total_price_item = $ramyeon_price * $row['quantity'];
    $price = $ramyeon_price;

    
    echo " <div class='row'> <div class='col-5 '> 
   <li><h6><b>{$ramyeon_name}</b></h6>";
   foreach ($array as $value) {
  

    // Display selected toppings
    
        echo "<ul>";
        
       
            // Query to select topping price
            $topping_query = "SELECT * FROM Toppings WHERE topping_id = '$value'";
            $topping_result = mysqli_query($conn, $topping_query);
            
            // Check if the query returned any results
            if ($topping_result && mysqli_num_rows($topping_result) > 0) {
                $topping_row = mysqli_fetch_assoc($topping_result);
                $topping_name = $topping_row['topping_name_en'];
                $topping_price = $topping_row['topping_price'];
    
                // Calculate total price for the topping (topping price * quantity)
                $total_price_item += $topping_price * $row['quantity'];
                $price += $topping_price;
                
                // Display topping name and price
                echo "<h6>{$topping_name}</h6>";
            } 
            echo "</ul>";
        }
      
    
    
    
    
    // Add total price of the current item to total price of all items
    $total_price_all_items += $total_price_item;
    
    echo "</div>";
    echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
    echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
    
    
    // Add a form to remove the item from the cart

    
    
    // Display total price per item
  

    echo "</li></div>"; // Close the list item for the current item
}





}}  echo "</div>";?>

<hr>
        <div class="total-price-inRecipt">
            <div>
                <h4><b>Total Price:  <?php echo intval($row1['total_price']); ?><span>&#3647;</span></b></h4>
</div>

        </div>
        <div class="btn-to-restart">
        <?php
if ($row1['order_status'] == 0) {
    echo "<a href='index.php' class='btn btn-warning'> ย้อนกลับ </a>";
    echo "&nbsp;&nbsp;&nbsp;"; // เพิ่มช่องว่างระหว่างลิงก์
    echo "<a href='update_status_1.php?order_id=".$order_id."&status=0' class='btn btn-success'> ยืนยันคำสั่งซื้อ</a>";
    
} elseif ($row1['order_status'] == 1) {
    echo "<a href='list_confirmed.php' class='btn btn-warning'> ย้อนกลับ </a>";
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<a href='update_status_2.php?order_id=".$order_id."' class='btn btn-success'>เสร็จสิ้น</a>";
} elseif ($row1['order_status'] == 2) {
    echo "<a href='list_completed.php' class='btn btn-warning'> ย้อนกลับ </a>";
   
}
elseif ($row1['order_status'] == 3) {
    echo "<a href='index.php?order_id=".$order_id."' class='btn btn-warning'>ย้อนกลับ</a>";
}
?>

    </div>
       
    </div>
    
        





    </div>
    
    </div>
    </div>
</div>

<?php

// Close the database connection

?>








       

    <!-- <script>
        // กำหนดเวลาในหน่วยมิลลิวินาที (5 นาที)
        const countdownTime = 1 * 60 * 1000; // 1 นาที * 60 วินาที * 1000 มิลลิวินาที

        // เวลาเริ่มต้น
        const startTime = Date.now();

        // เริ่มนับถอยหลังเมื่อหน้าเว็บโหลดเสร็จสิ้น
        window.onload = function () {
            // เริ่มนับถอยหลัง
            setTimeout(function () {
                // เมื่อเวลานับถอยหลังเสร็จสิ้น ให้เปลี่ยนหน้าไปยังหน้าอื่น.html
                window.location.href = './เริ่ม.html';
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
            document.getElementById('timer').innerText = `ไปยังหน้าเริ่มต้นภายใน: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    </script> -->
  
<?php
        }
        else{   ?>
             <p><strong>ประเภท:</strong> <?php echo $row1['eat_location']; ?></p>
    <p><strong>วันที่:</strong>  <?php echo $row1['order_date']; ?></p>
    <p><strong>เวลา:</strong>  <?php echo $row1['order_time']; ?></p>
    <p><strong>ประเภทชำระเงิน:</strong> <?php echo $row1['payment_method']; ?></p>
</div>
<hr>
       
        <div class="all-product">
            
        <?php 

  
$sql = "SELECT *
FROM Order_details od 
JOIN orders o ON o.order_id = od.order_id
WHERE o.order_id = '$order_id'";

$result = mysqli_query($conn, $sql);

if (!empty($result)) {
    // วนลูปเพื่อแสดงรายละเอียดคำสั่งซื้อ
    while ($row = mysqli_fetch_assoc($result))  {
    

 
 $array = explode(',', $row['topping_id']);
 



    if (!empty($row['drink_id'])){
        $drink_query = "SELECT * FROM Drinks WHERE drink_id = '{$row['drink_id']}'";
        $drink_result = mysqli_query($conn, $drink_query);
        $drink_row = mysqli_fetch_assoc($drink_result);
        $drink_price = $drink_row['drink_price'];
        $drink_name = $drink_row['drink_name_th'];
    
        // Calculate total price for the item (drink price * quantity)
        $total_price_item = $drink_price * $row['quantity'];
        $price = $drink_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h6><b>{$drink_name}</b></h6>";
    
        // Display selected toppings
        
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
        
        // Add a form to remove the item from the cart
        
        
        echo "</li></div>"; // Close the list item for the current item
    }
    

    if (!empty($row['sideDishes_id'])){
        $sideDishes_query = "SELECT * FROM SideDishes WHERE sideDishes_id = '{$row['sideDishes_id']}'";
        $sideDishes_result = mysqli_query($conn, $sideDishes_query);
        $sideDishes_row = mysqli_fetch_assoc($sideDishes_result);
        $sideDishes_price = $sideDishes_row['sideDishes_price'];
        $sideDishes_name = $sideDishes_row['sideDishes_name_th'];
    
        // Calculate total price for the item (sideDishes price * quantity)
        $total_price_item = $sideDishes_price * $row['quantity'];
        $price = $sideDishes_price;
    
        echo "<div class='row'>
            <div class='col-5'>
                <li><h6><b>{$sideDishes_name}</b></h6>";
    
        // Display selected toppings
        
        // Add total price of the current item to total price of all items
        $total_price_all_items += $total_price_item;
        
        echo "<br></div>";
        echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
        echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
       
        
        // Add a form to remove the item from the cart
    
        
        echo "</li></div>"; // Close the list item for the current item
    }

    
    
    
    // Query to select ramyeon price
    if (!empty($row['ramyeon_id'])){
    $ramyeon_query = "SELECT * FROM Ramyeons WHERE ramyeon_id = '{$row['ramyeon_id']}'";
    $ramyeon_result = mysqli_query($conn, $ramyeon_query);
    $ramyeon_row = mysqli_fetch_assoc($ramyeon_result);
    $ramyeon_price = $ramyeon_row['ramyeon_price'];
    $ramyeon_name = $ramyeon_row['ramyeon_name_th'];

    // Calculate total price for the item (ramyeon price * quantity)
    $total_price_item = $ramyeon_price * $row['quantity'];
    $price = $ramyeon_price;

    
    echo " <div class='row'> <div class='col-5 '> 
   <li><h6><b>{$ramyeon_name}</b></h6>";
   foreach ($array as $value) {
  

    // Display selected toppings
    
        echo "<ul>";
        
       
            // Query to select topping price
            $topping_query = "SELECT * FROM Toppings WHERE topping_id = '$value'";
            $topping_result = mysqli_query($conn, $topping_query);
            
            // Check if the query returned any results
            if ($topping_result && mysqli_num_rows($topping_result) > 0) {
                $topping_row = mysqli_fetch_assoc($topping_result);
                $topping_name = $topping_row['topping_name_th'];
                $topping_price = $topping_row['topping_price'];
    
                // Calculate total price for the topping (topping price * quantity)
                $total_price_item += $topping_price * $row['quantity'];
                $price += $topping_price;
                
                // Display topping name and price
                echo "<h6>{$topping_name}</h6>";
            } 
            echo "</ul>";
        }
      
    
    
    
    
    // Add total price of the current item to total price of all items
    $total_price_all_items += $total_price_item;
    
    echo "</div>";
    echo "<div class='col-1'> <p><b>{$row['quantity']}</b></p> </div>";
    echo "<div class='col-1'> <p><b>{$total_price_item}฿</b></p> </div>";
    
    
    // Add a form to remove the item from the cart

    
    
    // Display total price per item
  

    echo "</li></div>"; // Close the list item for the current item
}





}}  echo "</div>";?>

<hr>
        <div class="total-price-inRecipt">
            <div>
                <h4><b>ยอดรวม  <?php echo intval($row1['total_price']); ?><span>&#3647;</span></b></h4>
</div>

        </div>
        <div class="btn-to-restart">
        <?php
if ($row1['order_status'] == 0) {
    echo "<a href='index.php' class='btn btn-warning'> ย้อนกลับ </a>";
    echo "&nbsp;&nbsp;&nbsp;"; // เพิ่มช่องว่างระหว่างลิงก์
    echo "<a href='update_status_1.php?order_id=".$order_id."&status=0' class='btn btn-success'> ยืนยันคำสั่งซื้อ</a>";
    
} elseif ($row1['order_status'] == 1) {
    echo "<a href='list_confirmed.php' class='btn btn-warning'> ย้อนกลับ </a>";
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<a href='update_status_2.php?order_id=".$order_id."' class='btn btn-success'>เสร็จสิ้น</a>";
} elseif ($row1['order_status'] == 2) {
    echo "<a href='index.php' class='btn btn-warning'> ย้อนกลับ </a>";
   
}
elseif ($row1['order_status'] == 3) {
    echo "<a href='list_canceled.php?order_id=".$order_id."' class='btn btn-warning'>ย้อนกลับ</a>";
}
?>

    </div>
       
    </div>
    
        





    </div>
    
    </div>
    </div>
</div>

    <?php    }

      mysqli_close($conn);
    
//session_destroy();

?>
</body>

</html>
<?php } ?>
