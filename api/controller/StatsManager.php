<?php
class StatsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Stat $stat)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO stat(name, value) VALUES("'.$stat->get_name().'", "'.$stat->get_value().'")');

    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Stat $stat)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM stat WHERE id = "'.$stat->get_id()."'");
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet stat.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, name, value FROM stat WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Stat($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les stats.
    $stats = [];

    $q = $this->_db->query('SELECT id, name, value FROM stat ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }

    return $stats;
  }

  public function getStatPost($id)
  {
    // Retourne les 3 stats d'un post
    $stats = [];
    $q = $this->_db->query('SELECT name, value FROM stat
      WHERE related_publication_id = "'.$id.'"');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }

    return $stats;
  }

  public function getStatUser($id)
  {
    // Retourne les 3 stats d'un post
    $stats = [];
    $q = $this->_db->query('SELECT name, value FROM stat
      WHERE related_user_id = "'.$id.'"');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }
    return $stats;
  }

  public function hasVoted($id, $name)
  {
    $q = $this->_db->query('SELECT user_id FROM vote
      WHERE publication_id = "'.$id.'"
      AND name = "'.$name.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    if ($donnees != NULL) {
      // alors il a déjà voté
      return 1;
    } else return 0;
  }

  public function voteStatus($id)
  {
    $status = [];
    for ($i = 0; $i <= 2; $i++) {
      $status[$i] = $this->hasVoted($id, $i);
    }
    return $status;
  }

  public function upVote($id, $name) // $id de la publication, $name de la stat
  {
    if ($this->hasVoted($id, $name)) {
      return false; // l'user a déjà voté sur cette stat
    }
    else {
      // update les stats de la publication
      $q1 = $this->_db->prepare('UPDATE stat SET value = value+1
        WHERE related_publication_id = "'.$id.'"
        AND name = "'.$name.'"');

      // récupérer l'auteur de la publication
      $q2 = $this->_db->query('SELECT user_id FROM publication WHERE id = "'.$id.'"');
      $donnees[] = $q2->fetch(PDO::FETCH_ASSOC);
      $user_manager = new UsersManager($this->_db);
      $user = $user_manager->get($donnees['user_id']);
      
      // update les stats de l'auteur
      $q3 = $this->_db->prepare('UPDATE stat SET value = value+1
        WHERE related_user_id = "'.$user.'"
        AND name = "'.$name.'"');

      // change la table vote

      $q1->execute();
      $q2->execute();
      $q3->execute();
      return true;
    }
  }

  public function cancelVote($id, $name)
  {
    $q1 = $this->_db->prepare('UPDATE stat SET value = value-1
      WHERE related_publication_id = "'.$id.'"
      AND name = "'.$name.'"');

    $q2 = $this->_db->query('SELECT user_id FROM publication WHERE id = "'.$id.'"');
    $donnees = $q2->fetch(PDO::FETCH_ASSOC);
    $user_manager = new UsersManager($this->_db);
    $user = $donnees->get($donnees['user_id']);
    
    $q3 = $this->_db->prepare('UPDATE stat SET value = value-1
      WHERE related_user_id = "'.$user.'"
      AND name = "'.$name.'"');

    $q1->execute();
    $q2->execute();
    $q3->execute();
  }

  public function update(Stat $stat)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE stat SET name = "'.$stat->get_name().'", value = "'.$stat->get_value().'" WHERE id = "'.$stat->get_id().'"');

    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
