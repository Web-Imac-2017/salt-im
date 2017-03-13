<?php
class UsersManager {
  private $_db; // Instance de PDO.
  public function __construct($db)
  {
    $this->setDb($db);
  }
    
    
  public function getDb() {
        return $this->_db;
    }
    
  public function add(User $user) {
    // Préparation de la requête 
      
    $pass_hache = sha1('gz'.$user->get_password());
      
    $this->_db->exec('INSERT INTO user(mail, username, password, avatar, birthDate, rank, signupDate, badge_id) VALUES("'.$user->get_mail().'", "'.$user->get_username().'", "'.$pass_hache.'", "'.$user->get_avatar().'", "'.$user->get_birthDate().'", "0", "'.date("Y-m-d H:i:s").'", "1")');
    $user_id = $this->_db->lastInsertId();
      
    $this->_db->exec('INSERT INTO stat(name, value, related_element_type, related_element_id) VALUES("0", "0", "1", "'.$user_id.'")');
      
    $this->_db->exec('INSERT INTO stat(name, value,  related_element_type, related_element_id) VALUES("1", "0", "1", "'.$user_id.'")'); 
      
    $this->_db->exec('INSERT INTO stat(name, value,  related_element_type, related_element_id) VALUES("2", "0", "1", "'.$user_id.'")'); 
      
  }
  public function delete(User $user) {
    // Exécute une requête de type DELETE.
    $this->_db->exec('DELETE FROM stat WHERE related_element_id = "'.$user->get_id().'"');
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->get_id());
  }
 
   public function get($id)
   {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet User.
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, mail, username, password, avatar, birthDate, rank, signupDate FROM user WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new User($donnees);
  }


  public function getStat(User $user) {
    $stats = [];
     
    $q = $this->_db->query('SELECT * FROM stat WHERE related_element_id = "'.$user->get_id().'"');
      
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
   {
      $stats[] = new Stat($donnees);
    }

    return $stats;
}

public function getSubjects(User $user) {
    $subject_id_array = [];
    $subjects = [];
      
    $q = $this->_db->query('SELECT id FROM publication JOIN rel_tag_publication ON publication.id = rel_tag_publication.publication_id WHERE rel_tag_publication.tag_id = "'.$tag_id.'"');
    $q = $this->_db->query('SELECT id FROM publication WHERE user_id = AND ');
        
    // On a récupéré les ids des publications ayant le tag précisé
      for($i=0; $row = $q->fetch(); $i++){
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


  public function getList()
  {
    // Retourne la liste de tous les users.
    $users = [];

    $q = $this->_db->query('SELECT mail, username, password, avatar, birthDate, rank, signupDate, badge_id FROM user ORDER BY id');


    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new User($donnees);
    }

    return $users;

   }
 
   public function update(User $user, $id)
   {
       
     $pass_hache = sha1('gz'.$user->get_password());
     // Prépare une requête de type UPDATE.
     $q = $this->_db->prepare('UPDATE user SET mail = "'.$user->get_mail().'", username = "'.$user->get_username().'", password = "'.$pass_hache.'", avatar = "'.$user->get_avatar().'", birthDate = "'.$user->get_birthDate().'", rank = "'.$user->get_rank().'" WHERE id = "'.$id.'"');
     
     // Exécution de la requête.
     $q->execute();
   }
    
    public function avatar(User $user, $data) {
        
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
            $user->set_avatar($uploadfile);
            $this->update($user, $user->get_id());

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }
    }
    
    
 
   public function setDb(PDO $db)
   {
     $this->_db = $db;
   }
    
}

