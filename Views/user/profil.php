<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php'); ?>

<?php if (User::isConnected()) { ?>
    <div class="row justify-content-center">
        <div class="text-center mt-5">
            <h1>Page de profil</h1>
        </div>
        <div class="col-6 mt-5 p-5" id="profilCard">
            <div>
                <p>Nom : <?php echo $informations['firstname']; ?></p>
                <p>Prénom : <?php echo $informations['lastname']; ?></p>
            </div>
            <div class="mt-5">
                <p>Changez votre mot de passe : </p>
                <form action="/user/profil" method="post">
                    <input type="email" placeholder="Votre email" name="mail_recup">
                    <input id="submit_recup" type="submit" value="Envoyer" name="submit_recup">
                </form>
                <p><?php if(isset($message))echo $message; ?></p>
            </div>
        </div>
    </div>

    <?php if (isset($tokenIsValidate)) {
        echo "OUI LE TOKEN !";
    }
} else {
    header('Location: /');
}
?>

<?php include(ROOT . '/Views/main/footer.php'); ?>