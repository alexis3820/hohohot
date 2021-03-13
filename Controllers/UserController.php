<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Mail;

class UserController extends Controller
{
    public function register()
    {
        $this->render('user/register');
        if (isset($_POST['submitRegister'])) {
            if((isset($_POST['password']) && isset($_POST['password_confirmation']))
                && $_POST['password'] === $_POST['password_confirmation']){
                $user = new User();
                $createUser = $user->createUser($_POST['first_name'], $_POST['last_name'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']);
                if($createUser){
                    header('Location: /user/login/status');
                }else{
                    echo 'Cette adresse mail est déjà utilisé, choisissez en une autre !';
                }
            }else{
                echo 'Les mots de passes ne se correspondent pas, veuillez réessayer !';
            }

        }
    }

    public function login(array $params = [])
    {
        if(isset($params[0])){
            $message = 'Compte créé avec succés ! Maintenant, vous pouvez vous connecter !';
            $this->render('user/login', ['message' => $message]);
        }else{
            $this->render('user/login');
        }

        if (isset($_POST['submitLogin'])) {
            $user = new User();
            $connectionInformation = $user->getConnectionInformationUser($_POST['email']);
            if(false !== $connectionInformation){
                if(isset($connectionInformation['is_blocked']) && true != $connectionInformation['is_blocked']){
                    if (false === $user->connectUser($_POST['email'], $_POST['password'])) {
                        $user->updateConnection($_POST['email']);
                        if(isset($connectionInformation['nb_connection_failed']) &&
                            4 <= (int)$connectionInformation['nb_connection_failed']){
                            $user->blockAccount($_POST['email']);
                        }

                        echo 'Identifiant ou mot de passe incorrect, veuillez réessayer !';
                    } else {
                        $user->resetConnectionFailed($_POST['email']);
                        $_SESSION['id'] = $_POST['email'];
                        header('Location: /');
                        exit;
                    }
                }else{
                    echo 'Ce compte est bloqué suite à un trop gros nombre de tentative de connexion.';
                }
            }else{
                echo 'Identifiant ou mot de passe incorrect, veuillez réessayer !';
            }

        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function profil()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            $user = new User();
            $actualUserInformations = $user->getUser($_SESSION['id']);
            if (isset($_POST['submit_recup'], $_POST['mail_recup'])) {
                if(!empty($_POST['mail_recup'])){
                    $mail = htmlspecialchars($_POST['mail_recup']);
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        if($mail === $_SESSION['id']){
                            $informations = $user->getUser($mail);
                            if (isset($informations['email']) && null !== $informations['email'] && !empty($informations['email'])) {
                                $recup_code = "";
                                for ($i = 0; $i < 8; $i++) {
                                    $recup_code .= mt_rand(0, 9);
                                }

                                $_SESSION['recup_code'] = $recup_code;
                                $mailExist = $user->mailRecuperationExist($mail);
                                if (!$mailExist) {
                                    $user->insertRecuperationData($mail, $recup_code);
                                } else {
                                    $user->tokenRecuperationUpdate($mail, $recup_code);
                                }

                                $email = new Mail($mail,$recup_code,$actualUserInformations['lastname'].' '.$actualUserInformations['firstname']);
                                $email->send();
                                echo 'Un lien a bien été envoyé à l\'adresse mail renseignée';
                            }else{
                                echo 'Veuillez renseigner une adresse email valide';
                            }

                        }else{
                            echo 'L\'adresse mail que vous venez de renseigner ne correspond pas à celle de votre compte ... Veuillez réessayer !';
                        }

                    } else {
                        echo 'Veuillez renseigner une adresse email valide';
                    }

                }else{
                    echo 'Veuillez renseigner une adresse email';
                }

            }

            session_write_close();
            $this->render('user/profil', ['informations'=>$actualUserInformations]);
        } else {
            session_write_close();
            $this->render('user/login');
        }

    }

    public function VerifyToken()
    {
        session_start();
        if(!isset($_SESSION['id'])){
            session_write_close();
//            header('Location : /');
            $this->render('user/login');
        }

        $this->render('user/verifyToken');
        if(isset($_POST['submitToken'])){
            if(!empty($_POST['token'])){
                $user = new User();
                $token = $user->isValidToken($_SESSION['id'],$_POST['token']);
                if(false !== $token){
                    if($token['code'] === $_POST['token']){
                        session_write_close();
                        header('Location : /');
                        $this->render('user/changePassword');
                    }else{
                        echo 'Token expiré';
                    }

                }else{
                    echo 'Token expiré';
                }

            }else{
                echo 'Veuillez insérer le code qui vous a été envoyé';
            }

        }

    }

    public function changePassword()
    {
        echo 'boobs';

    }
}