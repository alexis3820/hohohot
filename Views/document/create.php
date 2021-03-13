<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if(User::isConnected()){
?>
<form action="/documentation/createDocument" method="post">
    <label for="new_file_name">Nom du document à créer :</label>
    <input type="text" name="new_doc_name" placeholder="Exemple : Recette.txt" required>
    <textarea name="new_doc" id="editor"></textarea>
    <input type="submit" name="submitNewDocument" value="Créer">
</form>
    <?php if(isset($status)){?>
    <p><?php echo $status; ?></p>
<?php
    }
}else{
    ?>
    <p>Il n'y a rien ici, <a href="/">retournez à l'accueil</a>.</p>
<?php }include(ROOT . '/Views/main/footer.php'); ?>