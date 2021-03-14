<?php include(ROOT . '/Views/main/header.php'); ?>
    <div class="row justify-content-center">
        <div class="col-8">
        <?php if(isset($status)){ ?>
            <div class="text-center mt-5 mb-5">
                <h1><?php echo $nameDocument; ?></h1>
                <p><?php echo $status; ?></p>
            </div>
            <section>
                <?php if(isset($updatedDocument))echo $updatedDocument; ?>
                <?php }else{ ?>
                    <div class="text-center mt-5">
                        <p>Il n'y a rien à voir ici</p>
                    </div>
                <?php } ?>
            </section>
        </div>
    </div>
<?php include(ROOT . '/Views/main/footer.php'); ?>