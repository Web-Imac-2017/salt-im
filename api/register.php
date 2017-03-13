<?php
require_once 'controller/connect.php';
include 'function.php'
//a créer. 

$error = [];
if($user->is_loggedin()!="")
{
  $user->redirect('/');
}

if(isset($_POST['btn-signup']))
{
  $uname = trim($_POST['txt_uname']);
  $umail = trim($_POST['txt_umail']);
  $upass = trim($_POST['txt_upass']); 

  /* Vérifications des données saisies par l'utilisateur car il peut outrepasser les restrictions du front et tout casser */
  
  // username non fourni
  if($uname=="") {
    $error['username_empty'] = "Provide a username"; 
  }

  // username trop long / trop court
  else if(strlen($uname) < 3 && strlen($uname) > 20 ){
    $error['username_length'] = "Username must be at between 6 and 20 characters"; 
  }

  // username contient des caractères interdits
  else if (preg_match("^[0-9A-Za-z_]+$", $uname) == 0) {
    $error['username_invalid'] = "Invalid characters in the username";
  }

  // mail non fourni
  else if($umail=="") {
    $error['email_empty'] = "Provide an email"; 
  }

  // mail invalide
  else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
    $error['email_invalid'] = "Please enter a valid email address !";
  }

  // pass non fourni
  else if($upass=="") {
    $error['password_empty'] = "Provide a password !";
  }

  // pass trop long / trop court
  else if(strlen($upass) < 6 && strlen($upass) > 128 ){
    $error['password_length'] = "Password must be between 6 and 128 characters"; 
  }
}

else
{
  try
  {
    $stmt = $DB_con->prepare("SELECT username,useremail FROM user WHERE username=:uname OR useremail=:umail");
    $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
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

?>
