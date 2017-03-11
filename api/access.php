<?php
//C'est une fonction qui check si t'es connecté 
function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SES<?phpSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        exit();
    }
}


?>
