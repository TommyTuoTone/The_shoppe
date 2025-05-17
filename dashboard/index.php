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
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shoppe-Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
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
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<h2>" . $_SESSION['role'] . " Dashboard" . "!<br> " . "</h2>";
                    echo "<hr class=\"hr2\">";
                    echo "<h2>Welcome " . $_SESSION['username'] . "</h2>";
                    echo "<hr class=\"hr2\">";

                    if ($_SESSION['role'] == 'admin') {
                        echo '<a href="../add_item" target="_self"><button class="button">Add items</button></a>';
                        echo "<br>"; 
                    }
                    echo '<a href="../shoppe" target="_self"><button class="button">Shoppe!</button></a>';
                    echo "<br>";
                    echo '<a href="../cart" target="_self"><button class="button">View Cart</button></a>';
                    echo "<br>";
                    echo '<a href="../php/logout.php" target="_self"><button class="button">Sign Out</button></a>';
                  } else { // to login screen if not session user is passed
                    header("Location: ../login");
                    exit;
                }
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
