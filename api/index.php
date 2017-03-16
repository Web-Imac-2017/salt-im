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

// SUR MA ROUTE OUIHIHI Y A EU DU MOUV OUIHIHI

// media routes
$router->addRule('media/:id', array('controller' => 'media', 'action' => 'index'));
$router->addRule('media/:id/img', array('controller' => 'media', 'action' => 'img'));
$router->addRule('p/:id/media/add', array('controller' => 'media', 'action' => 'add'));

// post routes
$router->addRule('p/post/add/:id', array('controller' => 'post', 'action' => 'add'));
$router->addRule('p/:id', array('controller' => 'post', 'action' => 'index'));
$router->addRule('p/post/remove/:id', array('controller' => 'post', 'action' => 'remove'));
$router->addRule('p/comment/:id/:order', array('controller' => 'comment', 'action' => 'commentsFromPost'));
$router->addRule('p/comment/:id', array('controller' => 'comment', 'action' => 'commentsFromPostDefault'));
$router->addRule('p/u/:id', array('controller' => 'post', 'action' => 'postFromUser'));
$router->addRule('p/:id/stat/up/:name', array('controller' => 'stat', 'action' => 'upVote'));
$router->addRule('p/:id/stat/cancel/:name', array('controller' => 'stat', 'action' => 'cancelVote'));
$router->addRule('p/:id/stat/vote', array('controller' => 'stat', 'action' => 'voteStatus'));
$router->addRule('p/help/:id', array('controller' => 'post', 'action' => 'help'));
$router->addRule('p/tag', array('controller' => 'post', 'action' => 'getFromTags'));
$router->addRule('p/:id/stat', array('controller' => 'stat', 'action' => 'getStatPost'));
$router->addRule('p/sort'), array('controller' => 'post', 'action' => 'getStatPost'));

// comment routes
$router->addRule('comment/get/:id', array('controller' => 'comment', 'action' => 'index'));
$router->addRule('comment/u/:id', array('controller' => 'comment', 'action' => 'commentFromUser'));
$router->addRule('comment/add/:id', array('controller' => 'comment', 'action' => 'add'));
$router->addRule('comment/add/comment/:id', array('controller' => 'comment', 'action' => 'addToComment'));

// user routes
$router->addRule('u/signup/:id', array('controller' => 'user', 'action' => 'signup'));
$router->addRule('u/signout', array('controller' => 'user', 'action' => 'signout'));
$router->addRule('u/login/:id', array('controller' => 'user', 'action' => 'login'));
$router->addRule('u/autologin/:id', array('controller' => 'user', 'action' => 'login'));
$router->addRule('u/logout', array('controller' => 'user', 'action' => 'logout'));
$router->addRule('u/name/:id', array('controller' => 'user', 'action' => 'name'));
$router->addRule('u/update/:id', array('controller' => 'user', 'action' => 'update'));
$router->addRule('u/:id', array('controller' => 'user', 'action' => 'index'));
$router->addRule('u/get/:id', array('controller' => 'user', 'action' => 'index'));
$router->addRule('u/:id/avatar', array('controller' => 'user', 'action' => 'avatar'));
$router->addRule('u/islogged/:id', array('controller' => 'user', 'action' => 'islogged'));
$router->addRule('u/:id/stat', array('controller' => 'stat', 'action' => 'getStatUser'));
$router->addRule('u/session/:id', array('controller' => 'user', 'action' => 'who'));
$router->addRule('u/start/:id', array('controller' => 'user', 'action' => 'start'));
$router->addRule('u/close/:id', array('controller' => 'user', 'action' => 'close'));

//tag routes
$router->addRule('tag/all', array('controller' => 'tag', 'action' => 'getList'));
$router->addRule('tag/add/:id', array('controller' => 'tag', 'action' => 'add'));
$router->addRule('tag/img', array('controller' => 'tag', 'action' => 'img'));
$router->addRule('tag/get/:id', array('controller' => 'tag', 'action' => 'tag_by_id'));


$router->addRule('tag/:id/img', array('controller' => 'tag', 'action' => 'img'));

// route de recherche qui marche pas
$router->addRule('search/p/:search', array('controller' => 'post', 'action' => 'search_title'));
$router->addRule('search/t/:search', array('controller' => 'tag', 'action' => 'search_tags'));
$router->addRule('search/u/:search', array('controller' => 'user', 'action' => 'search_users'));

// tag de débug A SUPPRIMER QUAND FINI
$router->addRule('u/test/:id', array('controller' => 'user', 'action' => 'test'));


$router->load();

?>