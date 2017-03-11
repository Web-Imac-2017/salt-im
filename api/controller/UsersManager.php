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
    
      
  }

  public function delete(User $user) {
    
  }

  public function get($id)
  {
    
  }

  public function update(User $user)
  {
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