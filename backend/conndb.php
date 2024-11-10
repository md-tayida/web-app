<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbName = "db_ramyeon";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
$db_select = mysqli_select_db($conn, "db_ramyeon");

// Return name of current default database
if ($result = mysqli_query($conn, "SELECT DATABASE()")) {
  $row = mysqli_fetch_row($result);
  mysqli_free_result($result);
}

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>