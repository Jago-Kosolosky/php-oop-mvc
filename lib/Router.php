<?php
class Router {
    private $routes = array();
    
    public function __construct(){
        $this->routes = include('router.php');
   
    }
    
    public function getController($defaultUrl = 'home'){
        
        $url = isset($_GET['url']) ? $_GET['url'] : $defaultUrl;
        $controller = isset($this->routes[$url]) ? $this->routes[$url] : false;
        
        return $controller;
    }
}



?>
