<?php
class HelpsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Help $Help)
  {      
    $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$subject->get_text().'", "'.$subject->get_date().'", "'.$subject->get_user_id().'")');
    $publication_id = mysql_insert_id();
      
    $this->_db->exec('INSERT INTO subject(title, flair, type, publication_id) VALUES("'.$subject->get_title().'", "'.$subject->get_flair().'", "'.$subject->get_type().'", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("sel", "0", "'.$publication_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("poivre", "0", "'.$publication_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_id) VALUES("humour", "0", "'.$publication_id.'")'); 
    
  }

  public function delete(Help $Help)
  {
    // Exécute une requête de type DELETE.
      $publication_id = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$subject->get_id().'"');
      
      $this->_db->exec('DELETE FROM publication WHERE id = "'.$publication_id.'"');
      
      $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id.'"');
      
      $this->_db->exec('DELETE FROM subject WHERE id = "'.$subject->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM subject WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Subject($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les subjects.
    $subjects = [];

    $q = $this->_db->query('SELECT * FROM subject ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $subjects[] = new Subject($donnees);
    }

    return $subjects;
  }
    
  public function getStat(Subject $subject) {
    $stats = [];
    
    $q = $this->_db->query('SELECT * FROM stat WHERE related_element_id = "'.$subject->get_id().'"');
      
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $stats[] = new Stat($donnees);
    }

    return $stats;
}

  public function update(Subject $subject)
  {
    // Prépare une requête de type UPDATE.
    $this->_db->exec('UPDATE subject SET title = "'.$subject->get_title().'", flair = "'.$subject->get_flair().'", type = "'.$subject->get_type().'" WHERE id = "'.$subject->get_id().'"');
      
    $this->_db->exec('UPDATE publication SET text = "'.$subject->get_text().'", date = "'.$subject->get_date().'"');
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}