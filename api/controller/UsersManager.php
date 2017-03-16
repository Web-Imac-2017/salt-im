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

    $this->_db->exec('INSERT INTO user(mail, username, password, avatar, birthDate, rank, signupDate, badge_id, token) VALUES("'.$user->get_mail().'", "'.$user->get_username().'", "'.$pass_hache.'", "'.$user->get_avatar().'", "'.$user->get_birthDate().'", "0", "'.date("Y-m-d H:i:s").'", "1", "'.$this->createToken($user->get_username()).'")');
    $user_id = $this->_db->lastInsertId();

    $this->_db->exec('INSERT INTO stat(name, value, related_publication_id, related_user_id) VALUES("0", "0", null, "'.$user_id.'")');

    $this->_db->exec('INSERT INTO stat(name, value,  related_publication_id, related_user_id) VALUES("1", "0", null, "'.$user_id.'")');

    $this->_db->exec('INSERT INTO stat(name, value,  related_publication_id, related_user_id) VALUES("2", "0", null, "'.$user_id.'")');
      
    $_SESSION['id'] = $user->get_id();
    $_SESSION['pseudo'] = $user->get_username();
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

    $q = $this->_db->query('SELECT id, mail, username, password, avatar, birthDate, rank, signupDate FROM user WHERE id = "'.$id.'"');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    if($donnees != false) {
        return new User($donnees);
    } else {
        return false;
    }
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

    public function logout() {
        $_SESSION = array();
        session_destroy();
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
        if(!isset($_SESSION['auth'])) {
            $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            exit();
        }
    }

    public function login($data) {
          $stmt = $this->_db->query('SELECT * FROM user WHERE username = "'.$data['username'].'" OR mail = "'.$data['username'].'" LIMIT 1');
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0) {
             if(sha1('gz'.$data['password']) == $userRow['password']) {
                $_SESSION['user_session'] = $userRow['token'];
                $_SESSION['login'] = array(
                    'username' => utf8_encode($data['username'])
                );
                return true;
             }
             else {
                return false;
             }
          }
       }

    public function createToken($data) {
    $tokenGeneric = "saltyh0rse";
    $random_var = rand();

    /* Encoding token */
    $token = hash('sha256', $tokenGeneric.$data.$random_var);

    return $token;
}

public function reconnect_from_cookie($cookie, $session){
    if(isset($cookie['user_session']) && !isset($session['login']) ){
        $remember_token = $cookie['user_session'];
        $stmt = $this->_db->query('SELECT id FROM user WHERE username = "'.$cookie['login']['username'].'" LIMIT 1');
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $this->get($userRow['id']);
        if($user) {
            $expected = $user->get_token();
            if($expected == $remember_token){
                $_SESSION['login'] = array(
                    'username' => utf8_encode($user->get_username())
                );
                $_SESSION['user_session'] = $remember_token;
                setcookie('user_session', $remember_token, time() + 60 * 60 * 24 * 365);
                return true;
            } else{
                setcookie('user_session', null, -1);
                return false;
            }
        }else{
            setcookie('user_session', null, -1);
            return false;
        }
    }
}

    public function who_is_logged_in($session) {
        $stmt = $this->_db->query('SELECT id FROM user WHERE token = "'.$session['user_session'].'" LIMIT 1');
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if($userRow != null) {
            $user = $this->get($userRow['id']);
            return $user;
        } else {
            return false;
        }

    }

    public function is_logged_in(User $user, $session) {
        if(isset($session['login'])) {
           if($session['user_session'] == $user->get_token()) {
                return true;
           }
        } else {
           false;
        }
    }



   public function setDb(PDO $db)
   {
     $this->_db = $db;
   }

   public function search_users($search){
       // liste des sujets
       $users = [];
       $fetchedUsers = [];
       $searchClean = preg_replace('!\s+!', ' ', $search);
       // tableau des mots recherchés
       $searchTab = explode(" ", $searchClean);

       // taille du tableau (nombre de mots)
       $searchSize = count($searchTab);

       // pour chaque mot, effectuer une recherche
       for ($i = 0; $i < $searchSize; $i++) {
           $q = $this->_db->query('SELECT id FROM user
             WHERE username LIKE "%'.$searchTab[$i].'%"');

           while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
               $currentUser = $this->get($donnees['id']);

               var_dump($currentUser);
               if (!in_array($currentUser, $fetchedUsers)) {
                 $users[] = $currentUser;
                 $fetchedUsers[] = $currentUser;
               }
           }
       }

       return $users;
   }

}

