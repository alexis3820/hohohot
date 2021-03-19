<?php
namespace App\Controllers;

use App\Models\Temperature;

class CapteurController extends Controller
{

    public function index()
    {
        $this->render('capteur/index');
    }

    public function insert(){
        $temperature = new Temperature();
        $ajaxTemperature = $_POST['temperature'];
//        [{"type":"Thermique","Nom":"interieur","Valeur":"21.3","Timestamp":1615574887},{"type":"Thermique","Nom":"exterieur","Valeur":"10.9","Timestamp":1615574887}]
        $temperature->insert($ajaxTemperature);
        $finalData = $temperature->getLastTemperature();
        echo json_encode($finalData);
    }
}