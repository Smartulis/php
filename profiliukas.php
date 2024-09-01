<!DOCTYPE html>
<html lang="lt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internetinė Parduotuvė</title>
<link rel="stylesheet" href="profiliukas.css">
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
        <a href="profilis.php">
            <img src="assets/profilis.png" alt="User">
        </a>
        <a href="krepselis.php">
            <img src="assets/cart.png" alt="Cart">
        </a>
    </div>
</nav>

  
  <div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
  </div>

  <?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: profilis.php'); // Redirect to login page
    exit;
}

// User is logged in, display their information and logout button in a styled div
echo '<div class="user-info">';
echo "<h1>Sveiki, " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h1>";
echo "<p>Email: " . $_SESSION['email'] . "</p>";

// Logout Button
echo '<form action="logout.php" method="post">';
echo '<button type="submit">Atsijungti</button>';
echo '</form>';

echo '</div>';
?>

  </body>
  </html>
