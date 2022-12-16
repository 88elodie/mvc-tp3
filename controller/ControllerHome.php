<?php

class ControllerHome{
    public function index(){
        return Twig::render('home-index.php');
    }

    public function error(){
        return Twig::render('error.php');
    }

    public function pdf() {
        $path = "../sponge_stand.pdf";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($path));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        set_time_limit(0);
        @readfile($path);
    }
}