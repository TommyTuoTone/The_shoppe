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

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id AS cart_id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shoppe-Cart</title>
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">
    <link rel="icon" type="image/x-icon" href="../assets/images/bag.ico">
</head>
<body>
    <div class="video-background">
        <video autoplay loop muted playsinline>
            <source src="../assets/images/cloudsg.mp4" type="video/mp4" title="Clouds">
        </video>
        <div class="container" title="The Shoppe">
            <h1>The Shoppe - Current Cart</h1>
            <hr>
            <div class="grocery-row">
            <?php
            if (isset($_SESSION['username'])) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p class ='checkout-item'>" . $row['name'] . " - $" . number_format($row['price'], 2) . " x " . $row['quantity'] . "</p>";
                        echo "<a href='../php/remove.php?cart_id=" . $row['cart_id'] . "'><button class='remove-btn'>Remove All!</button></a>";
                        $total += $row['price'] * $row['quantity'];
                        $_SESSION['total'] = $total;
                    }
                    echo "<hr class='hr2'><br>";
                    echo "<p class='checkout-item1'>Total = $" . number_format($total, 2) . "</p>";
                    echo "<br><br>";
                    echo '<a href="../checkout" target="_self"><button class="button4">Check Out!</button></a>'; 
                } else {
                    echo "<p>Your cart is empty.<p>";
                }
            } else {
                header("Location: ../login");
                exit;
            }
                ?>
            </div>
            <hr class="hr2">
            <div class="button-container">
                <?php
                echo "<br>";
                echo '<a href="../dashboard" target="_self"><button class="button3">Dashboard</button></a>';
                echo "<br>";
                echo '<a href="../shoppe" target="_self"><button class="button3">Shoppe!</button></a>';
                echo "<br>";
                echo '<a href="../php/logout.php" target="_self"><button class="button3">Sign Out</button></a>';
                ?>
            </div>
        </div>
    </div>
    <footer>
        <img src="../assets/images/bag.png" alt="First Image" class="logo" id="logo-image" title="click me?">
        <img src="../assets/images/bag1.png" alt="Logo" class="logo" style="display:none;" id="nice-image" title="Nice!">
        <div class="social-media">
            <a href="https://instagram.com" target="_blank"><img src="../assets/images/instagramg.png" alt="Instagram" title="Instagram"></a>
            <a href="https://x.com/" target="_blank"><img src="../assets/images/twitterg.png" alt="Twitter/x" title="Twitter/x"></a>
            <a href="https://facebook.com" target="_blank"><img src="../assets/images/facebookg.png" alt="Facebook" title="Facebook"></a>
            <a href="https://www.youtube.com/" target="_blank"><img src="../assets/images/youtubeg.png" alt="YouTube" title="YouTube"></a>
        </div>
        <p>© 2024 The Shoppe &#128540</p>
    </footer>
    <!--<script src="../assets/js/background.js"></script>-->
</body>
</html>
<?php
$conn->close();
?>
