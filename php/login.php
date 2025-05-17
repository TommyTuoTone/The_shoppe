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
$password = $_POST["password"];

$stmt = mysqli_prepare($conn, "SELECT * FROM USERS WHERE username=?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_hash = $row["passhash"];
    $role = $row["role"];
    $user_id = $row["id"];

    if (password_verify($password, $stored_hash)) {
        //https://www.w3schools.com/php/php_sessions.asp
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['user_id'] = $user_id;
        header('Location: ../dashboard/');
        exit;
    } else {
        echo "wrong password/username";
        echo "<br>";
        echo '<a href="../login/" target="_self"><button class="button">Login!</button></a>';
        echo "<br>";
        echo '<a href="../" target="_self"><button class="button">Landing Pange!</button></a>';
        exit;
    }
} else {
    echo "no user found for: $username";
    echo "<br>";
    echo '<a href="../login/" target="_self"><button class="button">Login!</button></a>';
    echo "<br>";
    echo '<a href="../" target="_self"><button class="button">Landing Pange!</button></a>';
    exit;
}
mysqli_close($conn);
?>