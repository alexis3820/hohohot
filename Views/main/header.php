<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Hohohot</title>
    <link rel="stylesheet" href="../../static/css/wbbtheme.css">
    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../static/js/ws.js"></script>
    <script src="../../static/js/jquery.wysibb.min.js"></script>
    <script src="../../static/js/wysi.js"></script>
</head>
<body>
<?php

use App\Models\User;

session_start();
?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/">Hohohot</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/capteur/index">Températures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/documentation/index">Documentation</a>
                    </li>
                    <?php if (User::isConnected()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/profil" title="Profil"><?php echo $_SESSION['id'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/logout" title="Déconnexion">Se déconnecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/register">S'enregistrer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/login">Se connecter</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container pb-5">