<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="krepselis.css"> <!-- Add your CSS file here -->
</head>
<body>

<nav class="navbar">
    <ul class="nav-links">
        <a href="pagrindinis.php" class="nav-link">Pagrindinis</a>
        <a href="parduotuve.php" class="nav-link">Parduotuvė</a>
        <a href="apiemus.php" class="nav-link">Apie Mus</a>
        <a href="kontaktai.php" class="nav-link">Kontaktai</a>
    </ul>
    <div>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            echo '<a href="profiliukas.php">';
        } else {
            echo '<a href="profilis.php">';
        }
        ?>
        <img src="assets/profilis.png" alt="User">
        </a>
        <a href="krepselis.php">
            <img src="assets/cart.png" alt="Cart">
        </a>
    </div>
</nav>

<div class="krepselis">
    <h1>Jūsų Krepšelis</h1>

    <div class="cart-items">
        <?php
        $user_id = $_SESSION['user_id'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "svetaine";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $totalPrice = 0;

        $sql = "SELECT p.id, p.name, p.price, c.quantity FROM cart c 
                JOIN product p ON c.product_id = p.id 
                WHERE c.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $productPrice = $row["price"] * $row["quantity"];
                $totalPrice += $productPrice;
                echo '<div class="cart-item">';
                echo '<div class="cart-item-details">';
                echo '<div class="cart-item-description">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>Vieneto kaina: ' . $row["price"] . ' €</p>';
                echo '<p>Kiekis: ' . $row["quantity"] . '</p>';
                echo '<p>Visa kaina: ' . $productPrice . ' €</p>';
                echo '</div>';
                echo '<form method="post" action="remove_from_cart.php">';
                echo '<input type="hidden" name="product_id" value="' . $row["id"] . '"/>';
                echo '<input type="submit" value="Panaikinti" class="shop-button" />';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            header("Location: krepseliss.php");
            exit();
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <div class="cart-total">
        <p>Visa užsakymo kaina: <?php echo $totalPrice; ?> €</p>
    </div>

    <a href="isiustas.php" class="shop-button">Apmokėjimas</a>
</div>


</body>
</html>
