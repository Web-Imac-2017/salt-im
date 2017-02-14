<?php
class BadgesManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Badge $badge)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO badge(cond, name, icon) VALUES(:cond, :name, :icon)');
    
    // Assignation des valeurs du badge.
    $q->bindValue(':cond', $badge->get_cond());
    $q->bindValue(':name', $badge->get_name());
    $q->bindValue(':icon', $badge->get_icon());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Badge $badge)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM badge WHERE id = '.$badge->get_id());
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet badge.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, cond, name, icon FROM badge WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Badge($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les badges.
    $badges = [];

    $q = $this->_db->query('SELECT id, cond, name, icon FROM badge ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $badges[] = new Badge($donnees);
    }

    return $badges;
  }

  public function update(Badge $badge)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE badge SET cond = :cond, name = :name, icon = :icon WHERE id = :id');

    // Assignation des valeurs à la requête.
    $q->bindValue(':cond', $badge->get_cond());
    $q->bindValue(':name', $badge->get_name());
    $q->bindValue(':icon', $badge->get_icon());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}