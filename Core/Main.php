<?php
namespace App\Core;

use App\Controllers\MainController;

/**
 * Class Main
 * Main rooter
 * @package App\Core
 */
class Main{
    public function start(){

        $uri = $_SERVER['REQUEST_URI'];

        //if 'trailing slash' exist
        if(!empty($uri) && '/' != $uri && '/' === $uri[-1]){
            //remove slash and redirect to avoid duplicate content
            $uri = substr($uri, 0, -1);
            http_response_code(301);
            header('Location: '.$uri);
        }

        $parameters = [];
        if(isset($_GET['p'])){
            $parameters = explode('/', $_GET['p']);
        }

        if(isset($parameters[0])){
            //get controller name to instanciate
            $controller = '\\App\\Controllers\\'.ucfirst(array_shift($parameters)).'Controller';
            $controller = new $controller();

            //get second potential parameter (method)
            $action = (isset($parameters[0])) ? array_shift($parameters) : 'index';
            if(method_exists($controller, $action)){

                (isset($parameters[0])) ? $controller->$action($parameters) : $controller->$action();
            }else{
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        }else{
            //0 parameter then instanciate default controller
            $controller = new MainController();
            $controller->index();
        }

    }
}