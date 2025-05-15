<?php
session_start();

// Beispiel: Falls der Benutzer eingeloggt ist, leite weiter
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}
?>
