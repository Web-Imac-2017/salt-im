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
$router->addRule('media/:id', array('controller' => 'Media', 'action' => 'index'));
$router->addRule('media/:id/img', array('controller' => 'Media', 'action' => 'img'));
$router->addRule('p/:id/media/add', array('controller' => 'Media', 'action' => 'add'));

// post routes
$router->addRule('p/post/add/:id', array('controller' => 'Post', 'action' => 'add'));
$router->addRule('p/:id', array('controller' => 'Post', 'action' => 'index'));
$router->addRule('p/post/remove/:id', array('controller' => 'Post', 'action' => 'remove'));
$router->addRule('p/comment/:id/:order', array('controller' => 'Comment', 'action' => 'commentsFromPost'));
$router->addRule('p/comment/:id', array('controller' => 'Comment', 'action' => 'commentsFromPostDefault'));
$router->addRule('p/u/:id', array('controller' => 'Post', 'action' => 'postFromUser'));
$router->addRule('p/:id/stat/up/:name', array('controller' => 'Stat', 'action' => 'upVote'));
$router->addRule('p/:id/stat/cancel/:name', array('controller' => 'Stat', 'action' => 'cancelVote'));
$router->addRule('p/:id/stat/vote', array('controller' => 'Stat', 'action' => 'voteStatus'));
// $router->addRule('p/help/', array('controller' => 'Post', 'action' => 'help'));
$router->addRule('p/tag', array('controller' => 'Post', 'action' => 'getFromTags'));
$router->addRule('p/:id/stat', array('controller' => 'Stat', 'action' => 'getStatPost'));
$router->addRule('p/all/stat/:id', array('controller' => 'Post', 'action' => 'sortPostsByStat'));
$router->addRule('p/all/date/:id', array('controller' => 'Post', 'action' => 'sortPostsByDate'));


// comment routes
$router->addRule('comment/get/:id', array('controller' => 'Comment', 'action' => 'index'));
$router->addRule('comment/u/:id', array('controller' => 'Comment', 'action' => 'commentFromUser'));
$router->addRule('comment/add/:id', array('controller' => 'Comment', 'action' => 'add'));
$router->addRule('comment/add/comment/:id', array('controller' => 'Comment', 'action' => 'addToComment'));
$router->addRule('p/comment/:id/:sort', array('controller' => 'Comment', 'action' => 'sortCommentsByStat'));

// User routes
$router->addRule('u/signup/:id', array('controller' => 'User', 'action' => 'signup_dirty'));
$router->addRule('u/signout', array('controller' => 'User', 'action' => 'signout'));
$router->addRule('u/login/:id', array('controller' => 'User', 'action' => 'login_dirty'));
$router->addRule('u/autologin/:id', array('controller' => 'User', 'action' => 'login'));
$router->addRule('u/logout', array('controller' => 'User', 'action' => 'logout'));
$router->addRule('u/name/:id', array('controller' => 'User', 'action' => 'name'));
$router->addRule('u/update/:id', array('controller' => 'User', 'action' => 'update'));
$router->addRule('u/:id', array('controller' => 'User', 'action' => 'index'));
$router->addRule('u/get/:id', array('controller' => 'User', 'action' => 'index'));
$router->addRule('u/:id/avatar', array('controller' => 'User', 'action' => 'avatar'));
$router->addRule('u/islogged/:id', array('controller' => 'User', 'action' => 'islogged'));
$router->addRule('u/:id/stat', array('controller' => 'Stat', 'action' => 'getStatUser'));
$router->addRule('u/session/:id', array('controller' => 'User', 'action' => 'who_dirty'));
$router->addRule('u/start/:id', array('controller' => 'User', 'action' => 'start'));
$router->addRule('u/close/:id', array('controller' => 'User', 'action' => 'close'));
$router->addRule('u/update/:id', array('controller' => 'User', 'action' => 'update'));

// tag routes
$router->addRule('tag/all', array('controller' => 'Tag', 'action' => 'getList'));
$router->addRule('tag/add/:id', array('controller' => 'Tag', 'action' => 'add'));
$router->addRule('tag/img', array('controller' => 'Tag', 'action' => 'img'));
$router->addRule('tag/get/:id', array('controller' => 'Tag', 'action' => 'tag_by_id'));
$router->addRule('tag/p/:id', array('controller' => 'Tag', 'action' => 'tag_from_post'));


$router->addRule('tag/:id/img', array('controller' => 'Tag', 'action' => 'img'));

// route de recherche qui marche maintenant

// search routes
$router->addRule('search/p/:search', array('controller' => 'Post', 'action' => 'search_title'));
$router->addRule('search/t/:search', array('controller' => 'Tag', 'action' => 'search_tags'));
$router->addRule('search/u/:search', array('controller' => 'User', 'action' => 'search_Users'));

// tag de débug A SUPPRIMER QUAND FINI
$router->addRule('u/test/:id', array('controller' => 'User', 'action' => 'test'));


// routes qui marchent pas
$router->addRule('p/help/', array('controller' => 'Post', 'action' => 'help'));


$router->load();

?>
