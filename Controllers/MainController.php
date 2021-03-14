<?php
namespace App\Controllers;

//use App\Models\Temperature;

class MainController extends Controller{
    public function index(){
//        $temperature = new Temperature();
//        $temperatures = $temperature->getLastWeekTemperature();
//        $this->render('capteur/graph', ['temperatures'=>$temperatures]);
        $this->render('main/index', []);
    }
}