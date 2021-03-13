<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if (User::isConnected() && isset($selectedDocument)) {?>
    <h1>Vous éditez <?php echo $selectedDocument; ?></h1>
    <form action="/documentation/saveChange" method="post">
        <textarea name="doc_change" id="editor"><?php if(isset($documentContent))echo $documentContent; ?></textarea>
        <input type="hidden" name="selected_doc" value="<?php echo $selectedDocument; ?>">
        <input type="submit" name="save_change" value="Sauvegarder">
    </form>
    <form action="/documentation/deleteDocument" method="post">
        <input type="hidden" name="selected_doc" value="<?php echo $selectedDocument; ?>">
        <input type="submit" name="delete_doc" value="Supprimer ce document">
    </form>
<?php } else { ?>
    <p>Il n'y a rien ici, <a href="/">retournez à l'accueil</a>.</p>
<?php }include(ROOT . '/Views/main/footer.php'); ?>