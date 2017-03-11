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

$tab_new_tag = array(
    "name" => $_GET['name']
    );

$new_user = new User($tab_new_tag);
$manager->add($new_tag);

    
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
    echo "<tr> <td>".$listeUsers[$i]->get_username()."</td> <td>".$listeUsers[$i]->get_password()."</td> <td>".$listeUsers[$i]->get_mail()."</td> <td>".$listeUsers[$i]->get_birthDate()."</td> <td>".$listeUsers[$i]->get_avatar()."</td> <td>".$listeUsers[$i]->get_rank()."</td> <td>".$listeUsers[$i]->get_signupDate()."</td> <td> <a href='test2.php?id_del=".$listeUsers[$i]->get_id()."'>Supprimer</a></td> </tr>";
   
    }
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>