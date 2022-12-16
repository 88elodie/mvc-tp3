<?php
RequirePage::requireModel('CRUD');
RequirePage::requireModel('User');
RequirePage::requireLibrary('Validation');
RequirePage::requireModel('Session');

class ControllerLogin {
    public function index(){
        return Twig::render('login-index.php');
    }
    public function authentication(){
        $user = new ModelUser;
        $username = $_POST['username'];
        $password = $_POST['user_password'];
        $user->checkUser($username, $password);
    }
    public function logout(){
        $sessionData = [
            'user_id' => $_SESSION['user_id'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'login_time' => $_SESSION['login_time']
        ];
        $session = new ModelSession;
        $session->insert($sessionData);

        session_destroy();
        RequirePage::redirectPage('../book/index');
    }
}
?>