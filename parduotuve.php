<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internetinė Parduotuvė</title>
    <link rel="stylesheet" href="parduotuvecopycopy.css">
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
            echo '<a href="profiliukas.php"><img src="assets/profilis.png" alt="User"></a>';
        } else {
            echo '<a href="profilis.php"><img src="assets/profilis.png" alt="User"></a>';
        }
        ?>
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

    <div class="category-tabs">
        <ul>
            <li class="tab active"><a href="kompiuteriai.php">Kompiuteriai</a></li>
            <li class="tab"><a href="monitoriai.php">Monitoriai</a></li>
            <li class="tab"><a href="priedai.php">Priedai</a></li>
        </ul>
    </div>

    <h2>PREKĖS</h2>

    <div class="sort-container">
        <a href="parduotuve.php?sort_order=asc">Kaina didėjimo tvarka</a> |
        <a href="parduotuve.php?sort_order=desc">Kaina mažėjimo tvarka</a>
    </div>

    <div class="container">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "svetaine";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Determine sort order
        $sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc' ? 'DESC' : 'ASC';

        // Fetch products
        $sql = "SELECT id, name, price, image FROM product ORDER BY price $sortOrder";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="/Darbas/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '<div class="product-details">';
                echo '<div class="description">' . htmlspecialchars($row['name']) . '</div>';
                echo '<div class="price">' . htmlspecialchars($row['price']) . ' €</div>';
                echo '<form method="post" action="add_to_cart.php">';
                echo '<input type="hidden" name="product_id" value="' . intval($row['id']) . '" />';
                echo '<input type="number" name="quantity" value="1" min="1" max="10" step="1"/>';
                echo '<input type="submit" value="Į krepšelį" />';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        $conn->close();
        ?>
    </div>
</div>


</body>
</html>
