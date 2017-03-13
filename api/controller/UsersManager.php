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
    
    public function register($data) {
        $error = [];
        
        if($this->is_loggedin()!="")
        {
          $this->redirect('/');
        }

        if($_POST != null) {
          $username = trim($_POST['username']);
          $password = trim($_POST['password']);
          $mail = trim($_POST['mail']); 
          $birthDate = trim($_POST['birthDate']);

          /* Vérifications des données saisies par l'utilisateur car il peut outrepasser les restrictions du front et tout casser */

          // username non fourni
          if(!isset($username)) {
            $error['username_empty'] = "Provide a username"; 
          }

          // username trop long / trop court
          else if(strlen($username) < 3 && strlen($username) > 20 ){
            $error['username_length'] = "Username must be at between 6 and 20 characters"; 
          }

          // username contient des caractères interdits
          else if (preg_match("^[0-9A-Za-z_]+$", $username) == 0) {
            $error['username_invalid'] = "Invalid characters in the username";
          }

          // mail non fourni
          else if(!isset($mail)) {
            $error['email_empty'] = "Provide an email"; 
          }

          // mail invalide
          else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $error['email_invalid'] = "Please enter a valid email address !";
          }

          // pass non fourni
          else if(!isset($password)) {
            $error['password_empty'] = "Provide a password !";
          }

          // pass trop long / trop court
          else if(strlen($password) < 6 && strlen($password) > 128 ){
            $error['password_length'] = "Password must be between 6 and 128 characters"; 
          }
        }

        else
        {
          try
          {
            $stmt = $this->_db->prepare('SELECT username, mail FROM user WHERE username =  OR mail = ');
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
              
            $stmt
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['username']==$uname) {
              $error['username_taken'] = "sorry username already taken !";
            }
            else if($row['useremail']==$umail) {
              $error['email_taken'] = "sorry email id already taken !";
            }
            else
            {
              if(empty($error)) 
              {
                $pass_hache = sha1('gz' . $_POST['password']);
                // Insertion dans la DB
                $req = $bdd->prepare('INSERT INTO user(username, password, mail, avatar, birthDate, rank, singupDate, badge_id, token) VALUES(:pseudo, :pass_hache, :email, :avatar, :birthDate, :rank, :badge,  CURDATE())', ':token' );

                $token  = str_random(60); //la fonction est dans function
                $req->execute(array(
                  'pseudo' => $username,
                  'pass' => $password,
                  'email' => $mail,
                  'avatar' => 'default_avatar.png',
                  'birthDate' => $birthDate,
                  'rank' => '0',
                  'badge' => '1'));

                $resultat = $req->fetch();

                if (!$resultat)
                {
                  echo 'Mauvais identifiant ou mot de passe !';
                }
                else
                {
                  session_start();
                  $_SESSION['id'] = $resultat['id'];
                  $_SESSION['pseudo'] = $username;
                  echo 'Vous êtes connecté !';
                }
              }
            }
              }
              catch(PDOException $e)
              {
                echo $e->getMessage();
              }
}

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
    
    public function logged_only() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['auth'])) {
            $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            exit();
    } 
        
    public function is_loggedin() {
        
    }
    
    
 
   public function setDb(PDO $db)
   {
     $this->_db = $db;
   }
    
}

