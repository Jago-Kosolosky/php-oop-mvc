<?php
session_start();
include 'autoload.php';

$router = new Router();
$controllerData = $router->getController();

if($controllerData === false){
	print '404';
	exit;
}//endif

$class = isset($controllerData['controller']) ? $controllerData['controller'] : false;
$method = isset($controllerData['method']) ? $controllerData['method'] : false; 
if($class == false || ! file_exists('controllers/' . $class . '.php')  || $method == false){
    print '404';
    exit;
}//endif
    
// $controller = new LoginController()
$controller = new $class();
// $controller->login();
print $controller->$method();