<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fastfood_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($surname) || empty($email) || empty($message)) {
        echo "Wszystkie pola są wymagane!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Niepoprawny format adresu e-mail!";
        exit;
    }


    $sql = "INSERT INTO users (name, surname, email, message)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Błąd przygotowania zapytania: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sssss", $name, $surname, $email, $message);

    if ($stmt->execute()) {
        echo "Rejestracja zakończona sukcesem!";
    } else {
        echo "Błąd podczas rejestracji: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
