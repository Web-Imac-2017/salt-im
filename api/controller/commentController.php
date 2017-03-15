<?php

require_once "Publication.php";
//require_once "Comment.php";
require_once "CommentsManager.php";

class commentController  {
    
    private $id;
    private $order;
    
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
        $json = json_encode($this->jsonSerialize($comment), JSON_UNESCAPED_UNICODE);
        echo $json;
    }
    
    public function add() {
        include "connect.php";
        $id = $this->id;
        $manager = new CommentsManager($db);
        $comment = new Comment($_POST);
        try {
            $manager->add($comment, $id);
            echo "Le commentaire a bien été ajouté.";
        } catch(Exception $e) {
            echo "Oops le commentaire n'a pas pu être envoyé : " . $e->getMessage();
        }
    }
    
    public function addToComment() {
        include "connect.php";
        $id = $this->id;
        $manager = new CommentsManager($db);
        $comment = new Comment($_POST);
        try {
            $manager->addToComment($comment, $id);
            echo "Le commentaire a bien été ajouté.";
        } catch(Exception $e) {
            echo "Oops le commentaire n'a pas pu être envoyé : " . $e->getMessage();
        }
    }
    
    public function commentsFromPost() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $id = $this->id;
        $order = $this->order;
        $comments = $manager->getAllCommentsFromPost($id, $order);
        if($comments != null && $comments != false) {
            $json = json_encode($this->jsonSerializeComplexArray($comments), JSON_UNESCAPED_UNICODE);
            echo $json;
        } else {
            echo "Les commentaires n'ont pas pu être récupérés.";
        }
        
    }
    
    public function commentsFromPostDefault() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $id = $this->id;
        $comments = $manager->getAllCommentsFromPost($id, 'date');
        $json = json_encode($this->jsonSerializeComplexArray($comments), JSON_UNESCAPED_UNICODE);
        echo $json;
    }
    
    public function commentFromUser() {
        include "connect.php";
        $manager = new CommentsManager($db);
        $id = $this->id;
        $comments = $manager->commentFromUser($id);
        $json = json_encode($this->jsonSerializeArray($comments), JSON_UNESCAPED_UNICODE);
        echo $json;
        
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }
    
    public function set_order($order) {
        $this->order = $order; 
    }
    
    public function get_order() {
        return $this->order; 
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
    
    public function jsonSerializeComplexArray(array $comments) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        $pack = [];
        for($i=0; $i<count($comments); $i++) {
                $c = array(
                    'text' => utf8_encode($comments[$i][0]->get_text()),
                    'date' => utf8_encode($comments[$i][0]->get_date()),
                    'user_id' => utf8_encode($comments[$i][0]->get_user_id())
                );
                $pack[] = $c;
                if($comments[$i][1] != null) {
                    $answers = $this->jsonSerializeComplexArray($comments[$i][1]);
                $pack[] = $answers;
                }
            $data[] = $pack;
            $pack = null;
        }
        // in the way you want it arranged in your API
        return $data;
    }
    
    public function sortByOrder(array $comments, $order) {
        if ($order == "date") {
            foreach ($comments as $key => $row) {
                $date[$key] = $row[0]['date'];
            }
            array_multisort($date, SORT_ASC, $comments); 
            
        } else if ($order == "sel") {
            foreach ($comments as $key => $row) {
                $sel[$key] = $row['0'];
            }
            array_multisort($date, SORT_ASC, $comments);
            
        } else if ($order == "poivre") {
            foreach ($comments as $key => $row) {
                $poivre[$key] = $row['1'];
            }
            array_multisort($date, SORT_ASC, $comments); 
            
        } else if ($order == "humour") {
            foreach ($comments as $key => $row) {
                $humour[$key] = $row['2'];
            }
            array_multisort($date, SORT_ASC, $comments); 
        }
        return $comments;
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