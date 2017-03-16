<?php

require_once "SubjectsManager.php";

require_once "Subject.php";

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
            $tag = $manager->add($tag);
            echo "Le tag a bien été envoyé !";
            $json = json_encode($this->jsonSerialize($tag),JSON_UNESCAPED_UNICODE);
            echo $json;
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
    
    public function jsonSerialize($tag) {
        // Represent your object using a nested array or stdClass,
                $c = array(
                    'id' => utf8_encode($tag->get_id()),
                    'name' => utf8_encode($tag->get_name()),
                    'img_url' => utf8_encode($tag->get_img_url()),
                    'description' => utf8_encode($tag->get_description())

                );
        // in the way you want it arranged in your API
        return $c;
    }

    public function jsonSerializeArray(array $tags) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        for($i=0; $i<count($tags); $i++) {
                $c = array(
                    'id' => utf8_encode($tags[$i]->get_id()),
                    'name' => utf8_encode($tags[$i]->get_name()),
                    'img_url' => utf8_encode($tags[$i]->get_img_url()),
                    'description' => utf8_encode($tags[$i]->get_description())
                );
                $data[] = $c;
        }
        // in the way you want it arranged in your API
        return $data;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function tag_by_id() {
    include "connect.php";
    $manager = new TagsManager($db);
    $id = $this->id;
    if($manager->get($id) != null) {
        $tag = $manager->get($id);
        $json = json_encode($this->jsonSerialize($tag),JSON_UNESCAPED_UNICODE);
        echo $json;
    } else {
         echo "Aie aie aie on a pas pu récupérer le tag.";
        }
    }
    
    public function tag_from_post() {
        include "connect.php";
        $manager = new TagsManager($db);
        $s_manager = new SubjectsManager($db);
        $id = $this->id;
        $subject = $s_manager->get($id);
        if($subject != null) {
            try {
            $tags = $manager->tag_from_post($subject);
            if($tags != false) {
                $json = json_encode($this->jsonSerializeArray($tags), JSON_UNESCAPED_UNICODE);
                echo $json;
            }
            else {
                echo "Ce post n'a pas de tags associés";
            }
        }
        catch(Exception $e) {
            echo "Les tags n'ont pas pu être récupérés : " . $e->getMessage();
        }
        } else {
            echo "pas de subject.";
        }
        
        
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

    public function search_tags() {
        include "connect.php";
        $manager = new TagsManager($db);
        if (!isset($_POST['search']))
            echo "Please provide keywords";
        else {
            $subject = $manager->search_tags($_POST['search']);
            $json = json_encode($this->jsonSerializeArray($subject), JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }
}

?>
