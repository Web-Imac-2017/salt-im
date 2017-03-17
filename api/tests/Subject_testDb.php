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
require "Subject.php";
require "SubjectsManager.php";

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

$manager = new SubjectsManager($db);

// Traitement du formulaire

//~~ Ajouter

if (isset($_GET['title']) && isset($_GET['flair']) && isset($_GET['type']) && isset($_GET['text'])  && isset($_GET['date'])) {

$tab_new_media = array(
    "text" => $_GET['text'],
    "date" => $_GET['date'],
    "type" => $_GET['type'],
    "flair" => $_GET['flair'],
    "title" => $_GET['title'],

    );

$new_subject = new Subject($tab_new_subject);
$manager->add($new_subject);
    
}

//~~ Supprimer

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
$subject_del = $manager->get($id);
    $manager->delete($subject_del);
    
}


// Récupérer les medias
$resultats=$db->query('SELECT * FROM subject');
$resultats->setFetchMode(PDO::FETCH_ASSOC);
while( $resultat = $resultats->fetch() )
{
        $toto = new Subject($resultat);
}      
$resultats->closeCursor();



echo "<br> <br>";
$listeSubjects = $manager->getList();

?>

<h1>Saisir un sujets</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  
   <label for="link">Link :</label>
    <input type="text" name="link">
    
    <label for="type">Type :</label>
    <input type="text" name="type">
    
    <input type="submit" value="Ajouter">
    
</form>


<h1>Tableau des Medias</h1>
<table>
   <caption>Medias</caption>

   <thead> <!-- En-tête du tableau -->
       <tr>
           <th>Link</th>
           <th>Type</th>          
           <th>Supprimer</th>
       </tr>
   </thead>
   
   <tbody>
<?php 
    
    for ($i=0; $i<count($listeMedias);$i++) {
    echo "<tr> <td>".$listeMedias[$i]->get_link()."</td> <td>".$listeMedias[$i]->get_type()."</td><td> <a href='Media_testDb.php?id_del=".$listeMedias[$i]->get_id()."'>Supprimer</a></td> </tr>";
   
    }
    
    ?>
    </tbody>
</table>






    </body>


</body>
</html>