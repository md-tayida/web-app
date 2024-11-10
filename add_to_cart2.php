<?php
session_start();

// Include database connection
include 'backend/conndb.php';
$total_price = 0;

if(isset($_POST['sideDishes_id']) && isset($_POST['quantity'])) {
        $sideDishes_id = $_POST['sideDishes_id'];
        $quantity = $_POST['quantity'];
    
        // Create an index key for checking if the same item already exists in the cart
        $index = ['sideDishes_id' => $sideDishes_id];
        $key = $index['sideDishes_id'] ;
        
    
        $query2 = "SELECT * FROM sidedishes WHERE sideDishes_id = '$sideDishes_id'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $sideDishes_price = $row2['sideDishes_price'];
    
        $total_price = $sideDishes_price * $quantity;
    
        // Ensure the cart session variable exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        // Check if the item already exists in the cart
        if (array_key_exists($key, $_SESSION['cart'])) {
            // If exists, update the quantity and total price
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $_SESSION['cart'][$key]['total_price'] += $total_price;
        } else {
            // If not exists, add the new item to the cart
            $item = [
                'sideDishes_id' => $sideDishes_id,
                'quantity' => $quantity,
                'total_price' => $total_price
            ];
    
            $_SESSION['cart'][$key] = $item;
        }
    
        // Redirect back to the side dishes menu
        header("Location: menu_side_en.php");
        exit();
    }

    if(isset($_POST['drink_id']) && isset($_POST['quantity'])) {
        $drink_id = $_POST['drink_id'];
        $quantity = $_POST['quantity'];
    
        // Create an index key for checking if the same item already exists in the cart
        $index = ['drink_id' => $drink_id];
        $key = $index['drink_id'] ;
    
        $query2 = "SELECT * FROM drinks WHERE drink_id = '$drink_id'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $drink_price = $row2['drink_price'];
    
        $total_price = $drink_price * $quantity;
    
        // Ensure the cart session variable exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        // Check if the item already exists in the cart
        if (array_key_exists($key, $_SESSION['cart'])) {
            // If exists, update the quantity and total price
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $_SESSION['cart'][$key]['total_price'] += $total_price;
        } else {
            // If not exists, add the new item to the cart
            $item = [
                'drink_id' => $drink_id,
                'quantity' => $quantity,
                'total_price' => $total_price
            ];
    
            $_SESSION['cart'][$key] = $item;
        }
    
        // Redirect back to the drinks menu
        header("Location: menu_drink_en.php");
        exit();
    }
    
    mysqli_close($conn);
?>
