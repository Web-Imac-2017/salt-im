<?php
class MediasManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Media $media)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO media(link, type) VALUES("'.$media->get_link().'", "'.$media->get_type().'")');
      
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Media $media)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM media WHERE id = "'.$media->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet media.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, link, type FROM media WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Media($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les medias.
    $medias = [];

    $q = $this->_db->query('SELECT id, link, type FROM media ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $medias[] = new Media($donnees);
    }

    return $medias;
  }

  public function update(Media $media)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE media SET link = "'.$media->get_link().'", type = "'.$media->get_type().'" WHERE id = "'.$media->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}