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
    $q = $this->_db->prepare('INSERT INTO user(mail, username, password, avatar, birthDate, rank, signupDate) VALUES("'.$user->get_mail().'", "'.$user->get_username().'", "'.$user->get_password().'", "'.$user->get_avatar().'", "'.$user->get_birthDate().'", "'.$user->get_rank().'", "'.$user->get_signupDate().'")');
      
    // Exécution de la requête.
      var_dump($q);
    $q->execute();
      
  }

  public function delete(User $user) {
    // Exécute une requête de type DELETE.
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

  public function getList()
  {
    // Retourne la liste de tous les users.
    $users = [];

    $q = $this->_db->query('SELECT id, mail, username, password, avatar, birthDate, rank, signupDate FROM user ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new User($donnees);
    }

    return $users;
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