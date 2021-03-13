<?php

use App\Autoloader;
use App\Core\Main;

//constant root project
define('ROOT', dirname(__DIR__));

//import autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

//Main = rooter
$app = new Main();
$app->start();