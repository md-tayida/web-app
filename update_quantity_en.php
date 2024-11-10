<?php
session_start();
include 'backend/conndb.php';

if(isset($_POST['action']) && isset($_POST['quantity']) && isset($_POST['indexes'])&&isset($_POST['cur_price'])) {
    $action = $_POST['action'];
    $quantity = $_POST['quantity'];
    $indexes = $_POST['indexes'];
    $total_price = $_POST['cur_price'];

    // Validate quantity
    if(!is_numeric($quantity) || $quantity <= 0) {
        // Invalid quantity, redirect back to cart page
        header("Location: cart.php");
        exit();
    }

    // Check if cart session variable exists and is not empty
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Loop through the cart items
        foreach ($_SESSION['cart'] as $key => $item) {
            // Check if the current item's key matches the indexes sent from the form
            if($key === $indexes) {
                // Update quantity based on action (increment or decrement)
                if($action === 'increment') {
                    $_SESSION['cart'][$key]['quantity'] += 1;
                    $_SESSION['cart'][$key]['total_price'] += $total_price;
                   
                  
                    
        
        echo "<br>SESSION <h1 style=color:red;>CART </h1>: $quantity <br><pre>";         
              echo "</pre> <br>";
                } elseif($action === 'decrement') {
                    $_SESSION['cart'][$key]['quantity'] -= 1;
                    $_SESSION['cart'][$key]['total_price'] -= $total_price;
                 
                    // If quantity is less than or equal to 0, remove the item from the cart
                    if($_SESSION['cart'][$key]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
                // Redirect back to cart page after updating quantity
                header("Location: cart_en.php");
                exit();
            }
        }
    }
}

// If the form submission is invalid or the item is not found, redirect back to cart page
//header("Location: cart.php");
exit();
?>
