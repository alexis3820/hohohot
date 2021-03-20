<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if (!User::isConnected()) { ?>
        <div class="row justify-content-center mb-5">
            <div class="col-6">
                <div class="mt-5 mb-5">
                    <h1 class="text-center">Connexion</h1>
                </div>
                <form action="/user/login" method="post">
                    <div class="mb-3">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Mail :">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe :">
                    </div>
                    <div class="row justify-content-center mb-3">
                        <input class="col-3" type="submit" name="submitLogin" value="Login">
                    </div>
                </form>
                <div class="row justify-content-start">
                    <label for="register">Vous n'avez pas encore de compte ? </label>
                    <a class="col-3" href="/user/register" id="register">S'enregistrer</a>
                </div>
                <div class="row justify-content-center">
                    <?php if(isset($message)){ ?>
                    <p><?php echo $message; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php } else {
    header('Location: /');
}

include(ROOT . '/Views/main/footer.php'); ?>