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
    $q = $this->_db->prepare('INSERT INTO stat(name, value) VALUES(:name, :value)');
    
    // Assignation des valeurs du stat.
    $q->bindValue(':name', $stat->get_name());
    $q->bindValue(':value', $stat->get_value());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Stat $stat)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM stat WHERE id = '.$stat->get_id());
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet stat.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, name, value FROM stat WHERE id = '.$id);
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

  public function update(Stat $stat)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE stat SET name = :name, value = :value WHERE id = :id');

    // Assignation des valeurs à la requête.
    $q->bindValue(':name', $stat->get_name());
    $q->bindValue(':value', $stat->get_value());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}