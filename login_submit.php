<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datenbankverbindung
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'linguaflow_db';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Formulardaten holen
$username_or_email = trim($_POST['username_or_email']);
$password = trim($_POST['password']);

// Nutzer anhand von Username oder E-Mail suchen
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username_or_email, $username_or_email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($user_id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Login erfolgreich
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: auth.php");
        exit();
    } else {
        // Passwort falsch
        header("Location: index.php?mode=login&error=Falsches Passwort");
        exit();
    }
} else {
    // Nutzer nicht gefunden
    header("Location: index.php?mode=login&error=Benutzer nicht gefunden");
    exit();
}
$stmt->close();
$conn->close();
?>
