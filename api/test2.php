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

    //Connexion à la base
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

$manager = new UsersManager($db);

// Traitement du formulaire

//~~ Ajouter

if (isset($_GET['nom']) && isset($_GET['pv']) && isset($_GET['atk'])) {
    
$form_nom = $_GET['nom'];
$form_pv = $_GET['pv'];
$form_atk = $_GET['atk'];


$tab_new_perso = array(
    "nom" => $form_nom,
    "atk" => $form_atk,
    "pv" => $form_pv
    );

$new_perso = new Personnage($tab_new_perso);
$manager->add($new_perso);
    
}

//~~ Supprimer

if (isset($_GET['id_del'])) {
 $id = $_GET['id_del'];
    $manager->del($id);
    
}


// Récupérer les persos
$resultats=$conn->query('SELECT * FROM S4TP2_Personnages');
$resultats->setFetchMode(PDO::FETCH_ASSOC);
while( $resultat = $resultats->fetch() )
{
        $toto = new Personnage($resultat);
}      
$resultats->closeCursor();



echo "<br> <br>";
$listePersos = $manager->getList();

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
    
    <input type="hidden" name="rank" value="newbie">
    
    <input type="hidden" name="signupDate" value="<? echo date(Y-m-d) ?>">
    
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
    
    for ($i=0; $i<count($users);$i++) {
    echo "<tr> <td>".$personnages[$i]->getNom()."</td> <td>".$personnages[$i]->getPv()."</td> <td>".$personnages[$i]->getAtk()."</td> <td> <a href='index.php?id_del=".$personnages[$i]->getId() ."'>Supprimer</a></td> </tr>";
   
    }
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>