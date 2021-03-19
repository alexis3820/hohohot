<?php include(ROOT . '/Views/main/header.php'); ?>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="mt-5 mb-5 text-center">
                <h1>Température Hohohot en temps réel !</h1>
                <p id="informationTemperature">L'affichage en temps réel des températures Hohohot peut prendre une petite minute merci de patienter !</p>
            </div>
            <div class="mb-5 text-center">
                <p id="status">Connexion à hohohot.dog...</p>
                <button id="alertButton" onclick="showAlert()"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-5 p-5" id="cardExt">
                    <p id="tempExt"></p>
                    <label for="tempExt">(Extérieur)</label>
                    <p id="alertExt" style="display: none;"></p>
                </div>
                <div class="col-2"></div>
                <div class="col-5 p-5" id="cardInt">
                    <p id="tempInt"></p>
                    <label for="tempInt">(Intérieur)</label>
                    <p id="alertInt" style="display: none;"></p>
                </div>
            </div>
        </div>
    </div>
<?php include(ROOT . '/Views/main/footer.php'); ?>