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
    $q = $this->_db->prepare('INSERT INTO comment(text, date) VALUES(:text, :date)');
    
    // Assignation des valeurs du subject.
    $q->bindValue(':text', $comment->get_text());
    $q->bindValue(':date', $comment->get_date());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Comment $comment)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM comment WHERE id = '.$comment->get_id());
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, text, date FROM comment WHERE id = '.$id);
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
    $q = $this->_db->prepare('UPDATE comment SET text = :text, date = :date WHERE id = :id');

    // Assignation des valeurs à la requête.
    $q->bindValue(':text', $comment->get_text());
    $q->bindValue(':date', $comment->get_date());
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}