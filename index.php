<?php // index.php ?>
<?php include 'header.php'; ?>


<div class="main-content">
    <h1 style="font-size: 2em; color: var(--primary-color);">Willkommen bei LinguaFlow</h1>

    <p style="font-size: 1.2em; max-width: 800px; margin-bottom: 30px;">
        Dein smarter Sprachcoach – lerne Englisch-Vokabeln effizient mit KI-gestützten Übungen, personalisierten Wiederholungen und abwechslungsreichen Lernmodi.
        Bald verfügbar: Mehr Sprachen, individueller Fortschritt & ein interaktiver KI-Tutor!
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; max-width: 1000px;">
        <!-- Lernmodi -->
        <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color);">📚 Lernmodi</h3>
            <p>Wähle zwischen Blitzkarten, Lückentexten, Multiple-Choice oder Hörverstehen – je nachdem, wie du am besten lernst.</p>
        </div>

        <!-- KI Coach -->
        <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color);">🤖 KI-Coach (bald verfügbar)</h3>
            <p>Erhalte Erklärungen, Tipps und Vokabelhilfe von deinem persönlichen Sprachcoach auf KI-Basis.</p>
        </div>

        <!-- Fortschrittsanzeige -->
        <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <h3 style="color: var(--primary-color);">📈 Fortschritt tracken</h3>
            <p>Verfolge deine täglichen Erfolge, Wiederholungen und Lerntage in deinem persönlichen Dashboard.</p>
        </div>
    </div>

    <!-- Registrierung -->
    <div style="margin-top: 50px;">
        <h2 style="color: var(--secondary-color);">Jetzt kostenlos registrieren</h2>
        <form action="register.php" method="post" style="max-width: 400px; background: white; padding: 20px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <input type="text" name="username" placeholder="Benutzername" required style="width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: 1px solid #ccc;">
            <input type="email" name="email" placeholder="E-Mail" required style="width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: 1px solid #ccc;">
            <input type="password" name="password" placeholder="Passwort" required style="width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: 1px solid #ccc;">
            <button type="submit" style="background: var(--secondary-color); color: white; padding: 12px 30px; border: none; border-radius: 25px; margin-top: 15px; cursor: pointer;">
                Registrieren
            </button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
