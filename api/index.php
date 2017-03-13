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
$router->addRule('media/:id/img', array('controller' => 'media', 'action' => 'img'));
$router->addRule('p/post/add/:id', array('controller' => 'post', 'action' => 'add'));
$router->addRule('p/:id', array('controller' => 'post', 'action' => 'index'));
$router->addRule('p/post/remove/:id', array('controller' => 'post', 'action' => 'remove'));
$router->addRule('comment/:id', array('controller' => 'comment', 'action' => 'index'));
$router->addRule('p/comment/:id/:order', array('controller' => 'comment', 'action' => 'commentsFromPost'));
$router->addRule('p/comment/:id', array('controller' => 'comment', 'action' => 'commentsFromPostDefault'));
$router->addRule('p/u/:id', array('controller' => 'post', 'action' => 'postFromUser'));
$router->addRule('comment/u/:id', array('controller' => 'comment', 'action' => 'commentFromUser'));
$router->addRule('comment/add/:id', array('controller' => 'comment', 'action' => 'add'));
$router->addRule('p/help/:id', array('controller' => 'post', 'action' => 'help'));
$router->addRule('u/signup/:id', array('controller' => 'user', 'action' => 'signup'));
$router->addRule('u/signout', array('controller' => 'user', 'action' => 'signout'));
$router->addRule('u/login', array('controller' => 'user', 'action' => 'login'));
$router->addRule('u/logout', array('controller' => 'user', 'action' => 'logout'));
$router->addRule('u/name/:id', array('controller' => 'user', 'action' => 'name'));
$router->addRule('u/update/:id', array('controller' => 'user', 'action' => 'update'));
$router->addRule('u/:id', array('controller' => 'user', 'action' => 'index'));
$router->addRule('p/tag', array('controller' => 'post', 'action' => 'getFromTags'));
$router->addRule('tag/all', array('controller' => 'tag', 'action' => 'getList'));
$router->addRule('tag/add', array('controller' => 'tag', 'action' => 'add'));
$router->addRule('tag/img', array('controller' => 'tag', 'action' => 'img'));
$router->addRule('p/:id/stat', array('controller' => 'stat', 'action' => 'getStatPost'));
$router->addRule('u/:id/stat', array('controller' => 'stat', 'action' => 'getStatUser'));
$router->addRule('tag/:id/img', array('controller' => 'tag', 'action' => 'img'));

$router->load();

?>
