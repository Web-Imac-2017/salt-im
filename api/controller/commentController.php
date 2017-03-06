<?php

require "Publication.php";

require "Comment.php";

require "CommentsManager.php";

class commentController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new commentController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $id = $this->id;
        $comment = $manager->get($id);
        $json = json_encode($this->jsonSerialize($comment));
        echo $json;
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }
    
    public function jsonSerialize(Comment $comment) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'text' => utf8_encode($comm->get_text()),
            'date' => utf8_encode($comm->get_date()),
            'user_id' => utf8_encode($comm->get_user_id())
        );
        // in the way you want it arranged in your API
        return $data;
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