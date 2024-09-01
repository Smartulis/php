<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paieškos rezultatai - Internetinė Parduotuvė</title>
    <link rel="stylesheet" href="parduotuve.css">
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

<div class="content">
    <div class="search-container">
        <form method="get" action="search_results.php">
            <input type="text" placeholder="Ieškoti prekės..." name="search_query">
            <button type="submit">Ieškoti</button>
        </form>
    </div>

    <!-- ... other content like category tabs ... -->

    <h2>Paieškos rezultatai</h2>

    <div class="container">
        <?php
       

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

        // Check if the search query is set
        if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
            $search_query = $_GET['search_query'];

            // Prepare a statement to avoid SQL injection
            $stmt = $conn->prepare("SELECT * FROM product WHERE name LIKE CONCAT('%', ?, '%')");
            $stmt->bind_param("s", $search_query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product-aoc'>";
                    echo "<img src='/Darbas/".$row['image']."' alt='".$row['name']."'>";
                    echo "<div class='product-details'>";
                    echo "<div class='description'>".$row['name']."</div>";
                    echo "<div class='price'>".$row['price']." €</div>";
            
                    // Add to Cart Form
                    echo "<form method='post' action='add_to_cart.php'>";
                    echo "<input type='hidden' name='product_id' value='".$row['id']."' />";
                    echo "<input type='number' name='quantity' value='1' min='1' max='10' step='1'/>";
                    echo "<input type='submit' value='Į krepšelį' />";
                    echo "</form>";
            
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nerasta prekių atitinkančių jūsų paieškos kriterijus.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Įveskite paieškos užklausą.</p>";
        }
        $conn->close();
        ?>
    </div>

</div>

<div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
</div>

</body>
</html>
