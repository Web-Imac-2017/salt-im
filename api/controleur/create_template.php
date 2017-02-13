<?php
    require 'Database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        // Mutliplier selon nombre d'attributs
        $nom_attributError = null;
         
        // keep track post values
        // Mutliplier selon nombre d'attributs
        $nom_attribut = $_POST['nom_attribut'];
         
        // validate input
        $valid = true;
        // Mutliplier selon nombre d'attributs
        if (empty($nom_attribut)) {
            $nom_attributError = 'Please enter [nom_attribut]';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO [nom_table] (nom_attribut1, nom_attribut2) values(?, ?, ?)"; //Autant de point d'intérogation que d'attributs
            $q = $pdo->prepare($sql);
            $q->execute(array($nom_attribut1,$nom_attribut2));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>