<?php

class Stat {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $name;
    private $value;
    private $related_element_id;
    private $related_element_type;
    
    // Construction de la classe
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    // Setters and getters
    public function get_id() {
        return $this->id;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function set_name($name) {
        $this->name = $name;      
    }
    
    public function get_value() {
        return $this->value;
    }
    
    public function set_value($value) {
        $this->value = $value;      
    }
    
    public function get_related_element_id() {
        return $this->related_element_id;
    }
    
    public function set_related_element_id($related_element_id) {
        $this->related_element_id = $related_element_id;      
    }

    public function get_related_element_type() {
        return $this->related_element_type;
    }
    
    public function set_related_element_type($related_element_type) {
        $this->related_element_type = $related_element_type;      
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