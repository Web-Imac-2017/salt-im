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
    $publication_id = $this->_db->lastInsertId();

    $this->_db->exec('INSERT INTO comment(related_publication_id, publication_id) VALUES("'.$comment->get_related_publication_id().'", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("0", "0", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("1", "0", "'.$publication_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("2", "0", "'.$publication_id.'")');
  }

  public function delete(Comment $comment)
  {
    $result = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.$comment->get_id().'")');
    $publication_id = $result->fetch(PDO::FETCH_ASSOC);
      
    $this->_db->exec('DELETE FROM comment WHERE id = "'.$comment->get_id().'"');
      
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id['publication_id'].'"');
    
    $this->_db->exec('DELETE FROM publication WHERE id = "'.$publication_id['publication_id'].'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id FROM comment WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    $comment = new Comment($donnees);

    // Récupère la publication constituée par ce commentaire
    $q = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.$id.'"');
    $publication_id = $q->fetch(PDO::FETCH_ASSOC);
      
    // Récupère les infos de la publication
    $q = $this->_db->query('SELECT id, text, user_id, date FROM publication WHERE id = "'.$publication_id['publication_id'].'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
    $comment->set_text($donnees['text']);
    $comment->set_user_id($donnees['user_id']);
    $comment->set_date($donnees['date']);
      
    return $comment; // retourne l'objet comment spécifié en id
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
    
  public function getCommentsFromPost($id) {
    $comments = [];

    $q = $this->_db->query('SELECT id FROM comment WHERE related_publication_id = "'.$id.'"');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    { 
      $comments[] = $this->get($donnees['id']);
    }

    return $comments;
  }
    
    public function getAllCommentsFromPost($id) {
    $comments = [];

    $q = $this->_db->query('SELECT id FROM comment WHERE related_publication_id = "'.$id.'"');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    { 
      $comments[] = $this->get($donnees['id']);
      $result = $this->cherche($donnees['id']);
      
      while ($result != null) {
        $comments[] = $this->get($result);
        $result = $this->cherche($result);
      }
    }
    return $comments;
  }
    
    public function cherche($id) {
      // Crée un objet $c comment qui correspond à la première ligne du tableau
      $c = $this->get($id);
      
      // Fait une requête pour récupérer l'id de la publication liée au comment $c
      $q = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.$id.'"');
      $result = $q->fetch(PDO::FETCH_ASSOC); 
        
      // Fait une requête pour voir s'il y a des comments qui répondent à cet id
      $q = $this->_db->query('SELECT id FROM comment WHERE related_publication_id = "'.$result['publication_id'].'"');
      $id_3 = $q->fetch(PDO::FETCH_ASSOC);
        
      if($id_3 != false){
          return $id_3['id'];
      }
    }
    
//    public function getAllCommentsFromPost($id) {
//        $comments = [];
//        $comment = [];
//    
//    $q = $this->_db->query('SELECT id FROM comment WHERE related_publication_id = "'.$id.'"');
//
//    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
//    { 
//      $comment[] = $this->get($donnees['id']);
//      $comment[] = $this->getCommentsFromPost($donnees['id']);
//      $comments[] = $comment;
//    }
//
//    return $comments;
//    
//        
//    }
    
  public function getStat(Comment $comment) {
    $stats = [];
    
    $q = $this->_db->query('SELECT * FROM stat WHERE related_element_id = "'.$comment->get_id().'"');
      
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }

    return $stats;
}
    
  public function getTags(Comment $comment) {
    $tags = [];
      
    $q = $this->_db->query('SELECT * FROM tag JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag_id.'"');
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $tags[] = new Tag($donnees);
    }

    return $comments;
}

  public function update(Comment $comment)
  {
    // Prépare une requête de type UPDATE.
    //$q = $this->_db->prepare('UPDATE comment SET text = "'.$comment->get_text()'", date = "'.$comment->get_date().'" WHERE id = "'.$comment->get_id().'"');
    //$q = $this->_db->exec('UPDATE comment SET text = "'.$comment->get_text()'" WHERE id = "'.$comment->get_id().'"');
    
      
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}