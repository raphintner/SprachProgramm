<?php
include 'header.php';
?>

<style>
/* Kompakteres Layout für den Content-Bereich */
.lern-content {
    margin-left: 320px; /* Platz für Sidebar, ggf. anpassen */
    margin-top: 48px;
    margin-right: 40px;
    margin-bottom: 0;
    min-height: calc(100vh - 120px); /* Platz für Footer */
}

.lern-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #fff;
}

.lern-content p {
    font-size: 1.15rem;
    color: #cbd5e1;
    margin-bottom: 18px;
    max-width: 700px;
}

.sprache-auswahl {
    margin-bottom: 22px;
}

.sprache-auswahl label {
    font-weight: 600;
    color: #fff;
    margin-right: 8px;
}

.sprache-auswahl select {
    background: #18191d;
    color: #fff;
    border: 1px solid #444;
    border-radius: 8px;
    padding: 6px 16px;
    font-size: 1rem;
}

.modi-container {
    display: flex;
    flex-wrap: wrap;
    gap: 22px;
    margin-top: 0;
}

.modus-card {
    background: #18191d;
    border-radius: 12px;
    padding: 22px 18px 18px 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.10);
    flex: 1 1 260px;
    max-width: 320px;
    min-width: 220px;
    margin: 0;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.modus-card h3 {
    margin-top: 0;
    margin-bottom: 8px;
    font-size: 1.18rem;
    font-weight: 700;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 7px;
}

.modus-card p {
    font-size: 1rem;
    color: #cbd5e1;
    margin-bottom: 14px;
}

.modus-card button {
    margin-top: auto;
    padding: 10px 0;
    font-size: 1rem;
    border-radius: 8px;
    border: none;
    background-color: #2563eb;
    color: #fff;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.2s;
}

.modus-card button:hover {
    background-color: #1d4ed8;
}

@media (max-width: 1100px) {
    .lern-content {
        margin-left: 0;
        margin-right: 0;
        padding: 20px;
    }
    .modi-container {
        flex-direction: column;
        gap: 18px;
    }
}
</style>

<div class="lern-content">
    <h1>Willkommen bei LinguaFlow</h1>
    <p>
        Starte dein Sprachtraining mit verschiedenen Übungsmodi. Wähle zwischen Zuordnen, Multiple-Choice oder dem klassischen Selbst Schreiben. Jeder Modus hilft dir auf eine andere Art, deine Vokabelkenntnisse zu verbessern.
    </p>

    <div class="sprache-auswahl">
        <label for="sprache_global"><strong>Sprache wählen:</strong></label>
        <select id="sprache_global">
            <option value="englisch">Englisch</option>
            <option value="spanisch">Spanisch</option>
        </select>
    </div>

    <div class="modi-container">
        <div class="modus-card">
            <h3>📝 Selbst schreiben</h3>
            <p>Gib die richtige Übersetzung zu einer Vokabel ein und verbessere dein aktives Sprachwissen.</p>
            <button onclick="trainingStarten('Selbst schreiben')">Starten</button>
        </div>
        <div class="modus-card">
            <h3>🔗 Zuordnen</h3>
            <p>Ordne die richtige Übersetzung einer Vokabel aus mehreren Antwortmöglichkeiten zu.</p>
            <button onclick="trainingStarten('Zuordnen')">Starten</button>
        </div>
        <div class="modus-card">
            <h3>❓ Multiple Choice</h3>
            <p>Wähle aus vier Antwortmöglichkeiten die richtige Übersetzung zur angezeigten Vokabel.</p>
            <button onclick="trainingStarten('Multiple Choice')">Starten</button>
        </div>
    </div>
</div>

<script>
function trainingStarten(modus) {
    let sprache = document.getElementById("sprache_global").value;
    alert("Modus: " + modus + "\nSprache: " + sprache + "\n→ Hier würde dein Training starten.");
}
</script>

<?php
include 'footer.php';
?>
