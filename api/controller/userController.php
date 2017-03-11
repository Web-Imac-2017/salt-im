<?php

require_once "User.php";

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
    
    public function register() {
        include "connect.php";
        $manager = new UserManager($db);
        $manager->register($_POST);
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