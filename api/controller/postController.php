<?php

require "Publication.php";

require "Subject.php";

require "SubjectsManager.php";

class postController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new postController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $id = $this->id;
        if($manager->get($id) != null) {
            $subject = $manager->get($id);
            $json = json_encode($this->jsonSerialize($subject), JSON_UNESCAPED_UNICODE);
            echo $json;
        } else {
            echo "aie aie aie on n'a pas pu récupérer le post";
        }
    }
    
    public function add() {
        include "connect.php";
        echo "add";
        $manager = new SubjectsManager($db);
        $subject = new Subject($_POST);
        try {
            $manager->add($subject);
            echo "Le message a bien été envoyé !";
        }
        catch(Exception $e) {
            echo "Oops le post n'a pas pu être envoyé : " . $e->getMessage();
        }
    }
    
    public function remove() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $id = $this->id;
        $subject = $manager->get($id);
        try {
            $manager->delete($subject);
            echo "Le fichier a été supprimé.";
        } catch(Exception $e) {
            echo "Oops le post n'a pas pu être supprimé : " . $e->getMessage(); 
        }
        
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }
    
    public function help($type) {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $subject = $manager->get_help($id);
        $json = json_encode($this->jsonSerialize($subject), JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function jsonSerialize(Subject $subject) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'id' => utf8_encode($subject->get_id()),
            'title' => utf8_encode($subject->get_title()),
            'flair' => utf8_encode($subject->get_flair()),
            'type' => utf8_encode($subject->get_type()),
            'text' => utf8_encode($subject->get_text()),
            'date' => utf8_encode($subject->get_date()),
            'user_id' => utf8_encode($subject->get_user_id()),
            'media_id' => utf8_encode($subject->get_media_id())
        );
        var_dump($subject->get_media_id());
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