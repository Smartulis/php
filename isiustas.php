<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Confirmation</title>
    <link rel="stylesheet" href="isiustas.css"> <!-- Reusing the same CSS file -->
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
    <h1>Pristatymo adresas</h1>

    <?php
    // PHP code for session and form handling
    ?>

    <form method="post" action="checkout.php" class="address-form">
        <div class="address-section">
            
            <input type="text" id="address" name="address" required>
            <!-- Additional address fields if needed -->
        </div>

        <input type="submit" value="Patvirtinti" class="shop-button" style="margin-top:5%;">
    </form>
</div>

<div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
</div>

</body>
</html>
