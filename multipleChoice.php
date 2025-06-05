<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Multiple Choice – LinguaFlow</title>

  <!-- Bootstrap CSS aus deinem Header -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    :root {
      --primary: #2A5C82;
      --secondary: #38A3A5;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #f5f7fa;
      padding-bottom: 50px; /* Platz für Footer */
    }

    /* Topbar und Sidebar Styles aus Header */
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
      }
    }

    .navbar-toggler {
      border: none;
      background: transparent;
    }
    .navbar-toggler:focus {
      box-shadow: none;
    }

    /* Multiple Choice spezifische Styles */
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: var(--primary);
    }

    .vokabel {
      font-size: 28px;
      margin-bottom: 20px;
    }

    .option {
      padding: 12px;
      background: #2563eb;
      color: #fff;
      margin: 10px 0;
      cursor: pointer;
      border-radius: 8px;
      user-select: none;
      transition: background 0.3s;
    }

    .option:hover {
      background: #1d4ed8;
    }

    #feedback {
      margin-top: 20px;
      font-weight: bold;
      font-size: 1.1rem;
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
      z-index: 9999; /* über Sidebar & Topbar */
      text-align: center;
      padding: 10px 0;
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
      <a href="overview.php" class="nav-link active">📖 Lernen</a>
      <a href="dashboard.php" class="nav-link">📊 Fortschritt</a>
      <a href="community.php" class="nav-link">💬 Mitteilungen</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="content">
    <h1>❓ Multiple Choice</h1>
    <div class="vokabel" id="vokabel"></div>
    <div id="optionen"></div>
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
    document.addEventListener("DOMContentLoaded", function () {
      const toggleBtn = document.getElementById("sidebarToggle");
      const sidebar = document.getElementById("sidebar");
      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("show");
      });
    });

    const vokabeln = [
      { englisch: "Dog", deutsch: "Hund" },
      { englisch: "Cat", deutsch: "Katze" },
      { englisch: "House", deutsch: "Haus" },
      { englisch: "Apple", deutsch: "Apfel" }
    ];

    let index = 0;

    function anzeigen() {
      if (index >= vokabeln.length) {
        document.querySelector(".content").innerHTML = 
          "<h1>🎉 Training abgeschlossen!</h1>";
        return;
      }

      document.getElementById("vokabel").innerText = vokabeln[index].englisch;

      let optionen = [vokabeln[index].deutsch];
      while (optionen.length < 4) {
        let random = vokabeln[Math.floor(Math.random() * vokabeln.length)].deutsch;
        if (!optionen.includes(random)) optionen.push(random);
      }

      optionen.sort(() => Math.random() - 0.5);

      const optionenDiv = document.getElementById("optionen");
      optionenDiv.innerHTML = "";

      optionen.forEach(opt => {
        let btn = document.createElement("div");
        btn.className = "option";
        btn.innerText = opt;
        btn.onclick = () => pruefen(opt);
        optionenDiv.appendChild(btn);
      });

      document.getElementById("feedback").innerText = "";
    }

    function pruefen(antwort) {
      if (antwort === vokabeln[index].deutsch) {
        document.getElementById("feedback").innerText = "✅ Richtig!";
      } else {
        document.getElementById("feedback").innerText = 
          `❌ Falsch! Richtig: ${vokabeln[index].deutsch}`;
      }
      index++;
      setTimeout(anzeigen, 1000);
    }

    anzeigen();
  </script>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
