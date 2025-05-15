<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

// Fehler aus der URL holen (falls vorhanden)
$error = $_GET['error'] ?? '';
$mode = $_GET['mode'] ?? 'login';
?>

<?php include 'header.php'; ?>

<div class="container" style="max-width: 500px; margin-top: 60px;">

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link <?= $mode === 'login' ? 'active' : '' ?>" href="?mode=login">Anmelden</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $mode === 'register' ? 'active' : '' ?>" href="?mode=register">Registrieren</a>
        </li>
    </ul>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($mode === 'register'): ?>
        <h2>Registrieren</h2>
        <form action="register_submit.php" method="post">
            <div class="mb-3">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" required class="form-control">
                <div class="form-text">Mindestens 6 Zeichen</div>
            </div>
            <button type="submit" class="btn btn-success">Registrieren</button>
        </form>
    <?php else: ?>
        <h2>Anmelden</h2>
        <form action="login_submit.php" method="post">
            <div class="mb-3">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Jetzt anmelden</button>
        </form>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>
