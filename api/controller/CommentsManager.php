<?php

class CommentsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Comment $comment)
  {
    $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$comment->get_text().'", "'.$comment->get_date().'", "'.$comment->get_user_id().'")');
    $publication_id = mysql_insert_id();

    $this->_db->exec('INSERT INTO comment(related_publication_id, publication_id) VALUES("'.$comment->get_related_publication_id().'", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("sel", "0", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("poivre", "0", "'.$publication_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("humour", "0", "'.$publication_id.'")');
  }

  public function delete(Comment $comment)
  {
    $publication_id = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.comment->get_id().'")');
    
    $this->_db->exec('DELETE FROM publication WHERE id = "'.$publication_id.'"');
      
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id.'"');
      
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