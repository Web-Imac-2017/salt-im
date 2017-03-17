<?php

class Help Publication {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $publication_id;
    
    // Construction de la classe
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }

    // Set et get des attributs-----------------------
    // Getter id
    public function get_id() {
        return $this->id;
    }

    // Getter user
    public function get_publication_id() {
        return $this->publication_id;
    }
    
    // Setter id
    public function set_id($id) {
        $this->id = $id;      
    }
    
    // Setter user
    public function set_publication_id($user_id) {
        $this->publication_id = $publication_id;      
    }
    // Fin du multiplier--------------------------------

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