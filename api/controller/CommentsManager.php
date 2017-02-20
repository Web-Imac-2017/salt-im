<?php
class CommentsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Comment $comment)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO comment(text, date) VALUES("'.$comment->get_text()'", "'.$comment->get_date().'")
    ');
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Comment $comment)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM comment WHERE id = "'.$comment->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, text, date FROM comment WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Comment($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les subjects.
    $comments = [];

    $q = $this->_db->query('SELECT id, text, date FROM comment ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $comments[] = new Comment($donnees);
    }

    return $comments;
  }

  public function update(Comment $comment)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE comment SET text = "'.$comment->get_text()'", date = "'.$comment->get_date().'" WHERE id = "'.$comment->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}