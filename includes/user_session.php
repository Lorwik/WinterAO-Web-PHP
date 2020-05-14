<?php

class UserSession{

    public function __construct(){
        $lifetime=99999999;
        session_set_cookie_params($lifetime);
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>