
<?php
public function login($uname,$umail,$upassword)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user WHERE username=:uname OR mail=:umail LIMIT 1");
          $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['user_password']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

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