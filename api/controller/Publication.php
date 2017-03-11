<?php

    /* PUBLICATION
    id :        int
    text :      texte brut quelconque
    date :      date de type date
    user_id :   int correspond à l'id de l'user ayant posté la publication
    */


abstract class Publication {
    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $text;
    private $date;
    private $user_id;
    private $media_id;
    
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
    
    public function get_text() {
        return $this->text;
    }
    
    public function set_text($text) {
        $this->text = $text;      
    }
    
    public function get_date() {
        return $this->date;
    }
    
    public function set_date($date) {
        $this->date = $date;      
    }

    // Getter user id
    public function get_user_id() {
        return $this->user_id;
    }
    
    // Setter user id
    public function set_user_id($user_id) {
        $this->user_id = $user_id;      
    }

    // Getter media_id
    public function get_media_id(){
        return $this->media_id;
    }

    // Setter media_id
    public function set_media_id($media_id) {
        $this->media_id = $media_id;      
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
