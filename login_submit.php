<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Platzhalter: Benutzername + Passwort check
if ($username !== "admin" || $password !== "geheim123") {
    header("Location: auth.php?mode=login&error=Ungültige Zugangsdaten");
    exit();
}

// Erfolgreich
$_SESSION['user_id'] = 123;
$_SESSION['username'] = $username;

header("Location: profile.php");
exit();
