<?php
class UsersManager {
  private $_db; // Instance de PDO.
  public function __construct($db)
  {
    $this->setDb($db);
  }
    
    
  public function getDb() {
        return $this->_db;
    }
    
  public function add(User $user) {
    // Préparation de la requête 
      
    $pass_hache = sha1('gz'.$user->get_password());
      
    $this->_db->exec('INSERT INTO user(mail, username, password, avatar, birthDate, rank, signupDate, badge_id) VALUES("'.$user->get_mail().'", "'.$user->get_username().'", "'.$pass_hache.'", "'.$user->get_avatar().'", "'.$user->get_birthDate().'", "0", "'.date("Y-m-d H:i:s").'", "0")');
    $user_id = $this->_db->lastInsertId();
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("0", "0", "'.$user_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("1", "0", "'.$user_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("2", "0", "'.$user_id.'")'); 
      
  }
  public function delete(User $user) {
    // Exécute une requête de type DELETE.
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$user->get_id().'"');
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->get_id());
  }
 
   public function get($id)
   {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet User.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, mail, username, password, avatar, birthDate, rank, signupDate FROM user WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new User($donnees);
  }


  public function getStat(User $user) {
    $stats = [];
     
    $q = $this->_db->query('SELECT * FROM stat WHERE related_element_id = "'.$user->get_id().'"');
      
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
   {
      $stats[] = new Stat($donnees);
    }

    return $stats;
}

public function getSubjects(User $user) {
    $subject_id_array = [];
    $subjects = [];
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag_id.'"');
    $q = $this->_db->query('SELECT id FROM publication WHERE user_id = AND ');
        
    // On a récupéré les ids des publications ayant le tag précisé
      for($i=0; $row = $q->fetch(); $i++){
        $subject_id_array[] = $row['id'];
      }
    
   // Il faut récupérer les subjects correspondant aux ids
    for($i=0; count($subject_id_array); $i++) {
        $q = $this->_db->query('SELECT * FROM subject WHERE id = "'.$subject_id_array[$i].'"');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $subjects[] = new Subject($donnees);
        }
    }    

    return $subjects;
  }


  public function getList()
  {
    // Retourne la liste de tous les users.
    $users = [];

    $q = $this->_db->query('SELECT mail, username, password, avatar, birthDate, rank, signupDate, badge_id FROM user ORDER BY id');


    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new User($donnees);
    }

    return $users;

   }
 
   public function update(User $user, $id)
   {
       
     $pass_hache = sha1('gz'.$user->get_password());
     // Prépare une requête de type UPDATE.
     $q = $this->_db->prepare('UPDATE user SET mail = "'.$user->get_mail().'", username = "'.$user->get_username().'", password = "'.$pass_hache.'", avatar = "'.$user->get_avatar().'", birthDate = "'.$user->get_birthDate().'", rank = "'.$user->get_rank().'" WHERE id = "'.$id.'"');
     
     // Exécution de la requête.
     $q->execute();
   }
    
    
 
   public function setDb(PDO $db)
   {
     $this->_db = $db;
   }
    
}

