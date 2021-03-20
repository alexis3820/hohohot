<?php

use App\Models\User;

include(ROOT.'/Views/main/header.php');

if (!User::isConnected()) { ?>
        <div class="row justify-content-center mb-5">
            <div class="col-6">
                <div class="mt-5 mb-5">
                    <h1 class="text-center">Création du compte</h1>
                </div>
                <form action="/user/register" method="post">
                    <div class="mb-3">
                        <input class="form-control" type="text" id="first-name" name="first_name" placeholder="Nom :" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="last-name" name="last_name" placeholder="Prénom :" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Mail :" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe :" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" id="password-confirmation" name="password_confirmation" placeholder="Confirmer mot de passe :" required>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <input class="col-3" type="submit" name="submitRegister" value="Register">
                    </div>
                </form>
                <div class="row justify-content-center">
                    <?php if(isset($message)){ ?>
                        <p><?php echo $message; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php }else{
    header('Location: /');
}

include(ROOT.'/Views/main/footer.php'); ?>
