<?php
session_start();

// Simuliere Validierung
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Platzhalterprüfungen
if (strlen($password) < 6) {
    header("Location: auth.php?mode=register&error=Passwort muss mindestens 6 Zeichen lang sein");
    exit();
}

// Beispiel: Benutzer existiert schon
if ($username === "admin") {
    header("Location: auth.php?mode=register&error=Benutzername bereits vergeben");
    exit();
}

// Später: In Datenbank speichern und einloggen
$_SESSION['user_id'] = 123;
$_SESSION['username'] = $username;

header("Location: profile.php");
exit();
