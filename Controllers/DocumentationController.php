<?php

namespace App\Controllers;


use App\Models\Document;

class DocumentationController extends Controller
{
    public function index(){
        $document = new Document();
        $listDocuments = $document->getListDocuments();
        $contentDocuments = [];
        foreach ($listDocuments as $doc){
            $contentDocuments[$doc] = $document->getContentDocument($doc);
        }
        $this->render('document/index',['documents'=>$listDocuments,'contentDocuments'=>$contentDocuments]);
    }

    public function editSelectDocument(){
        if(isset($_POST['selected_doc'])){
            $document = new Document();
            $documentContent = $document->getContentDocument($_POST['selected_doc']);
            $this->render('document/edit',['selectedDocument'=>$_POST['selected_doc'],'documentContent'=>$documentContent]);
        }else{
            $this->render('document/error');
        }

    }

    public function saveChange(){
        $message = 'Oppps ! Une erreur est survenu ... Réessayez plus tard !';
        $updatedDocument = null;
        if(isset($_POST['doc_change'],$_POST['selected_doc'])){
            $document = new Document();
            $listDocuments = $document->getListDocuments();
            if(in_array($_POST['selected_doc'],$listDocuments)){
                if($document->saveChange($_POST['selected_doc'])){
                    $updatedDocument = $document->getContentDocument($_POST['selected_doc']);
                    $message = '(Le document '.$_POST['selected_doc'].' à bien été sauvegardé)';
                    $this->render('document/result',['status'=>$message,'updatedDocument'=>$updatedDocument,'nameDocument'=>$_POST['selected_doc']]);
                }
            }

        }else{
            $this->render('document/result');
        }

    }

    public function deleteDocument(){
        $message = 'Oppps ! Une erreur est survenu ... Réessayez plus tard !';
        if(isset($_POST['delete_doc'],$_POST['selected_doc'])){
            $document = new Document();
            if($document->deleteDocument($_POST['selected_doc'])){
                $message = 'Le document '.$_POST['selected_doc'].' à bien été sauvegardé !';
            }
        }

        $this->render('document/result',['status'=>$message]);
    }

    public function createDocument(){
        $message = 'Oppps ! Une erreur est survenu ... Veuillez rééssayer ! 
        (Peut-être, veuillez changer l\'extension en ".txt" ou ".odt" par exemple et/ou le nom de votre document)';
        if(isset($_POST['new_doc_name'],$_POST['new_doc'])){
            $document = new Document();
            if($document->createDocument($_POST['new_doc_name'],$_POST['new_doc'])){
                $message = 'Le document '.$_POST['new_doc_name'].' à bien été créé !';
            }
        }else{
            $this->render('document/create');
        }

        $this->render('document/create',['status'=>$message]);
    }

}