<?php
class UsersManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(User $user)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO user("", mail, username, password, avatar, birthDate, rank, signupDate) VALUES(:mail, :username, :password, :avatar, :birthDate, :rank, :signupDate)');
    
    // Assignation des valeurs du user.
    $q->bindValue(':mail', $user->get_mail());
    $q->bindValue(':username', $user->get_username());
    $q->bindValue(':password', $user->get_password());
    $q->bindValue(':avatar', $user->get_avatar());
    $q->bindValue(':birthDate', $user->get_birthDate());
    $q->bindValue(':rank', $user->get_rank());
    $q->bindValue(':signupDate', $user->get_signupDate());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(User $user)
  {
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
    $q = $this->_db->prepare('UPDATE user SET mail = :mail, username = :username, password = :password, avatar = :avatar, birthDate = :birthDate, rank = :rank, signupDate = :signupDate WHERE id = :id');

    // Assignation des valeurs à la requête.
    $q->bindValue(':id', $user->get_id(), PDO::PARAM_INT);
    $q->bindValue(':mail', $user->get_mail());
    $q->bindValue(':username', $user->get_username());
    $q->bindValue(':password', $user->get_password());
    $q->bindValue(':avatar', $user->get_avatar());
    $q->bindValue(':birthDate', $user->get_birthDate());
    $q->bindValue(':rank', $user->get_rank());
    $q->bindValue(':signupDate', $user->get_signupDate());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}