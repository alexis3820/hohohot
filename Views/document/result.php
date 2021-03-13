<?php
use App\Models\User;

include(ROOT . '/Views/main/header.php');

if(isset($status)){ ?>
    <p><?php echo $status; ?></p>
    <h2><?php echo $nameDocument; ?></h2>
    <p><?php if(isset($updatedDocument))echo $updatedDocument; ?></p>
<?php
}else{
    ?>
    <p>Il n'y a rien à voir ici</p>
<?php
}

include(ROOT . '/Views/main/footer.php');