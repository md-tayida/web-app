<?php 
session_start();
include 'backend/conndb.php';

//สร้าง payment_id
$payment_id = uniqid();
// Query to check if the payment_id already exists in the database
$query = "SELECT * FROM payments WHERE payment_id = '$payment_id'";
$check_result = mysqli_query($conn, $query);

// Check if the query returns any rows
if (mysqli_num_rows($check_result) > 0) {
    // If the payment_id already exists, generate a new one
    $payment_id = uniqid();
}

        // เก็บ payment_id ใน Session
        $_SESSION['payment_id'] = $payment_id;

        // แสดงข้อความยืนยัน
       

        if(isset($_POST['payment'])) {
            $_SESSION['payment'] = $_POST['payment']; 
        
        
        }

            
?>

<script>
        // กำหนดเวลาในหน่วยมิลลิวินาที (5 นาที)
        const countdownTime = 5 * 60 * 1000; // 5 นาที * 60 วินาที * 1000 มิลลิวินาที

        // เวลาเริ่มต้น
        const startTime = Date.now();

        // เริ่มนับถอยหลังเมื่อหน้าเว็บโหลดเสร็จสิ้น
        window.onload = function () {
            // เริ่มนับถอยหลัง
            setTimeout(function () {
                // เมื่อเวลานับถอยหลังเสร็จสิ้น ให้เปลี่ยนหน้าไปยังหน้าอื่น.html
                window.location.href = 'back_to_index_en.php';
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
            document.getElementById('timer').innerText = `Please pay within: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    </script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment EN</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .cancel-button {
    padding: 3px 10px;
    margin-right: 20px;
    border: 1.5px solid gainsboro;
    border-radius: 10px;
    font-size: 1.3vw;
    font-weight: bold;
    background-color: #c1280f;
    position: absolute;
    /* กำหนดตำแหน่งอยู่บนขอบหน้าจอ */
    top: 20px;
    /* ระยะห่างด้านบน */
    right: 20px;
    /* ระยะห่างด้านซ้าย */
}

.cancel-button a {
    color: white;
}

.timmer-des {
    display: flex;
    justify-content: center;
    text-align: center;
}

.timmer-des h2 {
    font-size: 1.3vw;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 50px 0;
    color: rgb(99, 99, 99);
}

.pay-by-QR {
    display: flex;
    justify-content: center;
}

.qr-forPay-contanier {
    background-color: #fff;
    padding: 20px 120px;
    justify-content: center;
    border-radius: 1rem;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 30%;
}

.qr-forPay h2 {
    font-size: 2vw;
    display: flex;
    justify-content: center;
    margin: 30px;
}

.qr-forPay {
    display: flex;
    justify-content: center;
}

.qr-forPay img {
    width: 20vw;
    height: auto;
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

        </style>
</head>

<body>

    <!-- cancel button -->
    <div class="cancel-button">
        <a href="back_to_index_en.php">CANCEL</a>
    </div>
    <div class="timmer-des">
        <h2 id="timer">Please pay within: 5.00</h2>
    </div>
    <div class="pay-by-QR">
    <?php  if(isset($_SESSION['payment']) && $_SESSION['payment'] === 'PromptPay') {
         // Print "a" if payment is by card
   ?>
        <div class="qr-forPay-contanier">
        <div class="title-inSum">
            <span class='back-menu'>
                        <a href="select_payment_en.php" ><i class="bi bi-chevron-left"></i></a>
                              
           
               </span> 
            </div>
            <div class="qr-forPay">
            
                <h2>Scan to Pay</h2>
            </div>
            <div class="qr-forPay">
                <img src="img/PromptPay.PNG">
            </div>
            <br>
            <div class="back-and-addToBag">
               
            <form action="confirmed_payment_en.php" method="post">
    <button class="paymentConfirm" type="submit" name="confirmed_payment"><span class="text">Confirm Payment</span></button>
</form>
            </div>
        </div>
        <?php  } elseif(isset($_SESSION['payment']) && $_SESSION['payment'] === 'Card') {
        // Print "a" if payment is by card
    ?>
     <div class="qr-forPay-contanier">
     <div class="title-inSum">
            <span class='back-menu'>
                        <a href="select_payment_en.php" ><i class="bi bi-chevron-left"></i></a>
                              
           
               </span> 
            </div>
            <div class="qr-forPay">
                <h2>Tap Your Card to Pay</h2>
            </div>
            <div class="qr-forPay">
                <img src="img/payment gateway.png">
            </div>
            <div class="back-and-addToBag">
               
               
                <form action="confirmed_payment_en.php" method="post">
    <button class="paymentConfirm" type="submit" name="confirmed_payment">
        <span class="text">Confirm Payment</span></button>
</form>

            </div>
        </div> <?php } ?>
    </div>

</body>

</html>