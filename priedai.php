<!DOCTYPE html>
<html lang="lt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internetinė Parduotuvė</title>
<link rel="stylesheet" href="priedai.css">
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
<div class="category-tabs">
  <ul>
    <li class="tab active"><a href="kompiuteriai.php">Kompiuteriai</a></li>
    <li class="tab"><a href="monitoriai.php">Monitoriai</a></li>
    <li class="tab"><a href="priedai.php">Priedai</a></li>
  </ul>
</div>

<h2>PREKĖS</h2>

<div class="container">
  <div class="product-klaviatura">
    <img src="assets/klaviatura.png" alt="FURY Spitfire Keyboard">
    <div class="description">FURY Spitfire Keyboard</div>
    <div class="price">25.00 €</div>
    <form method="post" action="add_to_cart.php">
      <input type="hidden" name="product_id" value="18" />
      <input type="number" name="quantity" value="1" min="1" max="10" step="1"/>
      <input type="submit" value="Į krepšelį" />
    </form>
  </div>

  <div class="product-pele">
    <img src="assets/pele.png" alt="OMEGA Mouse OM-414">
    <div class="description">OMEGA Mouse OM-414</div>
    <div class="price">5.00 €</div>
    <form method="post" action="add_to_cart.php">
      <input type="hidden" name="product_id" value="16" />
      <input type="number" name="quantity" value="1" min="1" max="10" step="1"/>
      <input type="submit" value="Į krepšelį" />
    </form>
  </div>
  <!-- Repeat the structure for other products as needed -->
</div>
  
  <div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
  </div>
  
  </body>
  </html>