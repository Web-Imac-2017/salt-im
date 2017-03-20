<?php

class Tags {

    /* TAG
    id :        int
    name :      nom du tag
    */

    // Ligne à multiplier selon le nombre d'attributs
    private $id;
    private $name;
    private $img_url;
    private $description;

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

    public function get_img_url() {
        return $this->img_url;
    }

    public function set_img_url($img_url) {
        $this->img_url = $img_url;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
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
