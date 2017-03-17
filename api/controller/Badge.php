<?php

class Badge {

    /* BADGE
    id :        int
    cond :      score minimum pour obtenir un badge
    name :      texte brut pouvant prendre les valeurs suivantes
                                                Beurre doux
                                                Demi-sel
                                                La Baleine
                                                Morue
                                                Saumure
                                                Mer Morte
                                                Hypertension artérielle
    icon :      texte sous forme de lien html vers une image
    */


    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $cond;
    private $name;
    private $icon;
    
    
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

    public function get_cond() {
        return $this->cond;
    }
    
    public function set_cond($cond) {
        $this->cond = $cond;      
    }

    public function get_name() {
        return $this->name;
    }
    
    public function set_name($name) {
        $this->name = $name;      
    }

    public function get_icon() {
        return $this->icon;
    }
    
    public function set_icon($icon) {
        $this->icon = $icon;      
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
