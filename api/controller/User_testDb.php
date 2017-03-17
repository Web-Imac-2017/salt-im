<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="knacss.css">
    
    </head>
    <style>
        * {
            font-family: Arial;
            line-height: 35px;
        }
        
        h1 {
            font-size: 1.4em;
        }
    </style>
</head>
<body>
    

<?php
require "User.php";
require "UsersManager.php";

//Connexion à la base -------------------------
$servername = "localhost";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=salt", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
}

//-------------------------------------------

$manager = new UsersManager($db);

// Traitement du formulaire

//~~ Ajouter

if (isset($_GET['username']) && isset($_GET['mail']) && isset($_GET['password']) && isset($_GET['birthDate']) && isset($_GET['avatar'])) {

$tab_new_user = array(
    "username" => $_GET['username'],
    "mail" => $_GET['mail'],
    "password" => $_GET['password'],
    "birthDate" => $_GET['birthDate'],
    "avatar" => $_GET['avatar'],
    "rank" => 1,
    "signupDate" => date('Y-m-d')
    );

$new_user = new User($tab_new_user);
$manager->add($new_user);
    
}

//~~ Update

if (isset($_GET['user_update'])) {
    
$user_update = $manager->get($_GET['user_update']);

if ($_GET['username_up'] != NULL) {
    $user_update->set_username($_GET['username_up']);
}

if ($_GET['mail_up'] != NULL) {
    $user_update->set_mail($_GET['mail_up']);
}
    
if ($_GET['password_up'] != NULL) {
    $user_update->set_password($_GET['password_up']);
}
    
if ($_GET['birthDate_up'] != NULL) {
    $user_update->set_birthDate($_GET['birthDate_up']);
}
    
if ($_GET['avatar_up'] != NULL) {
    $user_update->set_avatar($_GET['avatar_up']);
}

if (isset($user_update)) {
    $manager->update($user_update);
}
    
}
    


//~~ Supprimer

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
$user_del = $manager->get($id);
    $manager->delete($user_del);
    
}


// Récupérer les users
$resultats=$db->query('SELECT * FROM user');
$resultats->setFetchMode(PDO::FETCH_ASSOC);
while( $resultat = $resultats->fetch() )
{
        $toto = new User($resultat);
}      
$resultats->closeCursor();



echo "<br> <br>";
$listeUsers = $manager->getList();

?>

<h1>Saisir un utilisateur</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  
   <label for="username">Username :</label>
    <input type="text" name="username">
    
    <label for="password">Password :</label>
    <input type="password" name="password">
    
    <label for="mail">Mail :</label>
    <input type="mail" name="mail">
    
    <label for="birthDate">Birthdate :</label>
    <input type="text" name="birthDate">
    
    <label for="avatar">Avatar :</label>
    <input type="text" name="avatar">
    
    <input type="submit" value="Ajouter">
    
</form>

<h1>Update</h1>

<h2>Choisir un utilisateur à modifier</h2>

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <p>
       <label for="pays">Quel utilisateur modifier ?</label><br />
       <select name="user_update" id="user_update">
         <?php 
          for ($i=0; $i<count($listeUsers);$i++) {
            echo '<option value="'.$listeUsers[$i]->get_id().'">'.$listeUsers[$i]->get_username().'</option>';
            }               
        ?>
       </select>
       <input type="submit" value="Choisir">
       
   </p>
</form>

<?php 

if (isset($_GET['user_update'])) {

echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">';
  
echo '<label for="username_up">Username :</label>
    <input type="text" name="username_up" placeholder="'.$user_update->get_username().'">
    
    <label for="password_up">Password :</label>
    <input type="password" name="password_up" placeholder="'.$user_update->get_password().'">
    
    <label for="mail_up">Mail :</label>
    <input type="mail" name="mail_up" placeholder="'.$user_update->get_mail().'">
    
    <label for="birthDate_up">Birthdate :</label>
    <input type="text" name="birthDate_up" placeholder="'.$user_update->get_birthDate().'">
    
    <label for="avatar_up">Avatar :</label>
    <input type="text" name="avatar_up" placeholder="'.$user_update->get_avatar().'">
    
    <input type="hidden" name="user_update" value="'.$user_update->get_id().'">
    
    <input type="submit" value="Modifier">
    </form>';
    
    
}
    ?>



<h1>Tableau des Utilisateurs</h1>
<table>
   <caption>Utilisateurs</caption>

   <thead> <!-- En-tête du tableau -->
       <tr>
           <th>Username</th>
           <th>Password</th>
           <th>Mail</th>
           <th>Birthdate</th>
           <th>Avatar</th>
           <th>Rank</th>
           <th>Signupdate</th>           
           <th>Supprimer</th>
       </tr>
   </thead>
   
   <tbody>
<?php 
    
    for ($i=0; $i<count($listeUsers);$i++) {
    echo "<tr> <td>".$listeUsers[$i]->get_username()."</td> <td>".$listeUsers[$i]->get_password()."</td> <td>".$listeUsers[$i]->get_mail()."</td> <td>".$listeUsers[$i]->get_birthDate()."</td> <td>".$listeUsers[$i]->get_avatar()."</td> <td>".$listeUsers[$i]->get_rank()."</td> <td>".$listeUsers[$i]->get_signupDate()."</td> <td> <a href='?id_del=".$listeUsers[$i]->get_id()."'>Supprimer</a></td> </tr>";
   
    }
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>