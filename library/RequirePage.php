<?php

class RequirePage{
    static function requireModel($page){
        return require_once 'model/'.$page.'.php';
    }
    static function requireLibrary($page){
        return require_once 'library/'.$page.'.php';
    }
    static function redirectPage($url){
        header("Location: $url");
    }
}