
<?php
require_once 'connect.php';

if($user->is_logged_in()!="")
{
 $user->redirect('/');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['username'];
 $umail = $_POST['mail'];
 $upassword = $_POST['password'];
  
 if($user->is_logged_in($uname,$umail,$upassword))
 {
  $user->redirect('/');
 }
 else
 {
  $error = "Erreur d'authentification!";
 } 
}
?>