<?php


namespace App\Models;
require '../Core/DB.php';
use DB,PDO;

class User
{
    private $connexionDb;


    public static function isConnected() {
        return isset($_SESSION['id']);
    }

    public function isAdmin(){
        if(isset($_SESSION['id'])){
            $test = $this->getUser($_SESSION['id']);
        }
    }

    public function getUser($email){
        $_SQL_getdata = "SELECT id,firstname,lastname,email FROM user WHERE (:email=email)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute(array(":email"=>$email));
        return $query->fetch();
    }

    public function createUser($firstname, $lastname, $password, $email){
        $_SQL_insertdata = "INSERT INTO user (firstname, lastname, password, email) VALUES (:firstname, :lastname, :password, :email)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_insertdata);
        try{
            $create = $query->execute(array(":firstname"=>$firstname,":lastname"=>$lastname,":password"=>$password,":email"=>$email));
            if($create !== null){
                return true;
            }
        }catch(\Exception $e){
            if(23000 == $e->getCode()){
                return false;
            }
        }

        return false;
    }

    public function connectUser($email, $password){
        if($this->matchPassword($email,$password)){
            $_SQL_getdata = "SELECT email FROM user WHERE (:email=email)";
            $this->connexionDb = DB::getInstance();
            $query = $this->connexionDb->prepare($_SQL_getdata);
            $query->execute(array(":email"=>$email));
            return $query->fetch(PDO::FETCH_OBJ);
        }else{
            return false;
        }

    }

    public function getConnectionInformationUser($email){
        $_SQL_getdata = "SELECT nb_connection,nb_connection_failed,is_blocked FROM user WHERE email=:email";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute(array(":email"=>$email));
        return $query->fetch();
    }

    public function updateConnection($email){
        if($this->getUser($email)){
            $_SQL_updatedata = "UPDATE user SET nb_connection=nb_connection+1,nb_connection_failed=nb_connection_failed+1 WHERE email=:mail";
            $this->connexionDb = DB::getInstance();
            $query = $this->connexionDb->prepare($_SQL_updatedata);
            $query->execute(array(":mail"=>$email));
        }
    }

    public function resetConnectionFailed($email){
        $_SQL_updatedata = "UPDATE user SET nb_connection_failed=0 WHERE email=:mail";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_updatedata);
        $query->execute(array(":mail"=>$email));
    }

    public function blockAccount($email){
        $_SQL_updatedata = "UPDATE user SET is_blocked=true WHERE email=:mail";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_updatedata);
        $query->execute(array(":mail"=>$email));
    }

    public function matchPassword($email, $password){
        $_SQL_getdata = "SELECT password FROM user WHERE (:email=email)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute(array(":email"=>$email));
        $hash = $query->fetchColumn();
        if(password_verify($password, $hash)){
            return true;
        }

        return false;
    }

    public function updatePassword($email, $password){
        $_SQL_updatedata = "UPDATE user SET password=:password WHERE email=:mail";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_updatedata);
        if($query->execute(array(":password"=>$password,":mail"=>$email))){
            return true;
        }else{
            return false;
        }
    }


    //token
    public function mailRecuperationExist($mail){
        $_SQL_getdata = "SELECT mail FROM recuperation WHERE (:mail=mail)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute(array(":mail"=>$mail));
        return $query->fetch();
    }

    public function tokenRecuperationUpdate($mail, $code){
        $_SQL_updatedata = "UPDATE recuperation SET code=:code,last_date=now() WHERE :mail=mail";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_updatedata);
        $query->execute(array(":code"=>$code,":mail"=>$mail));
    }

    public function insertRecuperationData($mail, $code){
        $_SQL_insertdata = "INSERT INTO recuperation(mail,code) VALUES (:mail, :code)";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_insertdata);
        $query->execute(array(":mail"=>$mail,":code"=>$code));
    }

    public function isValidToken($mail,$code){
        $_SQL_getdata = "SELECT code FROM recuperation WHERE :mail=mail AND :code=code AND last_date >= NOW()-INTERVAL 5 MINUTE AND last_date <= NOW()+INTERVAL 5 MINUTE";
        $this->connexionDb = DB::getInstance();
        $query = $this->connexionDb->prepare($_SQL_getdata);
        $query->execute(array(":mail"=>$mail,":code"=>$code));
        return $query->fetch();
    }
}