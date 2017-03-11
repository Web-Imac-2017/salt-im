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
    $this->_db->exec('INSERT INTO user(mail, username, password, avatar, birthDate, rank, signupDate, badge_id) VALUES("'.$user->get_mail().'", "'.$user->get_username().'", "'.$user->get_password().'", "'.$user->get_avatar().'", "'.$user->get_birthDate().'", "0", "'.date("Y-m-d H:i:s").'", "0")');
    $publication_id = $this->_db->lastInsertId();
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("0", "0", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("1", "0", "'.$publication_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("2", "0", "'.$publication_id.'")'); 
      
  }
  public function delete(User $user) {
    // Exécute une requête de type DELETE.
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$user->get_id().'"');
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->get_id());
  }
    
  public function get($id) {
    $result = $this->_db->query('SELECT mail, username, password, avatar, birthDate, rank, signupDate, badge_id FROM user WHERE id = "'.$id.'"');
    $donnees = $result->fetch(PDO::FETCH_ASSOC);
      
    $user = new User($donnees);
      
    return $user;
  }
    
  public function getList() {
    // Retourne la liste de tous les subjects.
    $users = [];

    $q = $this->_db->query('SELECT mail, username, password, avatar, birthDate, rank, signupDate, badge_id FROM user ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new User($donnees);
    }

    return $users;
  }
    
  public function update(User $user) {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE user SET mail = "'.$user->get_mail().'", username = "'.$user->get_username().'", password = "'.$user->get_password().'", avatar = "'.$user->get_avatar().'", birthDate = "'.$user->get_birthDate().'", rank = "'.$user->get_rank().'", signupDate = "'.$user->get_signupDate().'" WHERE id = "'.$user->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
    
}