<?php

//require_once "User.php";

require_once "UsersManager.php";

class userController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new userController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function signup() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->register($_POST);
    }
    
    public function signout() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->signout();
    }
    
    public function login() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->login($_POST);
    }
    
    public function logout() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->logout($_POST);
    }
    
    public function name() {
        include "connect.php";
        $manager = new UsersManager($db);
        $id = $this->id;
        $user = $manager->get($id);
        $json = json_encode(utf8_encode($user->get_username()), JSON_UNESCAPED_UNICODE);
        echo($json);
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_id($id) {
        $this->id = $id;      
    }
    
    // Hydrate
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set_'. ucfirst($key);
            
            // Si le setter correspondant existe :
            if(method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }   
}

?>