<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?error=Bitte zuerst anmelden.");
    exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'linguaflow_db';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Alle Nutzer erhalten dieselben Vokabeln
$sql = "SELECT word AS frage, translation AS antwort FROM vocab";
$result = $conn->query($sql);

$vokabeln = [];
while ($row = $result->fetch_assoc()) {
    $vokabeln[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Selbst Schreiben</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #2A5C82;
      --secondary: #38A3A5;
    }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
      margin: 0;
      min-height: 100vh;
      padding-bottom: 50px; /* für Footer */
    }

    /* Topbar */
    .topbar {
      background-color: white;
      height: 56px;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1040;
    }
    .topbar .brand {
      font-weight: bold;
      color: var(--primary);
      font-size: 1.4rem;
      text-decoration: none;
    }
    .topbar .auth {
      font-size: 1rem;
    }
    .navbar-toggler {
      border: none;
      background: transparent;
    }
    .navbar-toggler:focus {
      box-shadow: none;
    }

    /* Sidebar */
    .sidebar {
      height: 100vh;
      width: 220px;
      background: linear-gradient(180deg, var(--primary), var(--secondary));
      position: fixed;
      top: 56px;
      left: 0;
      padding-top: 20px;
      z-index: 1030;
    }
    .sidebar .nav-link {
      color: white;
      font-size: 1.1rem;
      padding: 10px 20px;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .content {
        margin-left: 0 !important;
      }
    }

    /* Hauptinhalt */
    .content {
      margin-left: 220px;
      margin-top: 56px;
      padding: 30px 0;
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @media (max-width: 768px) {
      .content {
        padding: 20px 0;
      }
    }

    /* Lernbox */
    .lern-content {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
      border-radius: 24px;
      padding: 40px 30px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 460px;
      text-align: center;
      position: relative;
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to   { opacity: 1; transform: scale(1); }
    }
    h1 {
      color: #2c3e50;
      font-size: 1.9rem;
      margin-bottom: 20px;
    }
    #vokabel {
      font-size: 2.2rem;
      color: #2980b9;
      font-weight: 600;
      margin-bottom: 14px;
      transition: all 0.3s;
    }
    .counter {
      position: absolute;
      top: 20px;
      right: 26px;
      font-size: 0.9rem;
      color: #555;
      opacity: 0.75;
    }
    input[type="text"] {
      width: 85%;
      padding: 12px;
      font-size: 1.1rem;
      border: 1.5px solid #ccc;
      border-radius: 8px;
      margin-bottom: 16px;
      transition: border-color 0.2s;
    }
    input[type="text"]:focus {
      border-color: #3498db;
      outline: none;
    }
    button {
      padding: 12px 24px;
      margin: 8px 5px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(90deg, #3498db, #6dd5fa);
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s ease-in-out, transform 0.1s;
    }
    button:hover {
      background: linear-gradient(90deg, #2980b9, #3498db);
      transform: translateY(-2px);
    }
    button.secondary {
      background: #ecf0f1;
      color: #2c3e50;
    }
    #feedback {
      min-height: 32px;
      font-size: 1.1rem;
      font-weight: 500;
      margin: 12px 0;
    }
    .richtig {
      color: #27ae60;
    }
    .falsch {
      color: #c0392b;
    }
    @media (max-width: 600px) {
      #vokabel {
        font-size: 1.6rem;
      }
    }

    /* Footer */
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100vw;
      background-color: white;
      border-top: 1px solid #ccc;
      font-size: 0.85rem;
      z-index: 9999;
    }
  </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <button class="navbar-toggler d-md-none" type="button" id="sidebarToggle">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="index.php" class="brand">LinguaFlow</a>
    <div class="auth">
        <a href="auth.php" class="btn btn-light rounded-circle shadow-sm" title="Profil" style="font-size: 1.2rem;">
            👤
        </a>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column" id="sidebar">
    <nav class="nav flex-column">
        <a href="index.php" class="nav-link">🏠 Start</a>
        <a href="overview.php" class="nav-link">📖 Lernen</a>
        <a href="dashboard.php" class="nav-link">📊 Fortschritt</a>
        <a href="community.php" class="nav-link">💬 Mitteilungen</a>
    </nav>
</div>

<!-- Hauptinhalt -->
<div class="content">
  <div class="lern-content">
    <div class="counter" id="counter"></div>
    <h1>Selbst Schreiben</h1>
    <div id="vokabel"></div>
    <input type="text" id="antwort" placeholder="Übersetzung eingeben" autocomplete="off" autofocus>
    <br>
    <button onclick="pruefen()">✔️ Prüfen</button>
    <button onclick="neueVokabel()">➡️ Nächste</button>
    <p id="feedback"></p>
    <button class="secondary" onclick="window.location.href='index.php'">⬅️ Zurück</button>
  </div>
</div>

<!-- Footer -->
<footer class="footer text-center">
    <div class="container py-2">
        <small>
            © 2025 LinguaFlow |
            <a href="impressum.php" class="text-decoration-none text-muted">Impressum</a> |
            <a href="datenschutz.php" class="text-decoration-none text-muted">Datenschutz</a> |
            <a href="logout.php" class="text-decoration-none text-muted">Logout</a> 
        </small>
    </div>
</footer>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const toggleBtn = document.getElementById("sidebarToggle");
      const sidebar = document.getElementById("sidebar");
      toggleBtn.addEventListener("click", () => {
          sidebar.classList.toggle("show");
      });
  });

  const vokabeln = <?php echo json_encode($vokabeln); ?>;
  let aktuelle = 0;

  function anzeigen() {
    if (vokabeln.length === 0) {
      document.getElementById("vokabel").textContent = "Keine Vokabeln gefunden!";
      document.getElementById("antwort").style.display = "none";
      document.getElementById("counter").textContent = "";
      return;
    }
    document.getElementById("vokabel").textContent = vokabeln[aktuelle].frage;
    document.getElementById("antwort").value = "";
    document.getElementById("feedback").textContent = "";
    document.getElementById("feedback").className = "";
    document.getElementById("antwort").style.display = "";
    document.getElementById("antwort").focus();
    document.getElementById("counter").textContent = `Vokabel ${aktuelle + 1} von ${vokabeln.length}`;
  }

  function pruefen() {
    const eingabe = document.getElementById("antwort").value.trim();
    const feedback = document.getElementById("feedback");
    feedback.className = "";

    if (eingabe.toLowerCase() === vokabeln[aktuelle].antwort.toLowerCase()) {
      feedback.textContent = "✔️ Richtig!";
      feedback.classList.add("richtig");
    } else {
      feedback.textContent = "❌ Falsch. Richtig: " + vokabeln[aktuelle].antwort;
      feedback.classList.add("falsch");
    }
  }

  function neueVokabel() {
    aktuelle = (aktuelle + 1) % vokabeln.length;
    anzeigen();
  }

  anzeigen();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
