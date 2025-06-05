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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    .lern-content {
      max-width: 420px;
      margin: 60px auto 0 auto;
      background: #fff;
      padding: 36px 32px 28px 32px;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.10), 0 1.5px 4px rgba(0,0,0,0.04);
      text-align: center;
      transition: box-shadow 0.2s;
    }
    .lern-content:hover {
      box-shadow: 0 12px 40px rgba(0,0,0,0.18), 0 2px 8px rgba(0,0,0,0.09);
    }

    h1 {
      color: #2e4a62;
      margin-bottom: 22px;
      letter-spacing: 0.5px;
    }

    #vokabel {
      font-size: 2.2rem;
      color: #3a7bd5;
      margin-bottom: 20px;
      font-weight: 600;
      letter-spacing: 1px;
      min-height: 38px;
    }

    input[type="text"] {
      padding: 12px;
      margin: 12px 0 18px 0;
      border: 1.5px solid #b3c6e0;
      border-radius: 8px;
      width: 85%;
      font-size: 1.1rem;
      transition: border 0.2s, box-shadow 0.2s;
      outline: none;
    }
    input[type="text"]:focus {
      border: 1.5px solid #3a7bd5;
      box-shadow: 0 0 0 2px #e0eafc;
    }

    button {
      padding: 13px 28px;
      margin: 10px 7px;
      border: none;
      background: linear-gradient(90deg, #3a7bd5 0%, #00d2ff 100%);
      color: white;
      border-radius: 10px;
      cursor: pointer;
      font-size: 1.08rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(58,123,213,0.08);
      transition: background 0.2s, transform 0.12s;
    }
    button:hover, button:focus {
      background: linear-gradient(90deg, #005bea 0%, #3a7bd5 100%);
      transform: translateY(-2px) scale(1.03);
    }

    #feedback {
      min-height: 28px;
      margin: 12px 0 8px 0;
      font-size: 1.14rem;
      font-weight: 500;
      letter-spacing: 0.3px;
      transition: color 0.2s;
    }
    .richtig {
      color: #27ae60;
      background: #eafaf1;
      border-radius: 6px;
      padding: 4px 10px;
      display: inline-block;
    }
    .falsch {
      color: #d63031;
      background: #fdeaea;
      border-radius: 6px;
      padding: 4px 10px;
      display: inline-block;
    }

    @media (max-width: 600px) {
      .lern-content {
        max-width: 98vw;
        padding: 18px 6vw 18px 6vw;
        margin-top: 18px;
      }
      #vokabel {
        font-size: 1.4rem;
      }
      button {
        font-size: 1rem;
        padding: 12px 16px;
      }
    }
  </style>
</head>
<body>

<div class="lern-content">
  <h1>Selbst Schreiben</h1>
  <div id="vokabel"></div>
  <input type="text" id="antwort" placeholder="Übersetzung eingeben" autocomplete="off" autofocus>
  <br>
  <button onclick="pruefen()">Prüfen</button>
  <p id="feedback"></p>
  <button onclick="neueVokabel()">Nächste Vokabel</button>
  <br><br>
  <button onclick="window.location.href='index.php'" style="background: #b3c6e0; color: #2e4a62;">Zurück</button>
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
  document.getElementById("antwort").style.display = "";
  document.getElementById("antwort").focus();
}

function pruefen() {
  const eingabe = document.getElementById("antwort").value.trim();
  const feedback = document.getElementById("feedback");
  if (eingabe.toLowerCase() === vokabeln[aktuelle].antwort.toLowerCase()) {
    feedback.textContent = "Richtig!";
    feedback.className = "richtig";
  } else {
    feedback.textContent = "Falsch. Richtig: " + vokabeln[aktuelle].antwort;
    feedback.className = "falsch";
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
