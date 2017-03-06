<?php

require "Stat.php";

require "StatsManager.php";

class statController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new statController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $stat = $manager->get($id);
        $json = json_encode($this->jsonSerialize($stat));
        echo $json;
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }
    
    public function jsonSerialize(Stat $stat) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'id' => utf8_encode($subject->get_id()),
            'name' => utf8_encode($subject->get_namelink()),
            'value' => utf8_encode($subject->get_value()),
            'related_element_id' => utf8_encode($subject->get_related_element_id()),
        );
        // in the way you want it arranged in your API
        return $data;
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