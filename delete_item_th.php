<?php
session_start();
include 'backend/conndb.php';

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if(isset($_POST['indexes'])) {
            $indexes = $_POST['indexes'];
            if($key === $indexes) {
                // อัปเดตปริมาณสินค้าในฐานข้อมูล
             /*   $sql = "UPDATE `ramyeons` SET `ramyeon_quantity` = `quantity` + '{$item['quantity']}' WHERE `bingsu_id` = '{$item['bingsu_id']}'";
                $result = $conn->query($sql);*/
                
                if($result) {
                    // ลบรายการออกจาก session cart
                    unset($_SESSION['cart'][$key]);
                    // ลิ้งค์กลับไปยังหน้าตะกร้าสินค้า
                    header("Location: cart_th.php");
                    exit();
                } else {
                    // กรณีเกิดข้อผิดพลาดในการ query
                    echo "มีข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
                }
            }
        }
    }
}
?>
