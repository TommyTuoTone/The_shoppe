<?php
session_start();
$servername = "********";
$username = "********";
$password = "********";
$dbname = "The_Shoppe";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");

header('Location: ../shoppe');
$conn->close();
?>

