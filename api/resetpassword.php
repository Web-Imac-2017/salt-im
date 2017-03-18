<?php
require_once 'User.php';
require_once 'UsersManager.php';
$user = new User();

if(empty($_GET['id']) && empty($_GET['code']))
{
 $user->redirect('/');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];
 
 $stmt = $user->runQuery("SELECT * FROM user WHERE id == uid AND tokenCode == token");
 $stmt->execute(array("uid"=>$id,":token"=>$code));
 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($stmt->rowCount() == 1)
 {
  if(isset($_POST['btn-reset-pass']))
  {
   $pass = $_POST['password'];
   $confirm_pass = $_POST['confirm-pass'];
   
   if($confirm_pass!==$pass)
   {
    $msg = "<div class='alert alert-block'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Sorry!</strong>  curieux ce n'est pas le même mot de passe. 
      </div>";
   }
   else
   {
    $stmt = $user->runQuery("UPDATE user SET password = new_password WHERE id=uid");
    $stmt->execute(array("new_password"=>$confirm_pass,"uid"=>$rows['id']));
    
    $msg = "<div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      Mdp changé.
      </div>";
    header("refresh:5;/");
   }
  } 
 }
 else
 {
  exit;
 }
 
 
}

?>