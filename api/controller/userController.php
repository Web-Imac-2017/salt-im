<?php

//require_once "User.php";

require_once "UsersManager.php";

class userController  {
    
    private $id;
    
    public static function getInstance(array $donnees)
    {
        if (!isset(self::$instance))
            self::$instance = new userController($donnees);
        return self::$instance;
    }
    
    public function __construct(array $donnees) {
        return $this->hydrate($donnees);
    }
    
    public function index() {
        include "connect.php";
        $manager = new UsersManager($db);
        $id = $this->id;
        $user = $manager->get($id);
        $json = json_encode($this->jsonSerialize($user), JSON_UNESCAPED_UNICODE);
        echo($json);
    }
    
    public function signup() {
        include "connect.php";
        $manager = new UsersManager($db);
        $user = new User($_POST);
        try {
            $session = $manager->add($user);
            echo "L'utilisateur a bien été ajouté.";
            echo($session);
        } catch(Exception $e) {
            echo "Oops l'utilisateur n'a pas pu être envoyé : " . $e->getMessage();
        }
    }
    
    public function signout() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->signout();
    }
    
    public function login() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->login($_POST);
    }
    
    public function logout() {
        include "connect.php";
        $manager = new UsersManager($db);
        $manager->logout();
    }
    
    public function name() {
        include "connect.php";
        $manager = new UsersManager($db);
        $id = $this->id;
        $user = $manager->get($id);
        $json = json_encode(utf8_encode($user->get_username()), JSON_UNESCAPED_UNICODE);
        echo($json);
    }
    
    /* **** A L'INTENTION DU FRONT **** */
    /* le formulaire pour envoyer l'avatar doit être sous cette forme */
    /* <!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="api/u/1/avatar" method="post">
  <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
  Envoyez ce fichier : <input name="userfile" type="file" />
  <input type="submit" value="Envoyer le fichier" />
</form> */
    /* MERCI */
    
    public function avatar() {
        include "connect.php";
        $manager = new UsersManager($db);
        $id = $this->id;
        $user = $manager->get($id);
        $manager->avatar($user, $_FILES);
    }
    
    public function update() {
        include "connect.php";
        $manager = new UsersManager($db);
        $id = $this->id;
        $user = new User($_POST);
        $manager->update($user, $id);        
        $json = json_encode(utf8_encode($user->get_username()), JSON_UNESCAPED_UNICODE);
        echo($json);
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_id($id) {
        $this->id = $id;      
    }
    
    public function jsonSerialize(User $user) {
        // Represent your object using a nested array or stdClass,
        $data = array(
            'mail' => utf8_encode($user->get_mail()),
            'username' => utf8_encode($user->get_username()),
            'avatar' => utf8_encode($user->get_avatar()),
            'birthDate' => utf8_encode($user->get_birthDate()),
            'rank' => utf8_encode($user->get_rank()),
            'signupDate' => utf8_encode($user->get_signupDate()),
            'badge_id' => utf8_encode($user->get_badge_id())
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