<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php');

?>
    <div class="row">
        <div class="text-center mt-5">
            <h1>Documentation Hohohot</h1>
        </div>
        <?php if(User::isConnected()){ ?>
        <div class="text-center mt-4 mb-2">
            <h2>Edition de document</h2>
        </div>
        <div class="p-3 mb-2" id="editDocBar">
            <form class="mb-2" action="/documentation/editSelectDocument" method="post">
                <label for="selected_doc">Choisir un document à éditer :</label>
                <div class="col-6">
                    <select class="form-select mt-1 mb-2" name="selected_doc">
                        <?php if(isset($documents)) {
                            $i = 0;
                            foreach ($documents as $document){ ?>
                                <option selected><?php echo $document; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <input type="submit" name="select_edit_doc" value="Choisir">
            </form>
            <a href="/documentation/createDocument">Créer un nouveau document</a>
        </div>
        <?php } ?>
        <div class="text-center mt-5 mb-2">
            <h2>Lecture de document</h2>
        </div>
        <div class="p-3 mb-5" id="editDocBar">
            <form class="mb-2" action="/documentation/showSelectDocument" method="post">
                <label for="selected_doc">Choisissez un document à lire :</label>
                <div class="col-6">
                    <select class="form-select mt-1 mb-2" name="selected_show_doc">
                        <?php if(isset($documents)) {
                            $i = 0;
                            foreach ($documents as $document){ ?>
                                <option selected><?php echo $document; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <input type="submit" name="select_show_doc" value="Lire">
            </form>
        </div>
    <?php if(isset($content)){ ?>
        <section id="doc" class="mb-5 mt-5">
            <div class="text-center mb-5">
                <h3 class="mb-5"><?php echo key($content) ?></h3>
                <?php echo $content[key($content)] ?>
            </div>
        </section>
    <?php } ?>
    </div>
<?php include(ROOT . '/Views/main/footer.php'); ?>