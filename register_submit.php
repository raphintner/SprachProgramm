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
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validierung
if (strlen($password) < 6) {
    header("Location: index.php?mode=register&error=Passwort muss mindestens 6 Zeichen lang sein");
    exit();
}

// Prüfen ob Nutzername oder E-Mail bereits existiert
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    header("Location: index.php?mode=register&error=Benutzername oder E-Mail ist bereits vergeben");
    exit();
}
$stmt->close();

// Passwort hashen
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Benutzer speichern
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    // Registrierung erfolgreich, automatische Anmeldung möglich:
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    header("Location: auth.php");
} else {
    header("Location: index.php?mode=register&error=Fehler bei der Registrierung");
}

$stmt->close();
$conn->close();
