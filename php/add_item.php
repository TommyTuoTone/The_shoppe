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

$name = $_POST['name'];
$description = $_POST['description'];
$price = (float)$_POST['price'];
$stock_quantity = (int)$_POST['stock_quantity'];
$weight = (float)$_POST['weight'];
$tags = $_POST['tags'];
$image_url = '';

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // you will need to change the below paths, also I tweaked apache/php to have the temp storage the path below.
    $target_file = "/var/www/class/my_final/assets/images/" . basename($_FILES["image"]["name"]);
    $image_url = "assets/images/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
} elseif (!empty($_POST['image_url'])) {
    $image_url = $_POST['image_url'];
}

$stmt = mysqli_prepare($conn, "INSERT INTO products (name, description, price, stock_quantity, weight, tags, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssdidss", $name, $description, $price, $stock_quantity, $weight, $tags, $image_url);

header('Location: ../dashboard');
mysqli_close($conn);
?>
