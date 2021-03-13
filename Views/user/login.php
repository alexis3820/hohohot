<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if (!User::isConnected()) {
    ?>
        <div>
            <div>
                <div class="mt-5 mb-5">
                    <h1 class="text-center">Connexion</h1>
                </div>
                <form action="/user/login" method="post">
                    <div class="mb-3">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Mail :">
                    </div>
                    <div>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe :">
                    </div>
                    <div>
                        <input type="submit" name="submitLogin" value="Login">
                    </div>
                </form>
            </div>

        </div>
    <?php if(isset($message)){ ?>
        <p><?php echo $message; ?></p>
<?php }
    } else {
    header('Location: /');
}

include(ROOT . '/Views/main/footer.php');
?>