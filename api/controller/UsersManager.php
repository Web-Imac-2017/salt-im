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
<<<<<<< HEAD
    // Préparation de la requête 
    $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$user->get_text().'", "'.$user->get_date().'", "'.$user->get_user_id().'")');
    $publication_id = $this->_db->lastInsertId();
      
    // Exécution de la requête.
      var_dump($q);
    $q->execute();
=======
    
>>>>>>> 278d345974fb044e9955740855f603a65c0927bf
      
  }

  public function delete(User $user) {
<<<<<<< HEAD
    // Exécute une requête de type DELETE.
    $result = $this->_db->query('SELECT publication_id FROM user WHERE id = "'.$user->get_id().'")');
    $publication_id = $result->fetch(PDO::FETCH_ASSOC);
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->get_id());
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id['publication_id'].'"');
=======
    
>>>>>>> 278d345974fb044e9955740855f603a65c0927bf
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