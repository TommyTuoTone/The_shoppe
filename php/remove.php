<?php
session_start();
$servername = "localhost";
$username = "********";
$password = "********";
$dbname = "The_Shoppe";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cart_id = $_GET['cart_id'];

$conn->query("DELETE FROM cart WHERE id = $cart_id");

header("Location: ../cart");
$conn->close();
?>
