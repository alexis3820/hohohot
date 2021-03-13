<?php
namespace App\Models;
require '../Core/DB.php';
use DB;
class Temperature extends DB
{
    public function insert($temperatures){
        $dataToInsert = $this->format($temperatures);
        $_SQL_insertdata = "INSERT INTO degree(value_int,value_ext,alert_int,alert_ext) VALUES (:value_int, :value_ext, :alert_int, :alert_ext)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_insertdata);
        $query->execute(array(
            ":value_int"=>$dataToInsert['temperatureInterieur'],
            ":value_ext"=>$dataToInsert['temperatureExterieur'],
            ":alert_int"=>$dataToInsert['alerteInterieur'],
            ":alert_ext"=>$dataToInsert['alerteExterieur'],
            ));
    }

    public function getLastTemperature(){
        $_SQL_getdata = "SELECT * FROM degree WHERE date = (SELECT MAX(date) FROM degree);";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute();
        return $query->fetch();
    }

    public function format($temperatures){
        $temperatures = json_decode($temperatures,true);
        $finalData = [];
        foreach ($temperatures as $temperature){
            $temp = null;
            if('interieur' === $temperature['Nom']){
                $temperatureInterieur = (float)$temperature['Valeur'];
                if($temperatureInterieur > 22){
                    $alertInterieur = 'Baissez le chauffage !';
                }else if($temperatureInterieur > 50){
                    $alertInterieur = 'Appelez les pompiers ou arrêtez votre barbecue !';
                }else if($temperatureInterieur < 12){
                    $alertInterieur = 'Montez le chauffage ou mettez un gros pull !';
                }else if($temperatureInterieur < 0){
                    $alertInterieur = 'Canalisations gelées, appelez SOS plombier - et mettez un bonnet !';
                }else{
                    $alertInterieur = 'Température correct !';
                }

                $finalData['temperatureInterieur'] = $temperatureInterieur;
                $finalData['alerteInterieur'] = $alertInterieur;
            }

            if('exterieur' === $temperature['Nom']){
//                $dateTemperature = new \DateTime();
//                $dateTemperature = date_timestamp_set($dateTemperature, (int)$temperature['Timestamp']);
//                $finalDateTemperature = $dateTemperature->format('Y-m-d H:i:s');
//                $finalData['date'] = $finalDateTemperature;
                $temperatureExterieur = (float)$temperature['Valeur'];
                if($temperatureExterieur < 0){
                    $alertExterieur = 'Banquise en vue !';
                }else if($temperatureExterieur > 35){
                    $alertExterieur = 'Hot Hot Hot !';
                }else{
                    $alertExterieur = 'Il fait plutôt bon dehors !';
                }

                $finalData['temperatureExterieur'] = $temperatureExterieur;
                $finalData['alerteExterieur'] = $alertExterieur;
            }

        }

        return $finalData;
    }

}
