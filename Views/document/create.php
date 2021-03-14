<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

if(User::isConnected()){ ?>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="mt-5 mb-5 text-center">
                    <h1>Créez votre document avec Hohohot</h1>
                </div>
                <form action="/documentation/createDocument" method="post">
                    <div class="mb-3">
                        <label class="mb-1" for="new_file_name">Nom du document à créer :</label>
                        <input class="form-control" type="text" name="new_doc_name" placeholder="Exemple : Temperatures.txt" required>
                    </div>
                    <textarea name="new_doc" id="editor"></textarea>
                    <div class="mt-2">
                        <input type="submit" name="submitNewDocument" value="Créer">
                    </div>
                </form>
                <?php if(isset($status)){?>
                    <p><?php echo $status; ?></p>
                <?php }
                    }else{ ?>
                <p>Il n'y a rien ici, <a href="/">retournez à l'accueil</a>.</p>
                <?php } ?>
            </div>
        </div>

<?php include(ROOT . '/Views/main/footer.php'); ?>