<?php

class Stat {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $name;
    private $value;
    
    // Construction de la classe
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    // Setters and getters
    public function get_id() {
        return $this->id;
    }
    
    public function set_id() {
        $this->id = $id;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function set_name() {
        $this->name = $name;      
    }
    
    public function get_value() {
        return $this->value;
    }
    
    public function set_value() {
        $this->value = $value;      
    }

    // Hydrate
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'. ucfirst($key);
            
            // Si le setter correspondant existe :
            if(method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }
}

?>