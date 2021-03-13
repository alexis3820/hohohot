<?php
namespace App\Models;


class Model extends Db
{
    protected $table;
    private $db;

    public function findAllData(){
        $query = $this->query('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }

    public function query(string $sql, array $attributs = null){
        //get instance of db
        $this->db = Db::getInstance();

        if(null !== $attributs){
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            return $this->db->query($sql);
        }
    }
}