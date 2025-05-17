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

$sql = "SELECT id, name, description, price, weight, image_url FROM products ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shoppe-Shoppe</title>
    <link rel="stylesheet" href="../assets/css/shoppe.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">
    <link rel="icon" type="image/x-icon" href="../assets/images/bag.ico">
</head>
<body>
    <div class="video-background">
        <video autoplay loop muted playsinline>
            <source src="../assets/images/cloudsg.mp4" type="video/mp4" title="Clouds">
        </video>
        <div class="container" title="The Shoppe">
            <h1>The Shoppe - Current Stock</h1>
            <hr>
            <div class="grocery-row">
                <?php
                if (isset($_SESSION['username'])) {
                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $weight = $row['weight'];
                            $image_url = '../' . $row['image_url'];

                            if ($counter % 4 == 0 && $counter != 0) {
                                echo '</div><div class="grocery-row">';
                            }
                            
                ?>
                    <div class="grocery-item">
                        <p><?php echo $name; ?></p>
                        <img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>" class="grocery" title="<?php echo $name; ?>">
                        <p>$<?php echo number_format($price, 2); ?>/<?php echo $weight; ?> LBs</p>
                        <button class="button2" onclick="window.location.href='../php/buy.php?id=<?php echo $row['id']; ?>'" title="Buy">Buy</button>
                    </div>
                <?php
                        $counter++;
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
            } else { // to login screen if not session user is passed
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
                echo '<a href="../cart" target="_self"><button class="button3">ViewCart</button></a>';
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