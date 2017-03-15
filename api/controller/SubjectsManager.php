 <?php
 class SubjectsManager {
   private $_db; // Instance de PDO.

   public function __construct($db)
   {
     $this->setDb($db);
   }

      public function setDb(PDO $db)
   {
     $this->_db = $db;
   }
 

   public function add(Subject $subject)
   {
     $this->_db->exec('INSERT INTO publication(text, date, user_id) VALUES("'.$subject->get_text().'", "'.date("Y-m-d H:i:s").'", "'.$subject->get_user_id().'")');
     $publication_id = $this->_db->lastInsertId();

     $this->_db->exec('INSERT INTO subject(title, flair, type, publication_id) VALUES("'.$subject->get_title().'", "'.$subject->get_flair().'", "'.$subject->get_type().'", "'.$publication_id.'")');
     $subject_id = $this->_db->lastInsertId();

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id) VALUES("0", "0", "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id) VALUES("1", "0", "'.$publication_id.'")');

     $this->_db->exec('INSERT INTO stat(name, value, related_user_id) VALUES("2", "0", "'.$publication_id.'")');
       
       $subject2 = $this->get($subject_id);
       return $subject2;

   }

   public function delete(Subject $subject)
   {
     // Exécute une requête de type DELETE.
       $result = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$subject->get_id().'"');
       $publication_id = $result->fetch(PDO::FETCH_ASSOC);

       $this->_db->exec('DELETE FROM subject WHERE id = "'.$subject->get_id().'"');

       $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$publication_id['publication_id'].'"');

       $this->_db->exec('DELETE FROM publication WHERE id = "'.$publication_id['publication_id'].'"');


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


   public function get($id)
   {
     // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Subject.
     $id = (int) $id;

     // Récupère le subject
     $q = $this->_db->query('SELECT id, title, flair, type FROM subject WHERE id = "'.$id.'" AND type = "post"');
     $donnees = $q->fetch(PDO::FETCH_ASSOC);
     if ($donnees != false) {
         $subject = new Subject($donnees);
     } else {
         return null;
     }

     // Récupère l'id de la publication associée
     $q = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$id.'"');
     $donnees = $q->fetch(PDO::FETCH_ASSOC);

     // Récupère les données de la publication
     $q = $this->_db->query('SELECT id, text, date, user_id FROM publication WHERE id = "'.$donnees["publication_id"].'"');
     $donnees = $q->fetch(PDO::FETCH_ASSOC);

     // Récupère l'id du media de la publication
     $q = $this->_db->query('SELECT id FROM media WHERE publication_id = "'.$id.'"');
     $donnees_media = $q->fetch(PDO::FETCH_ASSOC);

     // Rajoute les infos manquantes de subject
     $subject->set_text($donnees['text']);
     $subject->set_date($donnees['date']);
     $subject->set_user_id($donnees['user_id']);
     $subject->set_media_id($donnees_media['id']);

     return $subject;

   }
     
     public function postFromUser($id) {
        $subjects = [];

        $q = $this->_db->query('SELECT id FROM publication WHERE user_id = "'.$id.'"');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $q2 = $this->_db->query('SELECT id FROM subject WHERE publication_id = '.$donnees['id']);
          $ids = $q2->fetch(PDO::FETCH_ASSOC);
            if($ids != false && $this->get($ids['id']) != null) {
                $subjects[] = $this->get($ids['id']);  
            }
                  
        }
         return $subjects;
     }

  public function get_help()
   {
     // Exécute une requête de type SELECT récupérant les posts dont le type est HELP

     // récupère les subjects dont le type est HELP
      $q = $this->_db->query('SELECT id, title, flair, type FROM subject WHERE type = "help"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $subject = new Subject($donnees);

      // Récupère l'id de la publication associée
      $q = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$id.'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Récupère les données de la publication
      $q = $this->_db->query('SELECT id, text, date, user_id FROM publication WHERE id = "'.$donnees["publication_id"].'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Récupère l'id du media de la publication
      $q = $this->_db->query('SELECT id FROM media WHERE publication_id = "'.$id.'"');
      $donnees_media = $q->fetch(PDO::FETCH_ASSOC);

      // Rajoute les infos manquantes de subject
      $subject->set_text($donnees['text']);
      $subject->set_date($donnees['date']);
      $subject->set_user_id($donnees['user_id']);
      $subject->set_media_id($donnees_media['id']);

     return $subject;
   }
     

  public function sort_date(){
    // Exécute une requête de type SELECT avec les posts triés par date

    // récupère les subjects dont le type est POST et triés par date
      $q = $this->_db->query('SELECT id, title, flair, type FROM subject WHERE type = "post" ORDER BY "date" DESC');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $subject = new Subject($donnees);

      // Récupère l'id de la publication associée
      $q = $this->_db->query('SELECT publication_id FROM subject WHERE id = "'.$id.'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Récupère les données de la publication
      $q = $this->_db->query('SELECT id, text, date, user_id FROM publication WHERE id = "'.$donnees["publication_id"].'"');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      // Récupère l'id du media de la publication
      $q = $this->_db->query('SELECT id FROM media WHERE publication_id = "'.$id.'"');
      $donnees_media = $q->fetch(PDO::FETCH_ASSOC);

      // Rajoute les infos manquantes de subject
      $subject->set_text($donnees['text']);
      $subject->set_date($donnees['date']);
      $subject->set_user_id($donnees['user_id']);
      $subject->set_media_id($donnees_media['id']);

      return $subject;
  }

  public function search_title($search)
  {
      // Retourne la liste de tous les subjects dont le titre contient une chaîne passée en paramètres
      $subjects = [];
      //$search = $_POST(['search']);
      /*$search = "julien";*/
      //$q = $this->_db->query('SELECT * FROM subject WHERE title LIKE "%'.$title.'%"');
      // test requête avec prepare
      
      /*$q = $this->_db->prepare('SELECT * FROM subject WHERE title LIKE %?%');
      $q->execute(array($search));*/
      /*$q = $this->_db->prepare("SELECT id, title FROM subject WHERE title LIKE :title");*/

      /*    $q->bindValue('title', $search, PDO::PARAM_STR);
      $q->execute();


      while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
          $subjects[] = new Subject($donnees);
      }*/
      
      $q = $this->_db->prepare('SELECT publication_id, title FROM subject
          WHERE title LIKE "%'.$search.'%"');

      while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
          $subjects[] = new Subject($donnees);
          echo "je rentre dans le while";
      }
      echo $search;
      return $subjects;
  }
}