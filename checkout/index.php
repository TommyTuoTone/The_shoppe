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
$total = $_SESSION['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shoppe-Checkout</title>
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">
    <link rel="icon" type="image/x-icon" href="../assets/images/bag.ico">
</head>
<body>
    <div class="video-background">
        <video autoplay loop muted playsinline>
            <source src="../assets/images/cloudsg.mp4" type="video/mp4" title="Clouds">
        </video>
        <div class="container" title="The Shoppe">
            <h1>The Shoppe</h1>
            <hr>
            <div>
                <form action="../php/checkout.php" method="post">
                    <?php 
                    if (isset($_SESSION['username'])) {
                        echo "<h2>Total = $$total</h2>";
                    } else { // to login screen if not session user is passed
                        header("Location: ../login");
                        exit;
                    }
                    ?>
                    <hr>
                    <fieldset>
                        <legend>Payment Information</legend>
                        <label for="card-number">Credit Card Number:</label><br><input type="text" id="card-number" name="card-number" required><br><br>
                        <label for="expiry">Expiration Date (MM/YY):</label><br><input type="text" id="expiry" name="expiry" required><br><br>
                        <label for="cvv">CVV:</label><br><input type="text" id="cvv" name="cvv" required><br><br>
                        <input type="submit" value="Pay">
                    </fieldset>
                </form>
                <a href="../dashboard" target="_self"><button class="button3">Dashboard</button></a>
                <a href="../shoppe" target="_self"><button class="button3">Shoppe!</button></a>
            </div>
        </div>
    </div>
    <footer>
        <img src="../assets/images/bag.png" alt="First Image" class="logo" id="logo-image" title="click me?">
        <img src="../assets/images/bag1.png" alt="Logo" class="logo" style="display:none;" id="nice-image" title="Nice!">
        <div class="social-media">
            <a href="https:instagram.com" target="_blank"><img src="../assets/images/instagramg.png" alt="Instagram" title="Instagram"></a>
            <a href="https://x.com/" target="_blank"><img src="../assets/images/twitterg.png" alt="Twitter" title="Twitter/x"></a>
            <a href="https:facebook.com" target="_blank"><img src="../assets/images/facebookg.png" alt="Github" title="facebook"></a>
            <a href="https://www.youtube.com/" target="_blank"><img src="../assets/images/youtubeg.png" alt="Youtube" title="Youtube"></a>
        </div>
        <p>© 2024 The Shoppe &#128540</p>
    </footer>
    <!--<script src="../assets/js/background.js"></script>-->
</body>
</html>