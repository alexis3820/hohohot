<?php

use App\Models\User;

include(ROOT . '/Views/main/header.php'); ?>
    <div class="row">
        <div class="text-center mt-5">
            <h1>Documentation Hohohot</h1>
        </div>
        <?php if(User::isConnected()){ ?>
        <div class="p-3 mt-5 mb-5" id="editDocBar">
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
    <?php foreach ($contentDocuments as $key=>$contentDocument){ ?>
        <section>
            <h2><?php echo $key ?></h2>
            <?php echo $contentDocument?>
        </section>
    <?php } ?>
    </div>
<?php include(ROOT . '/Views/main/footer.php'); ?>