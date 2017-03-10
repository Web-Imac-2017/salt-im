<?php
if(!class_exists('Media')) {
    class Media {

        /* MEDIA
        id :                int
        link :              lien html renvoyant vers un media img/video
        type :              type de media img/video
        publication_id :    id de la publication à laquelle le media est rattaché
        */

        // Ligne à multiplier selon le nombre d'attributs
        private $id;
        private $link;
        private $type;
        private $publication_id;
        
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
        
        public function get_link() {
            return $this->link;
        }
        
        public function set_link($link) {
            $this->link = $link;      
        }
        
        public function get_type() {
            return $this->type;
        }
        
        public function set_type($type) {
            $this->type = $type;      
        }


        public function get_publication_id() {
            return $this->publication_id;
        }
        
        public function set_publication_id($publication_id) {
            $this->publication_id = $publication_id;
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
};

?>
