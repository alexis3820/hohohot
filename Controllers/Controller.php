<?php
namespace App\Controllers;

abstract class Controller{

    public function render(string $file, array $data = []){
        extract($data);
        require_once ROOT.'/Views/'.$file.'.php';
    }
}