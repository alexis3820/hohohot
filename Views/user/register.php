<?php

use App\Models\User;

include(ROOT.'/Views/main/header.php');

if (!User::isConnected()) {
?>
<form action="/user/register" method="post">
    <div>
        <label for="first-name">Nom :</label>
        <input type="text" id="first-name" name="first_name">
    </div>
    <div>
        <label for="last-name">Prénom :</label>
        <input type="text" id="last-name" name="last_name">
    </div>
    <div>
        <label for="email">Mail :</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="password-confirmation">Confirmer mot de passe :</label>
        <input type="password" id="password-confirmation" name="password_confirmation">
    </div>
    <div>
        <input type="submit" name="submitRegister" value="Register">
    </div>
</form>
    <?php if(isset($message)){ ?>
        <p><?php echo $message; ?></p>
<?php }
}else{
    header('Location: /');
}

include(ROOT.'/Views/main/footer.php');
?>
