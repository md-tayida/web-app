<?php 
session_start();
include 'backend/conndb.php';

//สร้าง payment_id

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select payments EN</title>
    <link rel="stylesheet" href="f-style.css">
    <!-- cnd -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #c1280f;
        }
    </style>
</head>

<body>
    <header class="top-location">
        <div class="back-to-start">
            <a href="cart_en.php"><i class="bi bi-chevron-left"></i></a>
        </div>
       
    </header>
    <div class="header-location">
        
    Choose Payment Method
    </div>
    <div class="btn-toolbar-location" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
        <form action="payment_en.php" method="post">
    <button type="submit" name="payment" value="Card" class="btn btn-secondary-location"> <img src="img/payment.png">
                    <h4>Pay by Card</h4></button>
    <button type="submit"name="payment" value="PromptPay" class="btn btn-secondary-location"> <img src="img/qr-code.png">
                    <h4>Pay by PromptPay</h4></button>
</form>
        </div>
    </div>
</body>

</html>

