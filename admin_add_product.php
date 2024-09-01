<!DOCTYPE html>
<html>
<head>
    <title>Prekės pridėjimas</title>
</head>
<body>
    <h2>Pridėti naują prekę į duomenų bazę</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Prekės pavadinimas:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="price">Prekės kaina:</label>
        <input type="number" step="0.01" name="price" id="price" required>
        <br>
        <label for="image">Prekės nuotrauka:</label>
        <input type="file" name="image" id="image">
        <br>
        <input type="submit" value="Pridėti">
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include database connection settings
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

        // Get product data from form
        $productName = isset($_POST['name']) ? $_POST['name'] : '';
        $productPrice = isset($_POST['price']) ? $_POST['price'] : '';
        $productImage = isset($_FILES['image']) ? $_FILES['image'] : '';

        // Validate and sanitize inputs
        $productName = htmlspecialchars(strip_tags($productName));
        $productPrice = floatval($productPrice);

        // Process the image upload
$uploadDir = 'assets/'; // Directory for the uploaded images
$imagePath = "";
if ($productImage && $productImage['error'] == 0) {
    $imageFileName = basename($productImage["name"]);
    $imagePath = $uploadDir . $imageFileName;
    if (!move_uploaded_file($productImage["tmp_name"], __DIR__ . '/' . $imagePath)) {
        echo "Error: Could not upload the image.";
        $imagePath = ""; // Reset image path if upload failed
    }
}


        // Check if inputs are empty
        if (empty($productName) || $productPrice <= 0) {
            echo "Error: Please fill in all fields with valid data.";
        } else {
            // Prepare SQL query
            $sql = "INSERT INTO product (name, price, image) VALUES (?, ?, ?)";

            // Prepare and bind
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                echo "Error: " . $conn->error;
            } else {
                $stmt->bind_param("sds", $productName, $productPrice, $imagePath);

                // Execute the query
                if ($stmt->execute()) {
                    echo "Prekė pridėta sėkmingai!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
