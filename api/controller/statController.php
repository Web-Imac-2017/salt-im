<?php

/*require_once "Stat.php";*/
require_once "StatsManager.php";

class statController  {
    
    private $id;
    private $name;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new statController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $stat = $manager->get($id);
        $json = json_encode($this->jsonSerialize($stat));
        echo $json;
    }

    public function getStatPost() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $stat = $manager->getStatPost($id);
        $json = json_encode($this->jsonSerializeArray($stat));
        echo $json;
    }

    public function hasVoted() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $name = $this->name;
        $vote = $manager->hasVoted($id, $name);
    }

    public function voteStatus() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $status = $manager->voteStatus($id);
        $json = json_encode($status);
        echo $json;
    }
    
    public function getStatUser() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $stat = $manager->getStatUser($id);
        $json = json_encode($this->jsonSerializeArray($stat));
        echo $json;
    }

    public function upVote() {
        include "connect.php";
        $manager = new StatsManager($db);
        $id = $this->id;
        $name = $this->name;
        $stat = $manager->upVote($id, $name);
    }
    
    public function set_id($id) {
        $this->id = $id; 
    }
    
    public function get_id() {
        return $this->id; 
    }

    public function set_name($name) {
        $this->name = $name; 
    }
    
    public function get_name() {
        return $this->name; 
    }
    
    public function jsonSerialize(Stat $stat) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'id' => utf8_encode($stat->get_id()),
            'name' => utf8_encode($stat->get_name()),
            'value' => utf8_encode($stat->get_value())
        );
        // in the way you want it arranged in your API
        return $data;
    }

    public function jsonSerializeArray(array $stat) {
        // Represent your object using a nested array or stdClass,
        $data = [];
        for($i=0; $i<count($stat); $i++) {
                $c = array(
                    'id' => utf8_encode($stat[$i]->get_id()),
                    'name' => utf8_encode($stat[$i]->get_name()),
                    'value' => utf8_encode($stat[$i]->get_value())
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