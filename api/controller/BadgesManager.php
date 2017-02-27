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
    $q = $this->_db->prepare('INSERT INTO badge(cond, name, icon) VALUES("'.$badge->get_cond().'", "'.$badge->get_name().'", "'.$badge->get_icon().'")');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Badge $badge)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM badge WHERE id = "'.$badge->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet badge.
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM badge WHERE id = "'.$id.'"');
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
    $q = $this->_db->prepare('UPDATE badge SET cond = "'.$badge->get_cond().'", name = "'.$badge->get_name().'", icon = "'.$badge->get_icon().'" WHERE id = "'.$badge->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }
  
    // Renvoie la liste d'utilisateurs ayant le badge en paramètre
public function getUser(Badge $badge) {
    
    
}

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}