<?php

require_once "TagsManager.php";

//require_once "Tag.php";

class tagController {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new tagController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new TagsManager($db);
        $tags = $manager->getList();
        $json = json_encode($this->jsonSerializeArray($tags),JSON_UNESCAPED_UNICODE);
        echo $json;
    }
    
    public function add() {
        include "connect.php";
        $manager = new TagsManager($db);
        $tag = new Tag($_POST);
        try {
            $manager->add($tag);
            echo "Le tag a bien été envoyé !";
        }
        catch(Exception $e) {
            echo "Oops le tag n'a pas pu être envoyé : " . $e->getMessage();
        }
        
    }
    
    public function img() {
        include "connect.php";
        $manager = new TagsManager($db);
        $id = $this->id;
        $tag = $manager->get($id);
        $manager->img($tag, $_FILES);
    }

        public function search_tag() {
        include "connect.php";
        $manager = new TagsManager($db);
        if (!isset($_POST['searchTag']))
            echo "Please provide keywords";
        else {
            $tag = $manager->search_tag($_POST['searchTag']);
            $json = json_encode($this->jsonSerializeArray($tag), JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }
    
    public function jsonSerializeArray(array $tags) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        for($i=0; $i<count($tags); $i++) {
                $c = array(
                    'id' => utf8_encode($stat[$i]->get_id()),
                    'name' => utf8_encode($tags[$i]->get_name()),
                    'img_url' => utf8_encode($tags[$i]->get_img_url()),
                    'description' => utf8_encode($tags[$i]->get_description())
                );
                $data[] = $c;
        }
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