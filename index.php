<?php // index.php ?>
<?php include 'header.php'; ?>

<div class="main-content">
    <h1>Willkommen bei LinguaFlow</h1>
    <p style="font-size: 1.2em; max-width: 800px;">
        Lerne Sprachen effizient mit KI-gestützten Übungen und intelligenten Wiederholungen. 
        Wähle zwischen verschiedenen Lernmodi, tracke deinen Fortschritt und werde Teil 
        unserer Lerngemeinschaft. Starte jetzt deine Sprachreise!
    </p>

    <div style="margin-top: 40px;">
        <h2>Jetzt kostenlos registrieren</h2>
        <form action="register.php" method="post" style="max-width: 400px;">
            <input type="text" name="username" placeholder="Benutzername" required style="width: 100%; padding: 10px; margin: 5px 0;">
            <input type="email" name="email" placeholder="E-Mail" required style="width: 100%; padding: 10px; margin: 5px 0;">
            <input type="password" name="password" placeholder="Passwort" required style="width: 100%; padding: 10px; margin: 5px 0;">
            <button type="submit" style="background: var(--secondary-color); color: white; padding: 12px 30px; border: none; border-radius: 25px; margin-top: 10px;">
                Registrieren
            </button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
