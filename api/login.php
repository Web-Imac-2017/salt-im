
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
             elsemù
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
function reconnect_from_cookie(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
        include 'connect.php';
        if(!isset($pdo)){
            global $pdo;
        }
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $pdo->prepare('SELECT * FROM user WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . '');
            if($expected == $remember_token){
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 365);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
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
 $upassword = $_POST['password'];
  
 if($user->is_logged_in($uname,$umail,$upassword))
 {
 $umail = $_POST['mail'];
  $user->redirect('/');

 }
 else
 {

  $error = "Erreur d'authentification!";
 } 
}
?>