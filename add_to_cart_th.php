<?php
session_start();

// Include database connection
include 'backend/conndb.php';
$total_price = 0;
// Check if form is submitted with ramyeon_id and quantity
if(isset($_POST['ramyeon_id']) && isset($_POST['quantity'])) {
    $ramyeon_id = $_POST['ramyeon_id'];
    $quantity = $_POST['quantity'];
    $toppings = isset($_POST['toppings']) ? $_POST['toppings'] : array();

}

//สร้าง key .sh session for check key ซ้ำกับรายการเดิมไหม


$index = ['ramyeon_id' => $ramyeon_id, 
            'toppings' => $toppings];

$key = $index['ramyeon_id'] . '_' . implode('_', $index['toppings']); 


$ramyeon_query = "SELECT * FROM Ramyeons WHERE ramyeon_id = '$ramyeon_id'";
$ramyeon_result = mysqli_query($conn, $ramyeon_query);
$ramyeon_row = mysqli_fetch_assoc($ramyeon_result);
$ramyeon_price = $ramyeon_row['ramyeon_price'];

$total_price = $ramyeon_price;

echo "<br>SESSION <h1 style=color:red;>topping </h1>: <br><pre>";         
   var_dump($toppings);         echo "</pre> <br>";

  
        // Retrieve topping price from database
        foreach ($toppings as $topping_id) {
            // Retrieve topping price from database
            $topping_query = "SELECT * FROM Toppings WHERE topping_id = '$topping_id'";
            $topping_result = mysqli_query($conn, $topping_query);
            $topping_row = mysqli_fetch_assoc($topping_result);
            $topping_price = $topping_row['topping_price'];

            // Add topping price to the total price
            $total_price += $topping_price;
        }
        $total_price= $total_price*$quantity;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // กำหนดค่าเริ่มต้นเป็นอาร์เรย์ว่าง หรือค่าตามที่ต้องการ
        }
        
       

       
     if (array_key_exists($key, $_SESSION['cart'])) {
      
        $_SESSION['cart'][$key]['quantity'] += $quantity;
        $_SESSION['cart'][$key]['total_price'] += $total_price;

    } else {
        $item = [
            'ramyeon_id' => $ramyeon_id,
            'quantity' => $quantity,
            'toppings' => $toppings,
            'total_price' => $total_price
        ];
        

        $_SESSION['cart'][$key] = $item;
      
    }
    header("Location: menu_ramyeon_th.php");
    exit();
    


mysqli_close($conn);
?>
