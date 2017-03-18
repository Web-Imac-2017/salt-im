<?php

$user_id = $_GET['id'];
session_start(oid)
$token = $_GET['token'];
require 'connect.php';
$req = $pdo->prepare('SELECT * FROM user WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if($user && $user->token == $token ){
    $pdo->prepare('UPDATE user SET token = NULL, token_date = NOW() WHERE id = ?')->execute([$user_id]);
    $_SESSION['flash']['success'] = 'Compte validé';
    $_SESSION['auth'] = $user;
    
}else{
    $_SESSION['flash']['danger'] = " token non valide";

}

?>