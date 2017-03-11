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
      $result = $this->_db->query('SELECT publication_id FROM tag WHERE id = "'.$tag->get_id().'")');
      $this->_db->exec('DELETE FROM tag WHERE id = "'.$tag->get_id().'"');
      $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id['publication_id'].'"');

  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet tag.
    $id = (int) $id;
    $publication_id = $result->fetch(PDO::FETCH_ASSOC);
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
    
  public function getSubjects(Tag $tag) {
    $subject_id_array = [];
    $subjects = [];
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag_id.'"');
      
    // On a récupéré les ids des publications ayant le tag précisé
      for($i=0; $row = $q->fetch(); $i++) {
        $subject_id_array[] = $row['id'];
      }
    // Il faut récupérer les subjects correspondant aux ids
      
    for($i=0; count($subject_id_array); $i++) {
        $q = $this->_db->query('SELECT * FROM subject WHERE id = "'.$subject_id_array[$i].'"');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $subjects[] = new Subject($donnees);
        }
    }    

    return $subjects;
  }
    
  public function getComments(Tag $tag) {
    $comment_id_array = [];
    $comments = [];
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag_id.'"');
      
    // On a récupéré les ids des publications ayant le tag précisé
      for($i=0; $row = $q->fetch(); $i++){
        $comment_id_array[] = $row['id'];
      }
    // Il faut récupérer les subjects correspondant aux ids
      
    for($i=0; count($comment_id_array); $i++) {
        $q = $this->_db->query('SELECT * FROM subject WHERE id = "'.$comment_id_array[$i].'"');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Subject($donnees);
        }
    }    

    return $comments;
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