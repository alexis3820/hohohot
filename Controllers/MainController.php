<?php
namespace App\Controllers;

use App\Models\Temperature;

class MainController extends Controller{
    public function index(){
        $temperature = new Temperature();
        $temperatures = $temperature->getLastTemperatures();
        $this->render('main/index', ['temperatures'=>$temperatures]);
//        $this->render('main/index', []);
    }
}