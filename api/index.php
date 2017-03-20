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
// $router->addRule('p/help/', array('controller' => 'post', 'action' => 'help'));
$router->addRule('p/tag', array('controller' => 'post', 'action' => 'getFromTags'));
$router->addRule('p/:id/stat', array('controller' => 'stat', 'action' => 'getStatPost'));
$router->addRule('p/all/stat/:id', array('controller' => 'post', 'action' => 'sortPostsByStat'));


// comment routes
$router->addRule('comment/get/:id', array('controller' => 'comment', 'action' => 'index'));
$router->addRule('comment/u/:id', array('controller' => 'comment', 'action' => 'commentFromUser'));
$router->addRule('comment/add/:id', array('controller' => 'comment', 'action' => 'add'));
$router->addRule('comment/add/comment/:id', array('controller' => 'comment', 'action' => 'addToComment'));
$router->addRule('p/comment/:id/:sort', array('controller' => 'comment', 'action' => 'sortCommentsByStat'));

// user routes
$router->addRule('u/signup/:id', array('controller' => 'User', 'action' => 'signup'));
$router->addRule('u/signout', array('controller' => 'User', 'action' => 'signout'));
$router->addRule('u/login/:id', array('controller' => 'User', 'action' => 'login'));
$router->addRule('u/autologin/:id', array('controller' => 'User', 'action' => 'autologin'));
$router->addRule('u/logout', array('controller' => 'User', 'action' => 'logout'));
$router->addRule('u/name/:id', array('controller' => 'User', 'action' => 'name'));
$router->addRule('u/update/:id', array('controller' => 'User', 'action' => 'update'));
$router->addRule('u/:id', array('controller' => 'User', 'action' => 'index'));
$router->addRule('u/get/:id', array('controller' => 'User', 'action' => 'index'));
$router->addRule('u/:id/avatar', array('controller' => 'User', 'action' => 'avatar'));
$router->addRule('u/islogged/:id', array('controller' => 'User', 'action' => 'islogged'));
$router->addRule('u/:id/stat', array('controller' => 'stat', 'action' => 'getStatUser'));
$router->addRule('u/session/:id', array('controller' => 'User', 'action' => 'who'));
$router->addRule('u/start/:id', array('controller' => 'User', 'action' => 'start'));
$router->addRule('u/close/:id', array('controller' => 'User', 'action' => 'close'));
$router->addRule('u/update/:id', array('controller' => 'User', 'action' => 'update'));

// tag routes
$router->addRule('tag/all', array('controller' => 'Tags', 'action' => 'getList'));
$router->addRule('tag/add/:id', array('controller' => 'Tags', 'action' => 'add'));
$router->addRule('tag/img', array('controller' => 'Tags', 'action' => 'img'));
$router->addRule('tag/get/:id', array('controller' => 'Tags', 'action' => 'tag_by_id'));
$router->addRule('tag/p/:id', array('controller' => 'Tags', 'action' => 'tag_from_post'));


$router->addRule('tag/:id/img', array('controller' => 'Tags', 'action' => 'img'));

// route de recherche qui marche maintenant

// search routes
$router->addRule('search/p/:search', array('controller' => 'post', 'action' => 'search_title'));
$router->addRule('search/t/:search', array('controller' => 'Tags', 'action' => 'search_tags'));
$router->addRule('search/u/:search', array('controller' => 'User', 'action' => 'search_users'));

// tag de débug A SUPPRIMER QUAND FINI
$router->addRule('u/test/:id', array('controller' => 'User', 'action' => 'test'));


// routes qui marchent pas
$router->addRule('p/help/', array('controller' => 'post', 'action' => 'help'));


$router->load();

?>
