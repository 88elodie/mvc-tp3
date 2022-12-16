<?php

class ModelUser extends Crud {

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'nom', 'username', 'password', 'privileges_id'];

    public function checkUser($username, $password){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();
        if($count == 1){
            $user_info = $stmt->fetch();
            if(password_verify($password, $user_info['user_password'])){
                    
                session_regenerate_id();
                $_SESSION['user_id'] = $user_info['user_id'];
                $_SESSION['privileges_id'] = $user_info['privileges_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                $tzo = new DateTimeZone('America/New_York');
                $date = new DateTime;
                $date->setTimezone($tzo);
                $_SESSION['login_time'] = date_format($date, 'Y-m-d H:i:s');
                
                requirePage::redirectPage('../user/index');
                
            }else{
               return "<ul><li>Verifier le mot de passe</li></ul>";  
            }
        }else{
            return "<ul><li>Le non d'utilisateur n'existe pas</li></ul>";
        }
    } 

    public function checkUserExist($username){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();
        if($count == 1){
            return false;
        }else {
            return true;
        }
    } 
}