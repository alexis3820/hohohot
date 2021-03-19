<?php
namespace App\Models;

require_once '../public/static/library/jbbcode-1.3.0/JBBCode/Parser.php';

use JBBCode\DefaultCodeDefinitionSet;
use JBBCode\Parser;

class Document
{
    private $authorizedExtensions = [
        'txt',
        'odt',
    ];

    private $directory = ROOT.'/public/static/documentation/';

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

    public function getConvertedContentDocument($document){
        $content = htmlspecialchars((file_get_contents($this->directory.$document)));
        $parser = new Parser();
        $parser->addCodeDefinitionSet(new DefaultCodeDefinitionSet());
        $parser->parse(nl2br($content));

        return $parser->getAsHTML();
    }

    public function getNoConvertedContentDocument($document){
        return htmlspecialchars((file_get_contents($this->directory.$document)));
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