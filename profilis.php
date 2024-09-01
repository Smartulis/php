<!DOCTYPE html>
<html lang="lt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internetinė Parduotuvė</title>
<link rel="stylesheet" href="profilis.css">
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

    <div class="form-container">
        <div class="form-box">
            <h2>Susikurkite paskyrą</h2>
            <form class="registration-form" action="register.php" method="post">
                <label for="first-name">Vardas :</label>
                <input type="text" name="firstName" placeholder="Įveskite vardą" required>

                <label for="last-name">Pavardė :</label>
                <input type="text"  name="lastName" placeholder="Įveskite pavardę" required>

                <label for="email">El. paštas :</label>
                <input type="email" name="email" placeholder="el.paštas@example.com" required>

                <label for="password">Slaptažodis :</label>
                <input type="password" name="password" placeholder="xxxxxxxx" required>

                <button type="submit">Registruotis</button>
            </form>
        </div>

        <div class="form-box">
            <h2>Prisijunkite</h2>
            <form class="login-form" action="login.php" method="post">
                <label for="login-email">El. paštas :</label>
                <input type="email" name="email" placeholder="info@example.com" required>
        
                <label for="login-password">Slaptažodis :</label>
                <input type="password" name="password" placeholder="Įveskite slaptažodį" required>
        
                <button type="submit">Prisijungti</button>
            </form>
        </div>
        
</div>

  <div class="footer">
    <p>© 2024 Internetinė Parduotuvė</p>
  </div>
    
  </body>
  </html>