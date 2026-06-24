<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.html");
    exit();
}

echo "<h1>Witaj, " . htmlspecialchars($_SESSION['first_name']) . "!</h1>";
echo "<p>To jest Twój panel użytkownika.</p>";
echo '<a href="logout.php">Wyloguj się</a>';
?>
