<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('User');
RequirePage::requireModel('Privilege');
RequirePage::requireLibrary('Validation');
RequirePage::requireModel('Session');
RequirePage::requireLibrary('CheckSession');

class ControllerUser{

    public function index(){
        $session = $_SESSION['privileges_id'];
        CheckSession::SessionAuth();
        twig::render('user-index.php', ['session' => $session]);
    }

    public function list() {
        $user = new ModelUser;
        $select = $user->select();
        CheckSession::SessionAuth();
        twig::render('user-list.php', ['users' => $select]);
    }

    public function log() {
        $session = new ModelSession;
        $select = $session->select();
        CheckSession::SessionAuth();
        twig::render('user-log.php', ['session' => $select]);
    }

    public function create(){
        if(CheckSession::sessionAuth()){
            if ($_SESSION['privileges_id'] == 1 || $_SESSION['privileges_id'] == 2){
                $privilege = new ModelPrivilege;
                $selectPrivilege = $privilege->select();
                twig::render('user-create.php', ['privileges' => $selectPrivilege]);
            }else{
                requirePage::redirectPage('../home/error');
            }
        }          
    }
    public function store(){

        if($_SESSION['privileges_id']==2){
            $_POST['privileges_id'] = 3; 
        }
        $validation = new Validation;
        extract($_POST);
        print_r($_POST);
        $nom = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['user_password'];
        $privilege_id = $_POST['privileges_id'];
        $validation->name('nom')->value($nom)->pattern('alpha')->required()->max(45);
        $validation->name('username')->value($username)->pattern('email')->required()->max(50);
        $validation->name('user_password')->value($password)->max(20)->min(6);
        $validation->name('privileges_id')->value($privilege_id)->pattern('int')->required();

        if($validation->isSuccess()){
            $user = new ModelUser;

            $options = [
                'cost' => 10,
            ];
            $_POST['user_password']= password_hash($_POST['user_password'], PASSWORD_BCRYPT, $options);
            $userInsert = $user->insert($_POST);
            requirePage::redirectPage('../user/login');
        }else{
            $errors = $validation->displayErrors();
            $privilege = new ModelPrivilege;
            $selectPrivilege = $privilege->select();
            twig::render('user-create.php', ['errors' => $errors,'privileges' => $selectPrivilege, 'user' => $_POST]);
        }
    }

    public function login(){
        twig::render('user-login.php');
    }

    public function auth(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('username')->value($username)->pattern('email')->required()->max(50);
        $validation->name('user_password')->value($password)->required();

        if($validation->isSuccess()){

            $user = new ModelUser;
            $checkUser = $user->checkUser($username, $password);
            
            twig::render('user-login.php', ['errors' => $checkUser, 'user' => $_POST]);
        
        }else{
            $errors = $validation->displayErrors();
            twig::render('user-login.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function logout(){
        session_destroy();
        requirePage::redirectPage('../login/index');
    }
}




?>