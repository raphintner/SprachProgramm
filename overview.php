<?php include 'header.php'; ?>

<style>
/* Overview Layout */
.lern-content {
  max-width: 900px;
  margin: 60px auto 40px auto; /* zentriert und Abstand oben/unten */
  padding: 20px 30px;
  background: #1e293b; /* dunkles Blau-Grau */
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  color: #f1f5f9; /* helles Grau/Weiß für Text */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.5;
}

/* Hauptüberschrift */
.lern-content h1 {
  font-size: 2.8rem;
  font-weight: 800;
  margin-bottom: 20px;
  color: #60a5fa; /* sanftes Hellblau */
  text-align: center;
  text-shadow: 0 0 4px #2563eb;
}

/* Einleitungstext */
.lern-content p {
  font-size: 1.15rem;
  color: #cbd5e1;
  max-width: 700px;
  margin: 0 auto 30px auto;
  text-align: center;
  font-weight: 500;
}

/* Sprach-Auswahl */
.sprache-auswahl {
  text-align: center;
  margin-bottom: 40px;
}

.sprache-auswahl label {
  font-weight: 700;
  font-size: 1.1rem;
  color: #93c5fd;
  margin-right: 12px;
}

.sprache-auswahl select {
  background: #334155;
  color: #f1f5f9;
  border: none;
  border-radius: 10px;
  padding: 10px 18px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s;
}

.sprache-auswahl select:hover {
  background: #475569;
}

/* Container für die Modi-Karten */
.modi-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 28px;
}

/* Einzelne Modus-Karte */
.modus-card {
  background: #334155;
  border-radius: 16px;
  padding: 28px 24px 24px 24px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
  color: #f1f5f9;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  cursor: pointer;
}

.modus-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 28px rgba(37, 99, 235, 0.6);
}

/* Titel der Modus-Karte */
.modus-card h3 {
  margin-top: 0;
  margin-bottom: 16px;
  font-size: 1.35rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  gap: 12px;
  color: #93c5fd;
}

/* Beschreibung in der Modus-Karte */
.modus-card p {
  font-size: 1rem;
  line-height: 1.4;
  color: #cbd5e1;
  flex-grow: 1;
}

/* Button in der Modus-Karte */
.modus-card button {
  margin-top: 24px;
  padding: 14px 0;
  font-size: 1.15rem;
  border-radius: 14px;
  border: none;
  background-color: #2563eb;
  color: #f1f5f9;
  font-weight: 700;
  cursor: pointer;
  transition: background-color 0.3s ease;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.5);
}

.modus-card button:hover {
  background-color: #1e40af;
}

/* Responsive Anpassungen */
@media (max-width: 600px) {
  .lern-content {
    margin: 40px 15px 30px 15px;
    padding: 20px;
  }

  .modi-container {
    grid-template-columns: 1fr;
    gap: 20px;
  }
}

</style>

<div class="lern-content">
  <h1>Willkommen bei LinguaFlow</h1>
  <p>
    Starte dein Sprachtraining mit verschiedenen Übungsmodi.
    Wähle zwischen Zuordnen, Multiple-Choice oder dem klassischen Selbst Schreiben.
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
      <button onclick="seiteWechseln('selbstSchreiben.html')">Starten</button>
    </div>

    <div class="modus-card">
      <h3>🔗 Zuordnen</h3>
      <p>Ordne die richtige Übersetzung einer Vokabel aus mehreren Antwortmöglichkeiten zu.</p>
      <button onclick="seiteWechseln('zuordnen.html')">Starten</button>
    </div>

    <div class="modus-card">
      <h3>❓ Multiple Choice</h3>
      <p>Wähle aus vier Antwortmöglichkeiten die richtige Übersetzung zur angezeigten Vokabel.</p>
      <button onclick="seiteWechseln('multipleChoice.html')">Starten</button>
    </div>
  </div>
</div>

<script>
function seiteWechseln(seite) {
  let sprache = document.getElementById("sprache_global").value;

  // Sprache per Query-Parameter an die nächste Seite übergeben
  window.location.href = seite + "?sprache=" + sprache;
}
</script>

<?php include 'footer.php'; ?>
