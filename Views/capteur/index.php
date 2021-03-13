<?php include(ROOT . '/Views/main/header.php'); ?>
    <h2>Température Hohohot en temps réel !</h2>
    <p style="font-style: italic;">L'affichage des températures Hohohot peu prendre une à deux petites minutes merci de patienter !</p>
    <p id="status">Connexion à hohohot.dog...</p>
    <div>
        <label for="tempExt">Température Extérieur : </label>
        <p id='tempExt'></p>
        <p id='alertExt' style="display: none;"></p>
    </div>
    <div>
        <label for="tempInt">Température Intérieur : </label>
        <p id='tempInt'></p>
        <p id='alertInt' style="display: none;"></p>
    </div>
    <button onclick="showAlert()">Alerte</button>
<?php include(ROOT . '/Views/main/footer.php'); ?>