<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

foreach ($contentDocuments as $key=>$contentDocument){ ?>
        <section>
            <h2><?php echo $key ?></h2>
            <p><?php echo $contentDocument?></p>
        </section>
<?php } if(User::isConnected()){ ?>
        <section>
            <form action="/documentation/editSelectDocument" method="post">
                <label for="selected_doc">Choisir un document à éditer :</label>
                <select name="selected_doc">
                    <?php if(isset($documents)) {
                        $i = 0;
                        foreach ($documents as $document){ ?>
                            <option selected><?php echo $document; ?></option>
                        <?php }
                    } ?>
                </select>
                <input type="submit" name="select_edit_doc" value="Choisir">
            </form>
            <a href="/documentation/createDocument">Créer un nouveau document</a>

        </section>
<?php } include(ROOT . '/Views/main/footer.php'); ?>