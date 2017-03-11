<?php  

//echo 'Index <br>';

require_once 'Router.class.php';

$router = Router::getInstance();
//Définition du dossier contenant les controlleur
$router->setPath('controller/');
// Si aucun controller n'est spécifié on appèlera accueilController et sa méthode index()
$router->setDefaultControllerAction('accueil','index');
// En cas d'url invalid on appèlera le controller errorController et sa méthode alert()
$router->setErrorControllerAction('error', 'alert'); 

$router->addRule('media/:id', array('controller' => 'media', 'action' => 'index'));
$router->addRule('p/post/add/:id', array('controller' => 'post', 'action' => 'add'));
$router->addRule('p/:id', array('controller' => 'post', 'action' => 'index'));
$router->addRule('p/post/remove/:id', array('controller' => 'post', 'action' => 'remove'));
$router->addRule('comment/:id', array('controller' => 'comment', 'action' => 'index'));
$router->addRule('p/comment/:id/:order', array('controller' => 'comment', 'action' => 'commentsFromPost'));
$router->addRule('comment/add/:id', array('controller' => 'comment', 'action' => 'add'));
$router->addRule('p/help/:id', array('controller' => 'post', 'action' => 'help'));
$router->addRule('u/register', array('controller' => 'user', 'action' => 'register'));
$router->addRule('p/tag', array('controller' => 'post', 'action' => 'getFromTags'));
$router->addRule('tag/all', array('controller' => 'tag', 'action' => 'getList'));

$router->load();

?>
