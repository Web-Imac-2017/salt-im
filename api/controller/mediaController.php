<?php

require "Media.php";

require "MediasManager.php";

class mediaController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new mediaController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new MediasManager($db);
        $id = $this->id;
        $media = $manager->get($id);
        $json = json_encode($this->jsonSerialize($media));
        echo $json;
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }
    
    public function jsonSerialize(Media $media) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'id' => utf8_encode($subject->get_id()),
            'link' => utf8_encode($subject->get_link()),
            'type' => utf8_encode($subject->get_type()),
            'publication_id' => utf8_encode($subject->get_publication_id()),
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