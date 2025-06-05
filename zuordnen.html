<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LinguaFlow – Zuordnen 2 zu 2</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #2A5C82;
      --secondary: #38A3A5;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f7fa;
      padding-bottom: 50px; /* Platz für Footer */
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

    .content {
      margin-left: 220px;
      margin-top: 56px;
      padding: 30px;
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
        margin-left: 0;
        padding: 20px;
      }
    }

    .navbar-toggler {
      border: none;
      background: transparent;
    }

    .navbar-toggler:focus {
      box-shadow: none;
    }

    /* Deine Zuordnen 2 zu 2 Styles */
    .bereich {
      display: flex;
      gap: 30px;
      margin: 30px 0;
    }

    .box {
      padding: 14px;
      background: #2563eb;
      color: #fff;
      border-radius: 8px;
      cursor: pointer;
      text-align: center;
      min-width: 120px;
      user-select: none;
      transition: background-color 0.3s ease;
    }

    .box:hover {
      background: #1d4ed8;
    }

    .selected {
      background: #f59e0b !important;
    }

    #feedback {
      margin-top: 20px;
      font-weight: bold;
    }

    /* Footer Styles */
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100vw;
      background-color: white;
      border-top: 1px solid #ccc;
      font-size: 0.85rem;
      z-index: 9999;
      text-align: center;
      padding: 8px 0;
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

  <!-- Main Content -->
  <div class="content">

    <h1>🔗 Zuordnen: 2 zu 2</h1>

    <div class="bereich" id="deutsch"></div>
    <div class="bereich" id="englisch"></div>

    <div id="feedback"></div>

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
    // Sidebar Toggle Logik
    document.addEventListener("DOMContentLoaded", function () {
      const toggleBtn = document.getElementById("sidebarToggle");
      const sidebar = document.getElementById("sidebar");

      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("show");
      });
    });

    // Vokabelpaare
    const paare = [
      { deutsch: "Hund", englisch: "Dog" },
      { deutsch: "Katze", englisch: "Cat" }
    ];

    let ausgewaehltDeutsch = null;
    let geloeste = 0;

    /**
     * Zeigt die deutschen und englischen Wörter an.
     */
    function anzeigen() {
      // Deutsche Wörter
      const deutschDiv = document.getElementById("deutsch");
      deutschDiv.innerHTML = "";

      paare.forEach((paar, i) => {
        let btn = document.createElement("div");
        btn.className = "box";
        btn.innerText = paar.deutsch;
        btn.onclick = () => deutschWaehlen(i, btn);
        deutschDiv.appendChild(btn);
      });

      // Englische Wörter (zufällig mischen)
      const englischDiv = document.getElementById("englisch");
      englischDiv.innerHTML = "";

      let englischWoerter = paare.map(p => p.englisch);
      englischWoerter.sort(() => Math.random() - 0.5);

      englischWoerter.forEach(wort => {
        let btn = document.createElement("div");
        btn.className = "box";
        btn.innerText = wort;
        btn.onclick = () => englischWaehlen(wort, btn);
        englischDiv.appendChild(btn);
      });
    }

    /**
     * Auswahl eines deutschen Wortes
     * @param {number} index - Index des Wortes
     * @param {HTMLElement} button - Button Element
     */
    function deutschWaehlen(index, button) {
      // Vorherige Auswahl zurücksetzen
      let alle = document.querySelectorAll("#deutsch .box");
      alle.forEach(b => b.classList.remove("selected"));

      // Neue Auswahl speichern und markieren
      ausgewaehltDeutsch = index;
      button.classList.add("selected");
    }

    /**
     * Auswahl eines englischen Wortes und Prüfung auf Korrektheit
     * @param {string} wort - Gewähltes englisches Wort
     * @param {HTMLElement} button - Button Element
     */
    function englischWaehlen(wort, button) {
      if (ausgewaehltDeutsch === null) {
        alert("Wähle zuerst ein deutsches Wort aus!");
        return;
      }

      let korrekt = paare[ausgewaehltDeutsch].englisch;

      if (wort === korrekt) {
        document.getElementById("feedback").innerText =
          `✅ Richtig: ${paare[ausgewaehltDeutsch].deutsch} = ${wort}`;
        geloeste++;

        // Entferne zugeordnete Wörter
        document.querySelectorAll("#deutsch .box")[ausgewaehltDeutsch].remove();
        button.remove();

        if (geloeste === paare.length) {
          document.getElementById("feedback").innerText = "🎉 Alles richtig!";
        }
      } else {
        document.getElementById("feedback").innerText =
          `❌ Falsch! ${paare[ausgewaehltDeutsch].deutsch} ist nicht ${wort}`;
      }

      // Auswahl zurücksetzen
      ausgewaehltDeutsch = null;
      document.querySelectorAll("#deutsch .box").forEach(b => b.classList.remove("selected"));
    }

    anzeigen();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
