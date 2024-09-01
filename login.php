<?php
session_start();

// Database connection (assuming PDO)
$db = new PDO('mysql:host=localhost;dbname=svetaine', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Checking if the user exists in the database
    $stmt = $db->prepare("SELECT id, firstName, lastName, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && $password === $user['password']) {
        // Password is correct, store user info in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['email'] = $user['email'];

        // Redirect to the profile page
        header('Location: profiliukas.php');
        exit;
    } else {
        // Invalid credentials
        header('Location: neteisingas.php');
        exit;
    }
}
?>