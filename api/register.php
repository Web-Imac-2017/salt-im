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

 
   if($uname=="") {
      $error['user'] = "provide username !"; 
   }

   else if(strlen($uname) < 3 && strlen($uname) > 20 ){
      $error['username_length'] = "Username must be atleast 6 characters"; 
   }
   else if($umail=="") {
      $error['id'] = "provide email id !"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error['email'] = 'Please enter a valid email address !';
   }
   else if($upass=="") {
      $error['empty_password'] = "provide password !";
   }
   else if(strlen($upass) < 6 && strlen($upass) > 128 ){
      $error['password_length'] = "Password must be between 6 and 128 characters"; 
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
}

?>
