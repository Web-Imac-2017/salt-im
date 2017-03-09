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
require "Badge.php";
require "BadgesManager.php";

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

$manager = new BadgesManager($db);

// Traitement du formulaire

//~~ Ajouter

if (isset($_GET['name'])&& isset($_GET['cond'])&& isset($_GET['icon'])) {

    echo("hello");

$tab_new_badge = array(
    "name" => $_GET['name'],
    "cond" => $_GET['cond'],
    "icon" => $_GET['icon']
    );

$new_badge = new Badge($tab_new_badge);
$manager->add($new_badge);
    
}

//~~ Supprimer

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
$badge_del = $manager->get($id);
    var_dump($badge_del);
    $manager->delete($badge_del);
    
}


// Récupérer les tags
$resultats=$db->query('SELECT * FROM badge');
$resultats->setFetchMode(PDO::FETCH_ASSOC);
while( $resultat = $resultats->fetch() )
{
        $toto = new Badge($resultat);
}      
$resultats->closeCursor();



echo "<br> <br>";
$listeBadges = $manager->getList();

?>

<h1>Saisir un Badge</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  
    <label for="name">Name :</label>
    <input type="text" name="name">
    <label for="cond">Cond :</label>
    <input type="text" name="cond">
    <label for="icon">Icon :</label>
    <input type="text" name="icon">

    
    <input type="submit" value="Ajouter">
    
</form>



<h1>Tableau des Badges</h1>
<table>
   <caption>Badges</caption>

   <thead> <!-- En-tête du tableau -->
       <tr>
           <th>Name</th>
       </tr>
   </thead>
   
   <tbody>
<?php 
    
    for ($i=0; $i<count($listeBadges);$i++) {
    echo "<tr> <td>".$listeBadges[$i]->get_name()."</td><td>".$listeBadges[$i]->get_cond()."</td><td>".$listeBadges[$i]->get_icon()."</td><td> <a href='?id_del='".$listeBadges[$i]->get_id()."'>Supprimer</a></td> </tr>";
   
    }

    
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>