<?php 
session_start();
session_destroy();
header("Location: index_th.php");
exit();
?>