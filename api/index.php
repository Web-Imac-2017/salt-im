<?php  

//echo 'Index <br>';

require 'Router.class.php';

$router = Router::getInstance();
//Définition du dossier contenant les controlleur
$router->setPath('controller/');
// Si aucun controller n'est spécifié on appèlera accueilController et sa méthode index()
$router->setDefaultControllerAction('accueil','index');
// En cas d'url invalid on appèlera le controller errorController et sa méthode alert()
$router->setErrorControllerAction('error', 'alert'); 
$router->addRule('p/:id', array('controller' => 'post', 'action' => 'index'));
$router->load();

?>