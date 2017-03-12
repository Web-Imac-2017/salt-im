<?php
require_once 'controller/connect.php';
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
                include 'connect.php'
                $req = $pdo->prepare("INSERT INTO user SET username = ?, password = ?, mail = ?, avatar = 'default_avatar.png', birthdate = '21/12/2012', rank = 0, signupDate= date('l \t\h\e jS')");
                $req->execute()
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
