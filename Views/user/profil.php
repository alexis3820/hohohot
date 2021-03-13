<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if (User::isConnected()) { ?>
    <h1>Page de profil</h1>
    <p><?php echo $informations['firstname']; ?></p>
    <p><?php echo $informations['lastname']; ?></p>
    <form action="/user/profil" method="post">
        <input type="email" placeholder="Votre email" name="mail_recup">
        <input id="submit_recup" type="submit" value="Envoyer" name="submit_recup">
    </form>
    <?php
    if (isset($tokenIsValidate)) {
        echo "OUI LE TOKEN !";
    }
} else {
    header('Location: /');
}

include(ROOT . '/Views/main/footer.php');
?>