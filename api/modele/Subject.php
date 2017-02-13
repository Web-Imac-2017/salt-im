<?php

class Subject extends Publication {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $title;
    private $flair;
    private $type;
    
    // Construction de la classe
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }

    // Set et get des attributs-----------------------
    // Getter id
    public function get_id() {
        return $this->id;
    }

    // Getter title
    public function get_title() {
        return $this->title;
    }

    // Getter flair
    public function get_flair() {
        return $this->flair;
    }

    // Getter type
    public function get_type() {
        return $this->type;
    }
    
    // Setter id
    public function set_id() {
        $this->id = $id;      
    }

    // Setter title
    public function set_title() {
        $this->title = $title;      
    }

    // Setter flair
    public function set_flair() {
        $this->flair = $flair;      
    }

    // Setter type
    public function set_type() {
        $this->type = $type;      
    }
    // Fin du multiplier--------------------------------

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
