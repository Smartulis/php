<?php
session_start();

// Check if user is logged in. If not, redirect to neteisingas.php
if (!isset($_SESSION['user_id'])) {
    header("Location: neteising.php");
    exit();
}

// User is logged in, proceed with the script
$user_id = $_SESSION['user_id'];
error_log("User ID: " . $user_id); // Log the user_id for debugging purposes

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "svetaine";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve product ID and quantity from the POST request
$product_id = $_POST['product_id'];
$new_quantity = $_POST['quantity'];

// Check if the product is already in the cart
$sql = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Product is already in the cart, update the quantity
    $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
} else {
    // Product is not in the cart, insert a new entry
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $product_id, $new_quantity);
}

$stmt->execute();
$stmt->close();
$conn->close();

// Redirect back to the shopping cart page
header("Location: krepselis.php");
exit();
?>
