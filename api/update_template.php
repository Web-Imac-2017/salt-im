<?php
    require 'Database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
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
            $nom_attributError = 'Please enter nom_attribut';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE nom_table  set name = ?, email = ?, mobile =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        Database::disconnect();
    }
?>