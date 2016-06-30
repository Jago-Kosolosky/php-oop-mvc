<?php
class Auth {
    public function setUser($user){
        $_SESSION['user'] = $user;
    }
    
    public function getUser(){
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        
        return array();
    }
    
    public function removeUser(){
        unset($_SESSION['user']);
    }
    
    public function isLoggedIn(){
        return isset($_SESSION['user']);
    }
}

?>
