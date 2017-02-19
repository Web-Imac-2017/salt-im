<?php
class SubjectsManager {
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Subject $subject)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO subject(text, date, title, flair, type) VALUES("'.$subject->get_text().'", "'.$subject->get_date().'", "'.$subject->get_title().'", "'.$subject->get_flair().'", "'.$subject->get_type().'")');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function delete(Subject $subject)
  {
    // Exécute une requête de type DELETE.
      $this->_db->exec('DELETE FROM subject WHERE id = "'.$subject->get_id().'"');
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, text, date, title, flair, type FROM subject WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Subject($donnees);
  }

  public function getList()
  {
    // Retourne la liste de tous les subjects.
    $subjects = [];

    $q = $this->_db->query('SELECT id, text, date, title, flair, type FROM subject ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $subjects[] = new Subject($donnees);
    }

    return $subjects;
  }

  public function update(Subject $subject)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE subject SET text = "'.$subject->get_text().'", date = "'.$subject->get_date().'", title = "'.$subject->get_title().'", flair = "'.$subject->get_flair().'", type = "'.$subject->get_type().'" WHERE id = "'.$subject->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}