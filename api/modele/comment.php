<?php

class Comment {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $text;
    private $date;
  
    
    
   // Construction de la classe
   public function __construct(array $donnees) {

       return $this->hydrate($donnees);
   }

    // Set et get des attributs-----------------------
    // A multiplier selon le nombre d'attributs
    public function get_id() {
    return $this->id;
    }
    
    public function set_id() {
         $this->id = $id;      
    }

    public function get_cond() {
    return $this->text;
    }
    
    public function set_cond() {
         $this->text= $text;      
    }

    public function get_name() {
    return $this->date;
    }
    
    public function set_name() {
         $this->date = $date;      
    }

   
    // Fin du multiplier--------------------------------

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