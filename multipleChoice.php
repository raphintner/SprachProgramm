<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?error=Bitte zuerst anmelden.");
    exit();
}
include 'header.php';

// Datenbankverbindung
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'linguaflow_db';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$vokabeln = [];
$sql = "SELECT word AS englisch, translation AS deutsch FROM vocab WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $vokabeln[] = $row;
}
$stmt->close();
$conn->close();
?>

<div class="content">
    <h1>❓ Multiple Choice</h1>
    <div class="vokabel" id="vokabel"></div>
    <div id="optionen"></div>
    <div id="feedback"></div>
</div>

<script>
    // Die Vokabeln kommen jetzt aus PHP/MySQL:
    const vokabeln = <?php echo json_encode($vokabeln); ?>;

    let index = 0;

    function anzeigen() {
      if (vokabeln.length === 0) {
        document.querySelector(".content").innerHTML = 
          "<h1>Keine Vokabeln gefunden!</h1><p>Bitte lege zuerst eigene Vokabeln an.</p>";
        return;
      }
      if (index >= vokabeln.length) {
        document.querySelector(".content").innerHTML = 
          "<h1>🎉 Training abgeschlossen!</h1>";
        return;
      }

      document.getElementById("vokabel").innerText = vokabeln[index].englisch;

      let optionen = [vokabeln[index].deutsch];
      // Falsche Antworten generieren
      while (optionen.length < 4 && vokabeln.length > 1) {
        let random = vokabeln[Math.floor(Math.random() * vokabeln.length)].deutsch;
        if (!optionen.includes(random)) optionen.push(random);
      }
      // Wenn weniger als 4 Vokabeln vorhanden sind, weniger Optionen anzeigen
      optionen = optionen.slice(0, Math.min(4, optionen.length));
      optionen.sort(() => Math.random() - 0.5);

      const optionenDiv = document.getElementById("optionen");
      optionenDiv.innerHTML = "";

      optionen.forEach(opt => {
        let btn = document.createElement("div");
        btn.className = "option";
        btn.innerText = opt;
        btn.onclick = () => pruefen(opt, btn);
        optionenDiv.appendChild(btn);
      });

      document.getElementById("feedback").innerText = "";
      document.getElementById("feedback").className = "";
    }

    function pruefen(antwort, btn) {
      const alleOptionen = document.querySelectorAll(".option");
      alleOptionen.forEach(opt => opt.classList.remove("selected"));
      btn.classList.add("selected");

      const feedback = document.getElementById("feedback");
      if (antwort === vokabeln[index].deutsch) {
        feedback.textContent = "✅ Richtig!";
        feedback.className = "richtig";
      } else {
        feedback.textContent = `❌ Falsch! Richtig: ${vokabeln[index].deutsch}`;
        feedback.className = "falsch";
      }
      index++;
      setTimeout(anzeigen, 1100);
    }

    anzeigen();
</script>

<?php include 'footer.php'; ?>
