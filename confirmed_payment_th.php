<?php 
session_start();
include 'backend/conndb.php';
include 'backend/bootstrap.php';

// Set timezone to Asia/Bangkok
date_default_timezone_set('Asia/Bangkok');
$current_date = date("dmy");


// Retrieve the latest order count and last date from the database
$current_date = date("dmy");


// Retrieve the latest order count and last date from the database
$get_latest_order_query = "SELECT SUBSTRING_INDEX(order_id, '-', -1) AS order_count, order_date
FROM Orders
WHERE DATE(order_date) = (SELECT MAX(order_date) FROM Orders)
ORDER BY order_time DESC limit 1

";
$latest_order_result = mysqli_query($conn, $get_latest_order_query);
$row = mysqli_fetch_assoc($latest_order_result);
$order_count = $row['order_count'];
$last_date = $row['order_date'];
echo "<br>SESSION <h1 style=color:pink;>CART </h1>: $order_count <br><pre>";         
echo "</pre> <br>";

// Check if current date is different from the last date in the database
if (date("Ymd") > date("Ymd", strtotime($last_date))) {
    // If the current date is different, reset the order count to 1
    $order_count = 1;
}
else {
    // If the current date is the same, increment the order count
    $order_count++;
}

// Format order count with leading zeros
$order_count_formatted = sprintf("%03d", $order_count);

// Generate Order ID by combining current date and order count
$order_id = $current_date . '-' . $order_count_formatted;
$_SESSION['order_id'] = $order_id;

$all_price = 0;

echo "<br>SESSION <h1 style=color:pink;>CART </h1>: $order_id <br><pre>";         
echo "</pre> <br>";

if(isset($_SESSION['payment']) && isset($_SESSION['payment_id'])) {
    $payment = $_SESSION['payment_id'];
    $payment_methods = $_SESSION['payment'];

    echo "<br>SESSION <h1 style=color:yellow;>payment </h1>: $payment $payment_methods<br><pre>";         
    echo "</pre> <br>";

    $sql = "INSERT INTO `payments`(`payment_id`, `payment_method`)
    VALUES ( '$payment','$payment_methods')";
    mysqli_query($conn, $sql); 

    if (isset($_SESSION['cart']) && isset($_SESSION['location']) && !empty($_SESSION['cart']) && !empty($_SESSION['location'])) {
        $location = $_SESSION['location'];
        $sql1 = "INSERT INTO `orders`(`order_id`, `eat_location`,payment_id) 
                 VALUES ('$order_id', '$location','$payment')";
        mysqli_query($conn, $sql1);

        echo "<br>SESSION <h1 style=color:red;>BLUE </h1>: $order_id <br><pre>";         
        echo "</pre> <br>";

        echo "<br>SESSION <h1 style=color:red;>CART </h1>: <br><pre>";         
        print_r($_SESSION['cart']);         
        echo "</pre> <br>";

        foreach ($_SESSION["cart"] as $key => $item) {
            if (!empty($item['toppings'])) {
                $toppings = implode(",", $item['toppings']);
            } else {
                $toppings = '';
            }
            if (!empty($item['ramyeon_id'])){

                $sql2 = "INSERT INTO `order_details`(`order_id`, `ramyeon_id`, `topping_id`,  `quantity`, `price_per_list`) 
                         VALUES ('$order_id', '{$item['ramyeon_id']}', '$toppings', '{$item['quantity']}', '{$item['total_price']}')";
                mysqli_query($conn, $sql2);
                
                $all_price += $item['total_price'];
                $sql3 = "UPDATE ramyeons SET ramyeon_quantity = ramyeon_quantity-{$item['quantity']} where ramyeon_id = '{$item['ramyeon_id']}' ;";
                mysqli_query($conn, $sql3);
            }
            if (!empty($item['drink_id'])){

                $sql2 = "INSERT INTO `order_details`(`order_id`, `drink_id`, `topping_id`,  `quantity`, `price_per_list`) 
                         VALUES ('$order_id', '{$item['drink_id']}', '$toppings', '{$item['quantity']}', '{$item['total_price']}')";
                mysqli_query($conn, $sql2);
                
                $all_price += $item['total_price'];
                $sql3 = "UPDATE drinks SET drink_quantity = drink_quantity-{$item['quantity']} where drink_id = '{$item['drink_id']}' ;";
                mysqli_query($conn, $sql3);
            }
            if (!empty($item['sideDishes_id'])){

                $sql2 = "INSERT INTO `order_details`(`order_id`, `sideDishes_id`, `topping_id`,  `quantity`, `price_per_list`) 
                         VALUES ('$order_id', '{$item['sideDishes_id']}', '$toppings', '{$item['quantity']}', '{$item['total_price']}')";
                mysqli_query($conn, $sql2);
                
                $all_price += $item['total_price'];
                $sql3 = "UPDATE sidedishes SET sidedishes_quantity = sidedishes_quantity-{$item['quantity']} where sideDishes_id = '{$item['sideDishes_id']}' ;";
                mysqli_query($conn, $sql3);
            }
            
           
        }
    }

        $sql3 = "UPDATE `orders` SET `total_price`='$all_price' WHERE order_id = '$order_id'";
        mysqli_query($conn, $sql3);
        $sql4 = "UPDATE `payments` SET `amount`='$all_price' WHERE payment_id = '" . $_SESSION['payment_id'] . "'";
        mysqli_query($conn, $sql4);
        

        header("Location: get_bill_th.php");
        exit();
    }


mysqli_close($conn);
?>
