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
//require "Tag.php";
require "TagsManager.php";

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

$manager = new TagsManager($db);

// Traitement du formulaire

//~~ Ajouter

if (isset($_GET['name'])) {

$tab_new_tag = array(
    "name" => $_GET['name']
    );

$new_tag = new Tag($tab_new_tag);
$manager->add($new_tag);
    
}

//~~ Supprimer

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
$tag_del = $manager->get($id);
    $manager->delete($tag_del);
    
}


// Récupérer les tags
$resultats=$db->query('SELECT * FROM tag');
$resultats->setFetchMode(PDO::FETCH_ASSOC);
while( $resultat = $resultats->fetch() )
{
        $toto = new Tag($resultat);
}      
$resultats->closeCursor();



echo "<br> <br>";
$listeTags = $manager->getList();

?>

<h1>Saisir un utilisateur</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  
   <label for="name">Name :</label>
    <input type="text" name="name">
    
    <input type="submit" value="Ajouter">
    
</form>


<h1>Tableau des Tags</h1>
<table>
   <caption>Tags</caption>

   <thead> <!-- En-tête du tableau -->
       <tr>
           <th>Name</th>
       </tr>
   </thead>
   
   <tbody>
<?php 
    
    for ($i=0; $i<count($listeTags);$i++) {
    echo "<tr> <td>".$listeTags[$i]->get_name()."</td><td> <a href='?id_del='".$listeTags[$i]->get_id()."'>Supprimer</a></td> </tr>";
   
    }

    
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>