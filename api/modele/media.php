<?php

class media {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $link;
    private $type;
    
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
    
    public function get_link() {
        return $this->text;
    }
    
    public function set_link() {
         $this->link = $link;      
    }
    
    public function get_type() {
        return $this->type;
    }
    
    public function set_type() {
         $this->type = $type;      
    }

// Hydrate
public function hydrate(array $donnees) {
    foreach ($donnees as $key => $value) {
        // On récupère le nom du setter correspondant à l'attribut
        $method = 'set'. ucfirst($key);
        
        //Si le setter correspondant exite :
        if(method_exists($this, $method)) {
            // On appelle le setter
            $this->$method($value);
        }
}
}
    
}

?>