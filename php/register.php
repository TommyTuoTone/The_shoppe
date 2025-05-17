<?php
//https://www.w3schools.com/php/php_sessions.asp
session_start();
$servername = "localhost";
$username = "********";
$password = "********";
$dbname = "The_Shoppe";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST["username"];
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ($password !== $confirm_password) {
    echo "Passwords do not match. Please try again.";
    echo "<br>";
    echo '<a href="../register" target="_self"><button class="button">register</button></a>';
    echo "<br>";
    echo '<a href="../" target="_self"><button class="button">Landing Page!</button></a>';
    exit;
}

$role = 'Customer';

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = mysqli_prepare($conn, "INSERT INTO USERS (username, name, email, phone, passhash, salt, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

$salt = '';
mysqli_stmt_bind_param($stmt, "sssssss", $username, $fullname, $email, $phone, $hashed_password, $salt, $role);

if (mysqli_stmt_execute($stmt)) {
    //https://www.w3schools.com/php/php_sessions.asp
    $user_id = mysqli_insert_id($conn);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['user_id'] = $user_id;
    header('Location: ../dashboard');
}

mysqli_close($conn);
?>
