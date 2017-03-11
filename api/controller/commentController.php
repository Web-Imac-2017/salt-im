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
        $comments = $manager->getAllCommentsFromPost($id);
        $json = json_encode($this->jsonSerializeArray($comments), JSON_UNESCAPED_UNICODE);
        $order = $this->order;
        $comments = $manager->getAllCommentsFromPost($id);
        $json = json_encode($this->sortByOrder($this->jsonSerializeArray($comments), $order), JSON_UNESCAPED_UNICODE);
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
            'user_id' => utf8_encode($comment->get_user_id()),
            'media_id' => utf8_encode($comment->get_media_id())
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
    
    public function sortByOrder(array $comments, $order) {
        if ($order == "date") {
            foreach ($comments as $key => $row) {
                $date[$key] = $row['date'];
            }
            array_multisort($date, SORT_ASC, $comments); 
            
        } else if ($order == 0) {
            foreach ($comments as $key => $row) {
                $sel[$key] = $row['sel'];
            }
            array_multisort($date, SORT_ASC, $comments);
            
        } else if ($order == 1) {
            foreach ($comments as $key => $row) {
                $poivre[$key] = $row['poivre'];
            }
            array_multisort($date, SORT_ASC, $comments); 
            
        } else if ($order == 2) {
            foreach ($comments as $key => $row) {
                $humour[$key] = $row['humour'];
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