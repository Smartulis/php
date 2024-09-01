<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "svetaine";

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get product_id to be removed from the form
    $product_id = $_POST['product_id'];

    // Remove the product from the cart for the specific user
    $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);

    if ($stmt->execute()) {
        // Product removed successfully
        header("Location: krepselis.php"); // Redirect back to the cart page
        exit();
    } else {
        echo "Error removing product: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
