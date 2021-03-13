<?php

if(isset($tokenIsValidate)){

?>
<form action="/user/changePassword">
    <div>
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" id="password" name="new_password">
    </div>
    <div>
        <label for="password-confirmation">Confirmer mot de passe :</label>
        <input type="password" id="password-confirmation" name="password_confirmation">
    </div>
    <div>
        <input type="submit" name="submitChange" value="Register">
    </div>
</form>
<?php }else{
    header('Location : /');
}?>