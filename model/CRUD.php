<?php

abstract class CRUD extends PDO{
    public function __construct(){
    parent::__construct("mysql:host=localhost;dbname=librarySystem2;charset=utf8",
    "root", "");
    }
    public function select(){
        if($this->table == 'livre'){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM $this->table 
                LEFT OUTER JOIN auteur ON $this->table.auteur_id = auteur.auteur_id
                LEFT OUTER JOIN editeur ON $this->table.editeur_id = editeur.editeur_id
                LEFT OUTER JOIN categorie ON $this->table.categorie_id = categorie.categorie_id
                WHERE livre_id = $id;";
            }else{
                $sql = "SELECT * FROM $this->table
                LEFT OUTER JOIN auteur ON $this->table.auteur_id = auteur.auteur_id
                LEFT OUTER JOIN editeur ON $this->table.editeur_id = editeur.editeur_id
                LEFT OUTER JOIN categorie ON $this->table.categorie_id = categorie.categorie_id;";
            }
        }elseif($this->table == 'session') {
            if(isset($_SESSION['user_id'])){
                $id = $_SESSION['user_id'];
                $sql = "SELECT $this->table.logout_time, $this->table.login_time, $this->table.ip_address, user.username FROM $this->table
                LEFT OUTER JOIN user ON $this->table.user_id = user.user_id
                WHERE $this->table.user_id = $id";
            }
        }else{
            $sql = "SELECT * FROM $this->table";
        }
    
        $query = $this->query($sql);
        
        return $query->fetchAll();
    }

    public function insert($data){
        $nomChamp = implode(", ", array_keys($data));
        $valeurChamp = ':'.implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";

        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }

    public function update($data, $id){
        $champRequete = null;
        foreach($data as $key=>$value) {
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE $this->table SET $champRequete WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }

    public function delete($data){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }
    }
}