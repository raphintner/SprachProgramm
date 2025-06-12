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

// Nur 7 Paare laden!
$sql = "SELECT word AS deutsch, translation AS englisch FROM vocab ORDER BY RAND() LIMIT 7";
$result = $conn->query($sql);

$paare = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $paare[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Zuordnen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #2A5C82;
      --secondary: #38A3A5;
      --highlight: #f59e0b;
      --correct: #27ae60;
      --wrong: #c0392b;
    }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
      margin: 0;
      min-height: 100vh;
      padding-bottom: 50px;
    }
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
    .zuordnen-content {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
      border-radius: 24px;
      padding: 40px 30px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      width: 95%;
      max-width: 600px;
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
      font-size: 1.8rem;
      margin-bottom: 18px;
      font-weight: 700;
    }
    .zuordnen-lists {
      display: flex;
      gap: 25px;
      justify-content: center;
      margin-bottom: 18px;
      flex-wrap: wrap;
    }
    .zuordnen-list {
      flex: 1 1 180px;
      min-width: 140px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .zuordnen-list h2 {
      color: #2980b9;
      font-size: 1.1rem;
      margin-bottom: 7px;
      font-weight: 600;
      letter-spacing: 0.5px;
      user-select: none;
    }
    .zuordnen-box {
      background: rgba(236, 245, 251, 0.85);
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(42, 92, 130, 0.06);
      padding: 13px 10px;
      font-size: 1.08rem;
      font-weight: 500;
      color: #2A5C82;
      cursor: pointer;
      border: 2px solid transparent;
      transition: background 0.2s, color 0.2s, border 0.2s, transform 0.1s;
      user-select: none;
    }
    .zuordnen-box:hover:not(.zuordnen-disabled) {
      background: linear-gradient(90deg, #74ebd5 40%, #ACB6E5 100%);
      color: #2c3e50;
      border-color: #38A3A5;
      transform: scale(1.04);
    }
    .zuordnen-selected {
      background: linear-gradient(90deg, #38A3A5 60%, #74ebd5 100%) !important;
      color: white !important;
      border-color: #f59e0b !important;
      box-shadow: 0 4px 16px #f59e0b33;
      transform: scale(1.06);
    }
    .zuordnen-disabled {
      background: #ecf0f1 !important;
      color: #aaa !important;
      border-color: #eee !important;
      cursor: default !important;
      pointer-events: none !important;
      filter: grayscale(70%) blur(1px);
      box-shadow: none !important;
    }
    #feedback {
      min-height: 32px;
      font-size: 1.1rem;
      font-weight: 500;
      margin: 12px 0;
      transition: color 0.2s;
    }
    .richtig {
      color: #27ae60;
    }
    .falsch {
      color: #c0392b;
    }
    .zuordnen-btn {
      padding: 12px 24px;
      margin: 8px 5px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(90deg, #3498db, #6dd5fa);
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
      font-size: 1rem;
    }
    .zuordnen-btn:hover {
      background: linear-gradient(90deg, #2980b9, #3498db);
      transform: translateY(-2px);
    }
    .zuordnen-btn.secondary {
      background: #ecf0f1;
      color: #2c3e50;
    }
    .zuordnen-counter {
      position: absolute;
      top: 20px;
      right: 26px;
      font-size: 0.95rem;
      color: #555;
      opacity: 0.75;
    }
    @media (max-width: 600px) {
      .zuordnen-content {
        padding: 18px 7px;
      }
      .zuordnen-lists {
        flex-direction: column;
        gap: 10px;
      }
    }
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
  <div class="zuordnen-content">
    <div class="zuordnen-counter" id="zuordnen-counter"></div>
    <h1>Zuordnen</h1>
    <div class="zuordnen-lists">
      <div class="zuordnen-list" id="deutsch-list">
        <h2>Deutsch</h2>
      </div>
      <div class="zuordnen-list" id="englisch-list">
        <h2>Englisch</h2>
      </div>
    </div>
    <div id="feedback"></div>
    <button class="zuordnen-btn" onclick="resetZuordnen()">🔄 Neu mischen</button>
    <button class="zuordnen-btn secondary" onclick="window.location.href='index.php'">⬅️ Zurück</button>
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

const paare = <?php echo json_encode($paare); ?>;
let geloest = 0;
let ausgewaehltDeutsch = null;
let deutschOrder = [];
let englischOrder = [];

function mischen(array) {
    return array
        .map(value => ({ value, sort: Math.random() }))
        .sort((a, b) => a.sort - b.sort)
        .map(({ value }) => value);
}

function resetZuordnen() {
    geloest = 0;
    ausgewaehltDeutsch = null;
    deutschOrder = mischen([...Array(paare.length).keys()]);
    englischOrder = mischen([...Array(paare.length).keys()]);
    renderZuordnen();
}

function renderZuordnen() {
    const deutschDiv = document.getElementById("deutsch-list");
    const englischDiv = document.getElementById("englisch-list");
    const feedback = document.getElementById("feedback");
    feedback.textContent = "";
    feedback.className = "";
    document.getElementById("zuordnen-counter").textContent = `Noch ${paare.length - geloest} Paare`;

    deutschDiv.querySelectorAll(".zuordnen-box").forEach(el => el.remove());
    englischDiv.querySelectorAll(".zuordnen-box").forEach(el => el.remove());

    deutschOrder.forEach((i) => {
        const btn = document.createElement("div");
        btn.className = "zuordnen-box";
        btn.textContent = paare[i].deutsch;
        btn.dataset.index = i;
        btn.onclick = () => deutschWaehlen(i, btn);
        deutschDiv.appendChild(btn);
    });

    englischOrder.forEach((i) => {
        const btn = document.createElement("div");
        btn.className = "zuordnen-box";
        btn.textContent = paare[i].englisch;
        btn.dataset.index = i;
        btn.onclick = () => englischWaehlen(i, btn);
        englischDiv.appendChild(btn);
    });
}

function deutschWaehlen(index, btn) {
    if (btn.classList.contains("zuordnen-disabled")) return;
    document.querySelectorAll("#deutsch-list .zuordnen-box").forEach(b => {
        if (!b.classList.contains("zuordnen-disabled")) b.classList.remove("zuordnen-selected");
    });
    ausgewaehltDeutsch = index;
    btn.classList.add("zuordnen-selected");
    document.getElementById("feedback").textContent = "";
    document.getElementById("feedback").className = "";
}

function englischWaehlen(index, btn) {
    if (btn.classList.contains("zuordnen-disabled")) return;
    const feedback = document.getElementById("feedback");
    if (ausgewaehltDeutsch === null) {
        feedback.textContent = "Bitte zuerst ein deutsches Wort auswählen!";
        feedback.className = "falsch";
        return;
    }
    if (index === ausgewaehltDeutsch) {
        feedback.textContent = `✔️ Richtig: ${paare[index].deutsch} = ${paare[index].englisch}`;
        feedback.className = "richtig";
        document.querySelectorAll("#deutsch-list .zuordnen-box")[deutschOrder.indexOf(index)].classList.add("zuordnen-disabled");
        document.querySelectorAll("#deutsch-list .zuordnen-box")[deutschOrder.indexOf(index)].classList.remove("zuordnen-selected");
        document.querySelectorAll("#englisch-list .zuordnen-box")[englischOrder.indexOf(index)].classList.add("zuordnen-disabled");
        geloest++;
        if (geloest === paare.length) {
            feedback.textContent = "🎉 Super! Du hast alle Paare richtig zugeordnet!";
        }
    } else {
        feedback.textContent = `❌ Falsch! Das passt nicht zusammen.`;
        feedback.className = "falsch";
    }
    ausgewaehltDeutsch = null;
    document.querySelectorAll("#deutsch-list .zuordnen-box").forEach(b => {
        if (!b.classList.contains("zuordnen-disabled")) b.classList.remove("zuordnen-selected");
    });
    document.getElementById("zuordnen-counter").textContent = `Noch ${paare.length - geloest} Paare`;
}

resetZuordnen();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
