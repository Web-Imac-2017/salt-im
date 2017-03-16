<?php

class CommentsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Comment $comment, $id)
  {
    $q = $this->_db->query('SELECT publication.id FROM publication JOIN subject ON publication.id = subject.publication_id WHERE subject.id = "'.$id.'"');
    $pub_id = $q->fetch(PDO::FETCH_ASSOC);
      
    $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$comment->get_text().'", "'.$comment->get_date().'", "'.$comment->get_user_id().'")');
    $publication_id = $this->_db->lastInsertId();

    $this->_db->exec('INSERT INTO comment(related_publication_id, publication_id) VALUES("'.$pub_id['id'].'", "'.$publication_id.'")');
      
      $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("0", "0", NULL, "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("1", "0", NULL, "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("2", "0", NULL, "'.$publication_id.'")');
  }
    
  public function addToComment(Comment $comment, $id)
  {
    $q = $this->_db->query('SELECT publication.id FROM publication JOIN comment ON publication.id = comment.publication_id WHERE comment.id = "'.$id.'"');
    $pub_id = $q->fetch(PDO::FETCH_ASSOC);
      
    $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$comment->get_text().'", "'.$comment->get_date().'", "'.$comment->get_user_id().'")');
    $publication_id = $this->_db->lastInsertId();

    $this->_db->exec('INSERT INTO comment(related_publication_id, publication_id) VALUES("'.$pub_id['id'].'", "'.$publication_id.'")');
      $comment_id = $this->_db->lastInsertId();
      
    $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("0", "0", NULL, "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("1", "0", NULL, "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id, related_publication_id) VALUES("2", "0", NULL, "'.$publication_id.'")');
      
      return $this->get($comment_id);
      
      
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
        
  public function getAllCommentsFromPost($id, $order) {
    $comments = [];
    $pack = [];
      
    $q1 = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$id.'"');
    $result = $q1->fetch(PDO::FETCH_ASSOC);
    $s_id = $result['publication_id'];

    // Cherche tous les ids des comments qui répondent à ce post
    // NIVEAU 1
    $q2 = $this->_db->query('SELECT id FROM comment WHERE related_publication_id = "'.$s_id.'"');

    // Pour chaque comment de NIVEAU 1
    while ($donnees = $q2->fetch(PDO::FETCH_ASSOC)) {
      // $orignal = comment NIVEAU 1
      $original = $this->get($donnees['id']);
      $pack[] = $original;
      $answers = $this->getAllCommentsFromComment($donnees['id'], $order);
      $pack[] = $answers;
      $comments[] = $pack;
      $pack = null;
    }
      
    return $comments;
  }
    
  public function getAllCommentsFromComment($id, $order) {
      $comments = [];
      $pack = [];
      
      // Fait une requête pour récupérer l'id de la publication liée au comment original
      $q = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.$id.'" LIMIT 1');
      $result = $q->fetch(PDO::FETCH_ASSOC); 
      $o_id = $result['publication_id'];  
      
      // Tri
      if ($order == "date") {
          $orderby = ' ORDER BY publication.date';     
      } else if ($order == "sel") {
           
          
      } else if ($order == "poivre") {
           
          
      } else if ($order == "humour") {
            
          
      }
      
      // Sélectionne les id des comments qui correspondent
      $q2 = $this->_db->query('SELECT comment.id FROM publication INNER JOIN comment ON comment.publication_id = publication.id WHERE comment.related_publication_id = "'.$o_id.'"'.$orderby);
      
      // Pour chaque id de comment récupérée
      while ($result = $q2->fetch(PDO::FETCH_ASSOC)) {
          // On récupère le comment
          $original = $this->get($result['id']);
          $answers = $this->getAllCommentsFromComment($result['id'], $order);
          $pack[] = $original;
          $pack[] = $answers;
          $comments[] = $pack;
          $pack = null;
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
    
    public function commentFromUser($id) {
        $comments = [];

        $q = $this->_db->query('SELECT id FROM publication WHERE user_id = '.$id);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $q2 = $this->_db->query('SELECT id FROM comment WHERE publication_id = '.$donnees['id']);
          $ids = $q2->fetch(PDO::FETCH_ASSOC);
            if($ids != false && $this->get($ids['id']) != null) {
                $comments[] = $this->get($ids['id']);  
            }
                  
        }

        return $comments;
    }
    
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
    
    public function addTags($id, $tags) {
        for($i=0; count($tags); $i++) {
            $q = $this->_db->query('SELECT id FROM tag WHERE name = "'.$tags[$i].'"');
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            $this->_db->exec('INSERT INTO rel_tag_publication(publication_id, tag_id) VALUES("'.$id.'", "'.$donnees['id'].'"');
        }
    }

public function sortCommentsByStat(){
    // Exécute une requête de type SELECT avec les posts triés par date
    $sort = $_GET['comment_stat_id'];
    // récupère les subjects dont le type est POST et triés par date
      $q = $this->_db->query('SELECT comment.*, stat.id, stat.related_publication_id, stat.value FROM comment JOIN stat ON stat.related_publication_id = comment.publication_id WHERE stat.name = '.$sort.' ORDER BY stat.value DESC');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $comment = new Comment($donnees);

      // Récupère l'id de la publication associée
      $q = $this->_db->query('SELECT publication_id FROM comment WHERE id = "'.$id.'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Récupère les données de la publication
      $q = $this->_db->query('SELECT id, text, date, user_id FROM comment WHERE id = "'.$donnees["publication_id"].'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Rajoute les infos manquantes de subject
      $comment->set_text($donnees['text']);
      $comment->set_date($donnees['date']);
      $comment->set_user_id($donnees['user_id']);
      $comment->set_media_id($donnees_media['id']);

      return $comment;
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