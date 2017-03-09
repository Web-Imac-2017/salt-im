<?php

require_once "Publication.php";
//require_once "Comment.php";
require_once "CommentsManager.php";

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
    
    public function add() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $comment = new Comment($_POST);
        try {
            $manager->add($comment);
            echo "Le commentaire a bien été ajouté.";
        } catch(Exception $e) {
            echo "Oops le commentaire n'a pas pu être envoyé : " . $e->getMessage();
        }
        
    }
    
    public function commentsFromPost() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $id = $this->id;
        $comments = $manager->getCommentsFromPost($id);
        $json = json_encode($this->jsonSerializeArray($comments));
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
            'text' => utf8_encode($comment->get_text()),
            'date' => utf8_encode($comment->get_date()),
            'user_id' => utf8_encode($comment->get_user_id())
        );
        // in the way you want it arranged in your API
        return $data;
    }
    
    public function jsonSerializeArray(array $comments) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        for($i=0; $i<count($comments); $i++) {
                $c = array(
                    'text' => utf8_encode($comments[$i]->get_text()),
                    'date' => utf8_encode($comments[$i]->get_date()),
                    'user_id' => utf8_encode($comments[$i]->get_user_id())
                );
                $data[] = $c;
        }
        // in the way you want it arranged in your API
        return $data;
    }
    
    public function jsonSerializeArray2(array $comments) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        $c_array = [];
        for($i=0; $i<count($comments); $i++) {
                $c = array(
                    'text' => utf8_encode($comments[$i][0]->get_text()),
                    'date' => utf8_encode($comments[$i][0]->get_date()),
                    'user_id' => utf8_encode($comments[$i][0]->get_user_id())
                );
                $c_array[] = $c;
                if($comments[$i][1] != NULL) {
                    for($j=0; $j<count($comments[$i][1]); $j++) {
                        
                    }
                }
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