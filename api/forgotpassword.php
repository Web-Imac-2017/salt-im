<?php
session_start();
require_once 'User.php';
require_once 'UsersManager.php';
$user = new User();

if($user->is_logged_in()!="")
{
 $user->redirect('/'); //faut modifier là je sais pas ou on redirige 
}

if(isset($_POST['btn-submit']))
{
 $email = $_POST['email'];
 
 $stmt = $user->runQuery("SELECT id FROM user WHERE mail == email LIMIT 1"); //limit the number of row returned by SELECT
 $stmt->execute(array("email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $id = base64_encode($row['id']);
  $code = md5(uniqid(rand()));
  
  $stmt = $user->runQuery("UPDATE user SET tokenCode=token WHERE mail ==email");
  $stmt->execute(array("token"=>$code,"email"=>$email));
  
  $message= "
       Ah, $email
       <br /><br />
       Go changer ton mot de passe. Si c'est pas toi met un stop.
      
       <br /><br />
       <a href='http://www.onapasdenomdedomaine.com/resetpass.php?id=$id&code=$code'>cliquez bandes de salopes</a>
       <br /><br />
       :)
       ";
  $subject = "Password Reset";
  
  $user->mail($email,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     Check tes mails on l'a envoyé à $email.
                    Clique sur le lien pour générer un nouveau mdp 
      </div>";
 }
 else
 {
  $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong>  Oops email non trouvé. 
       </div>";
 }
}
?>

