<?php
require_once __DIR__.'/library/RequirePage.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/library/Twig.php';
require_once __DIR__.'/library/CheckSession.php';

session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/'
)) : '/';
//print_r($url);

if($url == '/'){
    $controllerHome = __DIR__.'/controller/ControllerHome.php';
    require_once $controllerHome;
    $controller = new ControllerHome;
    echo $controller->index();
    
}else{
    $requestURL=$url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__.'/controller/Controller'.$requestURL.'.php';
    if(file_exists($controllerPath)){
        require_once $controllerPath;
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        if(isset($url[1])){
            $method = $url[1];
            if(method_exists($controller, $method)){
                echo $controller->$method();
            }else {
                $controllerHome = __DIR__.'/controller/ControllerHome.php';
                require_once $controllerHome;
                $controller = new ControllerHome;
                echo $controller->error();
            }
            
        }else{
            echo $controller->index();
        }
    }
    else{
        $controllerHome = __DIR__.'/controller/ControllerHome.php';
        require_once $controllerHome;
        $controller = new ControllerHome;
        echo $controller->error();
    }
}