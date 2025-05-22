<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinguaFlow – Dein Sprachcoach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2A5C82;
            --secondary: #38A3A5;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f5f7fa;
        }

        .sidebar {
            height: 100vh;
            width: 220px;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            position: fixed;
            top: 56px; /* Höhe der Topbar */
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
        <a href="login.php" class="btn btn-outline-primary">Anmelden</a>
        <a href="auth.php?mode=register" class="btn btn-outline-primary">Jetzt registrieren</a>
        <a href="profile.php" class="nav-link">👤 Profil</a>

    </div>
</div>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column" id="sidebar">
    <nav class="nav flex-column">
        <a href="index.php" class="nav-link">🏠 Start</a>
        <a href="learn.php" class="nav-link">📖 Lernen</a>
        <a href="progress.php" class="nav-link">📊 Fortschritt</a>
        <a href="community.php" class="nav-link">💬 Mitteilungen</a>
    </nav>
</div>

<!-- Main Content Start -->
<div class="content">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("sidebar");
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("show");
        });
    });
</script>
