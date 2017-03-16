<?php

require_once "Publication.php";

require_once "Subject.php";

require_once "SubjectsManager.php";

require_once "TagsManager.php";

require_once "Tag.php";

require_once "Media.php";

require_once "MediasManager.php";

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
            $json = json_encode($this->jsonSerialize($subject),JSON_UNESCAPED_UNICODE);
            echo $json;
        } else {
            echo "Aie aie aie on a pas pu récupérer le post.";
        }
    }

    public function getFromTags() {
        include "connect.php";
        $manager = new TagsManager($db);
        $tags = [];
        $subjects = [];
        for ($i=0; count($_POST['tag']); $i++) {
            $tag = $manager->getFromName($_POST['tag'][$i]);
            if($tag == false) {
                $tag_insert = new Tag(array(
                    "name" => $_POST['tag'][$i],
                    "img_url" => "",
                    "description" => ""
                ));
                $manager->add($tag_insert);
                $tag = $tag_insert;
            }
            $tags[] = $tag;
        }
        $subjects = $manager->getSubjectsManyTags($tags);
        if($subjects != null) {
            $json = json_encode($this->jsonSerializeArray($subjects),JSON_UNESCAPED_UNICODE);
            echo $json;
        } else {
            echo "On dirait qu'il n'y a pas de posts associés à ces tags. RT si c'est triste.";
        }
    }

    public function add() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $tagmanager = new TagsManager($db);
        $subject = new Subject($_POST);
        $tag_names = explode(',', $_POST['tags']);
        $tag_ids = [];
        for($i=0; $i<count($tag_names); $i++) {
            $tag = $tagmanager->getFromName($tag_names[$i]);
            if ($tag == null || $tag == false) {
                $tag = new Tag(array(
                    'name' => $tag_names[$i],
                    'img_url' => '',
                    'description' => ''
                ));
                $tag_ids[] = $tagmanager->add($tag);
            } else {
                $tag_ids[] = $tag->get_id();
            }
        }
        try {
            $subject = $manager->add($subject);
            for($i=0; $i<count($tag_ids); $i++) {
                $tagmanager->addTagToPost($tag_ids[$i], $subject->get_id());
            }
            // Ajout du media
            $media_manager = new MediasManager($db);
            $media = new Media(array(
                "publication_id" => $subject->get_id()
            ));
            $id_media = $media_manager->add($media);
            $media->set_id($id_media);
            $media_manager->img($media, $_FILES);
            
            $json = json_encode($this->jsonSerialize($subject),JSON_UNESCAPED_UNICODE);
            echo $json;
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

    public function postFromUser() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $id = $this->id;
        $subjects = $manager->postFromUser($id);
        $json = json_encode($this->jsonSerializeArray($subjects), JSON_UNESCAPED_UNICODE);
        echo $json;

    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }



    public function help() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $subject = $manager->get_help();
        $json = json_encode($this->jsonSerializeArray($subject), JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    public function search_title() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        if (!isset($_POST['search']))
            echo "Please provide keywords";
        else {
            $subject = $manager->search_title($_POST['search']);
            $json = json_encode($this->jsonSerializeArray($subject), JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }

    public function sortPostsByStat(){
        include "connect.php";
        $sort = $this->id;
        $manager = new SubjectsManager($db);
        $subject = $manager->sortPostsByStat($sort);
        $json = json_encode($this->jsonSerializeArray($subject), JSON_UNESCAPED_UNICODE);
        echo $json;
    }
    
    public function sort_date() {
        include "connect.php";
        $manager = new SubjectsManager($db);
        $subject = $manager->sort_date();
        $json = json_encode($this->jsonSerializeArray($subject), JSON_UNESCAPED_UNICODE);
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
        // in the way you want it arranged in your API
        return $data;
    }


    public function jsonSerializeArray(array $subjects) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        for($i=0; $i<count($subjects); $i++) {
                $c = array(
                    'id' => utf8_encode($subjects[$i]->get_id()),
                    'title' => utf8_encode($subjects[$i]->get_title()),
                    'flair' => utf8_encode($subjects[$i]->get_flair()),
                    'type' => utf8_encode($subjects[$i]->get_type()),
                    'text' => utf8_encode($subjects[$i]->get_text()),
                    'date' => utf8_encode($subjects[$i]->get_date()),
                    'user_id' => utf8_encode($subjects[$i]->get_user_id()),
                    'media_id' => utf8_encode($subjects[$i]->get_media_id()),
                    'publication_id' => utf8_encode($subjects[$i]->get_publication_id())
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
