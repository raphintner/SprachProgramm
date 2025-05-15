<?php // header.php ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinguaFlow - Dein Sprachcoach</title>
    <style>
        :root {
            --primary-color: #2A5C82;
            --secondary-color: #38A3A5;
        }

        body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f5f7fa;
}

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            padding: 20px;
            color: white;
            position: fixed;
            height: 100%;
            width: 250px;
        }

        .logo {
            font-size: 1.8em;
            margin-bottom: 40px;
            font-weight: bold;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            transition: 0.3s;
        }

        nav a:hover {
            background: rgba(255,255,255,0.1);
        }

        .auth-buttons {
            position: absolute;
            bottom: 20px;
            width: 210px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
        }
        .sidebar {
    background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
    padding: 30px 20px;
    color: white;
    height: 100vh;
    width: 250px;
    position: fixed;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.logo {
    font-size: 2em;
    font-weight: bold;
    margin-bottom: 40px;
    text-align: center;
}

nav a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    text-decoration: none;
    padding: 12px;
    margin: 10px 0;
    border-radius: 10px;
    transition: 0.3s;
    font-size: 1.05em;
}

nav a:hover {
    background: rgba(255,255,255,0.2);
}

.auth-buttons a {
    display: block;
    text-align: center;
    margin: 10px 0;
}


.main-content {
    padding: 40px;
    margin-left: 250px; /* Platz für Sidebar */
    background: #f5f7fa;
}


    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">LinguaFlow</div>
        <nav>
        <a href="index.php">🏠 Start</a>
        <a href="learn.php">📖 Lernen</a>
        <a href="progress.php">📊 Fortschritt</a>
        <a href="community.php">💬 Community</a>
        <a href="profile.php">👤 Profil</a>
        </nav>
        <div class="auth-buttons">
            <a href="login.php" style="background: white; color: var(--primary-color); padding: 10px 20px; border-radius: 25px;">Anmelden</a>
        </div>
    </div>
