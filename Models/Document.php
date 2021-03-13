<?php


namespace App\Models;

class Document
{
    private $authorizedExtensions = [
        'txt',
        'odt',
    ];

    private $directory = '../static/documentation/';

    public function getListDocuments(){
        $files = scandir($this->directory);
        $finalNameFile = [];
        foreach ($files as $file){
            $fileToAnalyse = explode('.',$file);
            foreach ($fileToAnalyse as $analyse){
                if(!empty($analyse)){
                    foreach ($this->authorizedExtensions as $extension){
                        if($extension == $analyse){
                            $finalNameFile[] = $file;
                        }
                    }
                }
            }
        }

        return $finalNameFile;
    }

    public function getContentDocument($document){
        return file_get_contents($this->directory.$document);
    }

    public function saveChange($document){
        if(isset($_POST['doc_change'])){
            $fp = fopen($this->directory.$document, "r+");
            file_put_contents($this->directory.$document, $_POST['doc_change']);
            fclose($fp);
            return true;
        }else{
            return false;
        }
    }

    public function deleteDocument($document){
        if(isset($_POST['delete_doc'])){
            unlink($this->directory.$document);
            return true;
        }else{
            return false;
        }
    }

    public function createDocument($name,$content){
        $nameToAnalyse = explode('.',$name);
        $authorized = false;
        foreach ($nameToAnalyse as $analyse){
            if(!empty($analyse)){
                foreach ($this->authorizedExtensions as $extension){
                    if($extension == $analyse){
                        $authorized = true;
                    }
                }
            }
        }

        if($authorized && $this->documentExist($name)){
            $fp = fopen($this->directory.$name,"wb");
            fwrite($fp,$content);
            fclose($fp);
            return true;
        }else{
            return false;
        }
    }

    public function documentExist($documentToVerify){
        $listDocuments = $this->getListDocuments();
        foreach ($listDocuments as $document){
            if($document === $documentToVerify){
                return false;
            }
        }

        return true;
    }

}