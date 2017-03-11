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
    $q = $this->_db->prepare('INSERT INTO stat(name, value, related_element_id, related_element_type) VALUES("'.$stat->get_name().'", "'.$stat->get_value().'", "'.$stat->get_related_element_id().'", "'.$stat->get_related_element_type().'")');
    
    // Exécution de la requête.
    $q->execute();
  }

  /*public function delete(Stat $stat)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM stat WHERE id = "'.$stat->get_id()."'");
  }*/

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet stat.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, name, value, related_element_id, related_element_type FROM stat WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Stat($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les stats.
    $stats = [];

    $q = $this->_db->query('SELECT id, name, value, related_element_id, related_element_type FROM stat ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }

    return $stats;
  }

  public function update(Stat $stat)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE stat SET name = "'.$stat->get_name().'", value = "'.$stat->get_value().'", related_element_id = "'.$stat->get_related_element_id().'", related_element_type = "'.$stat->get_related_element_type().'" WHERE id = "'.$stat->get_id().'"');
      
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}