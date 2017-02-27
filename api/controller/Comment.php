<?php

class Comment extends Publication {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $related_publication_id;
    
    // Construction de la classe
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }

    // Set et get des attributs-----------------------
    // A multiplier selon le nombre d'attributs
    public function get_id() {
        return $this->id;
    }
    
    public function set_id($id) {
        $this->id = $id;      
    }

    public function get_related_publication_id() {
        return $this->related_publication_id;
    }
    
    public function set_related_publication_id($related_publication_id) {
        $this->related_publication_id = $related_publication_id;      
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
