<?php

class user {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $mail;
    private $username;
    private $password;
    private $avatar;
    private $birthDate;
    private $rank;
    private signupDate;
    
   // Construction de la classe
   public function __construct(array $donnees) {
       return $this->hydrate($donnees);
   }

    // Set et get des attributs-----------------------
    // A multiplier selon le nombre d'attributs
    public function get_nom_attribut() {
    return $this->nom_attribut();
    }
    
    public function set_nom_attribut() {
         $this->nom_attribut = $nom_attribut;      
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