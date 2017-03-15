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
    $q = $this->_db->prepare('INSERT INTO tag(name, img_url, description) VALUES("'.$tag->get_name().'", "'.$tag->get_img_url().'", "'.$tag->get_description().'")');
      
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
    $q = $this->_db->query('SELECT * FROM tag WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Tag($donnees);
  }
    
  public function getFromName($name)
  {
    $q = $this->_db->query('SELECT * FROM tag WHERE name = "'.$name.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    if($donnees == null) {
        return false;
    } else {
        return new Tag($donnees);
    }      
  }

  public function getList()
  {
    // Retourne la liste de tous les tags.
    $tags = [];

    $q = $this->_db->query('SELECT id, name, img_url, description FROM tag ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $tags[] = new Tag($donnees);
    }

    return $tags;
  }
    
  public function getSubjects(Tag $tag) {
    $subject_id_array = [];
    $subjects = [];
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag->get_id().'"');
      
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
    
  public function getSubjectsManyTags(array $tags) {
    $subject_id_array = [];
    $subjects = [];
    $cond = 'WHERE rel_tag_publication.tag_id = "'.$tags[0]->get_id().'"';
      
    for($i=1; count($tags); $i++) {
        $cond = $cond.' AND rel_tag_publication.tag_id = "'.$tags[$i]->get_id().'"';
    }
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id '.$cond);
      
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
    
  
  public function img(Tag $tag, $data) {
        
        try {
    
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['userfile']['error']) ||
                is_array($_FILES['userfile']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['userfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here. 
            if ($_FILES['userfile']['size'] > 2000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['userfile']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $uploadfile = sprintf('../public/uploads/%s.%s',
                    sha1_file($_FILES['userfile']['tmp_name']),
                    $ext
                );
            if (!move_uploaded_file(
                $_FILES['userfile']['tmp_name'], $uploadfile
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File is uploaded successfully.';
            $user->set_img_url($uploadfile);
            $this->update($tag, $tag->get_id());

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }
    }

  public function update(Tag $tag)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE tag SET name = "'.$tag->get_name().'", img_url = "'.$tag->get_img_url().'", description = "'.$tag->get_description().'" WHERE id = "'.$tag->get_id().'"');
    
    // Exécution de la requête.
    $q->execute();
  }


public function search_tag($search)
  {
      // liste des sujets
      $tags = [];
      $fetchedTags = [];

      $searchClean = preg_replace('!\s+!', ' ', $search);
      
      // tableau des mots recherchés
      $searchTab = explode(" ", $searchClean);
      print_r($searchTab);

      // taille du tableau (nombre de mots)
      $searchSize = count($searchTab);
      print_r($searchSize);

      // pour chaque mot, effectuer une recherche
      for ($i = 0; $i < $searchSize; $i++) {
          $q = $this->_db->query('SELECT id FROM tags
            WHERE name LIKE "%'.$searchTab[$i].'%"');

          while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
              $currentTag = $this->get($donnees['id']);
              if (!in_array($currentTag, $fetchedTags)) {
                $tags[] = $currentTag;
                $fetchedTags[] = $currentTag;
              }
          }
      }
      
      echo $search;
      return $tags;
  }


  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}