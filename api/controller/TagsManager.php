<?php
class TagsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Tag $tag)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO tag(name) VALUES("'.$tag->get_name().'")');
      
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Tag $tag)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM tag WHERE id = "'.$tag->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet tag.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, name FROM tag WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Tag($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les tags.
    $tags = [];

    $q = $this->_db->query('SELECT id, name FROM tag ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $tags[] = new Tag($donnees);
    }

    return $tags;
  }

  public function update(Tag $tag)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE tag SET name = "'.$tag->get_name().'" WHERE id = "'.$tag->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}