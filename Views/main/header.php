<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="apple-mobile-web-app-status-bar" content="white">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <title>Hohohot</title>
    <link rel="stylesheet" href="../../static/css/wbbtheme.css">
    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="/static/icons/icon-96x96.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../static/js/ws.js"></script>
    <script src="../../static/js/jquery.wysibb.min.js"></script>
    <script src="../../static/js/wysi.js"></script>
    <script src="../../static/js/app.js"></script>
</head>
<body>
<?php

use App\Models\User;

session_start();
?>
    <header>
        <nav class="navbar navbar-inverse border-0">
            <div class="container-fluid d-inline">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle border-0" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Hohohot</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="navbar-nav d-inline">
                        <li class="nav-item pl-2">
                            <a class="nav-link" href="/capteur/index">Températures</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/documentation/index">Documentation</a>
                        </li>
                        <?php if (User::isConnected()) { ?>
                            <li class="nav-item ml-2">
                                <a class="nav-link" href="/user/profil" title="Profil"><?php echo $_SESSION['id'] ?></a>
                            </li>
                            <li class="nav-item ml-2">
                                <a class="nav-link" href="/user/logout" title="Déconnexion">Se déconnecter</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item ml-2">
                                <a class="nav-link" href="/user/register">S'enregistrer</a>
                            </li>
                            <li class="nav-item ml-2">
                                <a class="nav-link" href="/user/login">Se connecter</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container pb-5">