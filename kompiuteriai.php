<!DOCTYPE html>
<html lang="lt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internetinė Parduotuvė</title>
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
<div class="category-tabs">
  <ul>
    <li class="tab active"><a href="kompiuteriai.php">Kompiuteriai</a></li>
    <li class="tab"><a href="monitoriai.php">Monitoriai</a></li>
    <li class="tab"><a href="priedai.php">Priedai</a></li>
  </ul>
</div>

<h2>KOMPIUTERIAI</h2>

<div class="container">
  <div class="product">
    <img src="assets/acer.png" alt="acer">
    <div class="product-details">
      <div class="description">Nešiojamas Kompiuteris ACER ASPIRE 3</div>
      <div class="price">1 199,99 €</div>
      <form method="post" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="20" />
        <input type="number" name="quantity" value="1" min="1" max="10" step="1"/>
        <input type="submit" value="Į krepšelį" />
      </form>
    </div>
  </div>

<div class="product">
  <img src="assets/macbook.png" alt="macbook">
  <div class="product-details">
    <div class="description">APPLE MACBOOK AIR 13.3 M1</div>
    <div class="price">1 399,99 €</div>
    <form method="post" action="add_to_cart.php">
      <input type="hidden" name="product_id" value="17" />
      <input type="number" name="quantity" value="1" min="1" max="10" step="1"/>
      <input type="submit" value="Į krepšelį" />
    </form>
  </div>
</div>

  
  
  
  </body>
  </html>