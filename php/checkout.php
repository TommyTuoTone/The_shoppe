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

$card_number = mysqli_real_escape_string($conn, $_POST['card-number']);
$expiry_date = mysqli_real_escape_string($conn, $_POST['expiry']);
$cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
$customer_id = $_SESSION['user_id'];
$total = $_SESSION['total'];

$expiry_parts = explode('/', $expiry_date);
$expiry_date = '20' . $expiry_parts[1] . '-' . $expiry_parts[0] . '-01';

$sql = "INSERT INTO checkout (customer_id, total, card_number, expiry_date, cvv) 
        VALUES ('$customer_id', '$total', '$card_number', '$expiry_date', '$cvv')";

if (mysqli_query($conn, $sql)) {
    echo "Payment data inserted successfully.<br>";

    $delete_sql = "DELETE FROM cart WHERE user_id = '$customer_id'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "Cart cleared successfully.<br>";
    } else {
        echo "Error deleting cart items: " . mysqli_error($conn) . "<br>";
    }

    header("Location: ../thank_you");
    exit();
} else {
  header("Location: ../checkout");
}

mysqli_close($conn);
?>
