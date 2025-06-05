<?php
session_start();
include 'header.php';

// --- Beispielhafte Session-Daten (ersetzen durch echte User-Datenbank-Abfrage) ---
/* if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Falls nicht eingeloggt, weiterleiten auf Login-Seite
    header('Location: login.php');
    exit;
}

// Beispielwerte aus Session (ersetzen durch echte Werte)
$name = $_SESSION['name'] ?? 'Max Mustermann';
$username = $_SESSION['username'] ?? 'maxmuster';
$fortschritt = $_SESSION['progress'] ?? 57; // Prozent
$tage = $_SESSION['days'] ?? 14;
$wiederholungen = $_SESSION['reviews'] ?? 120;
$gelerntHeute = $_SESSION['learned_today'] ?? 12;*/
?>


<style>
.dashboard-content {
    margin-left: 320px;
    margin-top: 48px;
    margin-right: 40px;
    min-height: calc(100vh - 120px);
}
.dashboard-header {
    color: #fff;
    margin-bottom: 24px;
}
.user-info {
    background: #18191d;
    border-radius: 12px;
    padding: 24px 28px 18px 28px;
    margin-bottom: 32px;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 36px;
}
.user-info .avatar {
    background: linear-gradient(135deg, #2563eb 60%, #3b82f6 100%);
    border-radius: 50%;
    width: 68px;
    height: 68px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    font-weight: bold;
    color: #fff;
    margin-right: 20px;
}
.user-info-details {
    flex: 1;
}
.user-info-details h2 {
    margin: 0 0 6px 0;
    font-size: 1.5rem;
    font-weight: 700;
}
.user-info-details p {
    margin: 0;
    font-size: 1.1rem;
    color: #cbd5e1;
}
.progress-section {
    display: flex;
    gap: 22px;
    flex-wrap: wrap;
}
.progress-card {
    background: #18191d;
    border-radius: 10px;
    padding: 20px 24px;
    color: #fff;
    min-width: 220px;
    flex: 1 1 220px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.10);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.progress-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #60a5fa;
}
.progress-value {
    font-size: 2.1rem;
    font-weight: 700;
    margin-bottom: 6px;
}
.progress-bar-bg {
    background: #2d2f36;
    border-radius: 8px;
    width: 100%;
    height: 14px;
    margin-bottom: 6px;
    overflow: hidden;
}
.progress-bar-fg {
    background: linear-gradient(90deg, #2563eb 60%, #3b82f6 100%);
    height: 100%;
    border-radius: 8px;
    transition: width 0.4s;
}
@media (max-width: 1100px) {
    .dashboard-content {
        margin-left: 0;
        margin-right: 0;
        padding: 20px;
    }
    .progress-section {
        flex-direction: column;
        gap: 18px;
    }
    .user-info {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
}
</style>

<div class="dashboard-content">
    <div class="dashboard-header">
        <h1>👋 Hallo, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Willkommen zurück bei LinguaFlow. Hier findest du eine Übersicht über deinen Lernfortschritt und deine Aktivitäten.</p>
    </div>
    <div class="user-info">
        <div class="avatar">
            <?php echo strtoupper(substr($name, 0, 1)); ?>
        </div>
        <div class="user-info-details">
            <h2><?php echo htmlspecialchars($name); ?></h2>
            <p>@<?php echo htmlspecialchars($username); ?></p>
        </div>
    </div>
    <div class="progress-section">
        <div class="progress-card">
            <div class="progress-title">Lernfortschritt</div>
            <div class="progress-value"><?php echo $fortschritt; ?>%</div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fg" style="width: <?php echo min(100, max(0, $fortschritt)); ?>%;"></div>
            </div>
            <div style="font-size: 0.97rem; color: #cbd5e1;">Dein Gesamtfortschritt bei allen Übungen.</div>
        </div>
        <div class="progress-card">
            <div class="progress-title">Tage aktiv</div>
            <div class="progress-value"><?php echo $tage; ?></div>
            <div style="font-size: 0.97rem; color: #cbd5e1;">Lerntage in Folge</div>
        </div>
        <div class="progress-card">
            <div class="progress-title">Wiederholungen</div>
            <div class="progress-value"><?php echo $wiederholungen; ?></div>
            <div style="font-size: 0.97rem; color: #cbd5e1;">Vokabeln wiederholt</div>
        </div>
        <div class="progress-card">
            <div class="progress-title">Heute gelernt</div>
            <div class="progress-value"><?php echo $gelerntHeute; ?></div>
            <div style="font-size: 0.97rem; color: #cbd5e1;">Neue Vokabeln heute</div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
