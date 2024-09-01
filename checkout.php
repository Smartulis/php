<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css"> <!-- Add your CSS file here -->
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
        // Start the session (if not already started)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Link to profiliukas.php if user is logged in
            echo '<a href="profiliukas.php">';
        } else {
            // Link to profilis.php if user is not logged in
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
    <h1>Užsakymas</h1>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect to login if not logged in
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "svetaine";

    // Create a new connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form data is posted (from isiustas.php)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $address = htmlspecialchars($_POST['address']); // Sanitize the input

        // Retrieve cart items
        $cartItems = array(); // Initialize an array to store cart items

        // Fetch items from the cart and process the order
        $totalPrice = 0;
        $sql = "SELECT p.id, p.name, p.price, c.quantity FROM cart c 
                JOIN product p ON c.product_id = p.id 
                WHERE c.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalPrice += $row["price"] * $row["quantity"];
                
                // Create an item array and add it to the cart items array
                $item = array(
                    "product_id" => $row["id"],
                    "quantity" => $row["quantity"]
                );
                $cartItems[] = $item;
            }

            // Serialize cart items
            $serializedCartItems = serialize($cartItems);

            // Insert order into 'orders' table with user_id and total_price
            $sqlInsertOrder = "INSERT INTO orders (user_id, billing_address, total_price) VALUES (?, ?, ?)";
            $stmtInsertOrder = $conn->prepare($sqlInsertOrder);

            $stmtInsertOrder->bind_param("isd", $user_id, $address, $totalPrice);
            if ($stmtInsertOrder->execute()) {
                // Get the last inserted order ID
                $order_id = $stmtInsertOrder->insert_id;

                // Insert order items into 'order_items' table
                foreach ($cartItems as $cartItem) {
                    $product_id = $cartItem['product_id'];
                    $quantity = $cartItem['quantity'];

                    // Insert order item into 'order_items' table
                    $sqlInsertOrderItem = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
                    $stmtInsertOrderItem = $conn->prepare($sqlInsertOrderItem);

                    $stmtInsertOrderItem->bind_param("iii", $order_id, $product_id, $quantity);
                    $stmtInsertOrderItem->execute();

                    $stmtInsertOrderItem->close();
                }

                // Assuming successful checkout
                echo "<p>Jūsų užsakymas gautas. Visa kaina: €" . $totalPrice . "</p>";

                // Clear cart after checkout
                $sqlClearCart = "DELETE FROM cart WHERE user_id = ?";
                $stmtClearCart = $conn->prepare($sqlClearCart);
                $stmtClearCart->bind_param("i", $user_id);
                $stmtClearCart->execute();
            } else {
                echo "<p>Order insertion failed.</p>";
            }

            $stmtInsertOrder->close();
        } else {
            echo "<p>Jūsų krepšelis tuščias.</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <a href="parduotuve.php" class="shop-button">Tęsti apsipirkimą</a>
</div>

<div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
</div>

</body>
</html>
