<?php
session_start();

// Prüfen, ob der Nutzer eingeloggt ist
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?error=Bitte zuerst anmelden.");
    exit();
}

// Datenbankverbindung
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'linguaflow_db';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$vokabeln = [];
$sql = "SELECT word AS frage, translation AS antwort FROM vocab WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $vokabeln[] = $row;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Selbst Schreiben</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }

    .lern-content {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
    }

    button {
      padding: 12px 20px;
      margin: 10px 5px;
      border: none;
      background-color: #4CAF50;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="text"] {
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 80%;
    }
  </style>
</head>
<body>

<div class="lern-content">
  <h1>Selbst Schreiben</h1>
  <div id="vokabel"></div>
  <input type="text" id="antwort" placeholder="Übersetzung eingeben">
  <br>
  <button onclick="pruefen()">Prüfen</button>
  <p id="feedback"></p>
  <button onclick="neueVokabel()">Nächste Vokabel</button>
  <br><br>
  <button onclick="window.location.href='index.php'">Zurück</button>
</div>

<script>
const vokabeln = <?php echo json_encode($vokabeln); ?>;

let aktuelle = 0;

function anzeigen() {
  if(vokabeln.length === 0) {
    document.getElementById("vokabel").textContent = "Keine Vokabeln gefunden!";
    document.getElementById("antwort").style.display = "none";
    document.getElementById("feedback").textContent = "";
    return;
  }
  document.getElementById("vokabel").textContent = vokabeln[aktuelle].frage;
  document.getElementById("antwort").value = "";
  document.getElementById("feedback").textContent = "";
}

function pruefen() {
  const eingabe = document.getElementById("antwort").value;
  if (eingabe.toLowerCase() === vokabeln[aktuelle].antwort.toLowerCase()) {
    document.getElementById("feedback").textContent = "Richtig!";
  } else {
    document.getElementById("feedback").textContent =
      "Falsch. Richtig: " + vokabeln[aktuelle].antwort;
  }
}

function neueVokabel() {
  aktuelle = (aktuelle + 1) % vokabeln.length;
  anzeigen();
}

// Beim Laden direkt anzeigen:
anzeigen();
</script>

</body>
</html>
