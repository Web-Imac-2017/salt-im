<?php
include 'User.php';
include 'UsersManager.php';

$user = new User([
  'mail' => 'jmich@gmail.com',
  'username' => 'Jean-Michel',
  'password' => 'cacabite',
  'avatar' => 'salt.it/img/potato.png',
  'birthDate' => '1982-02-19',
  'rank' => 1,
  'signupDate' => '2017-02-19'
]);

try {
$db = new PDO('mysql:host=127.0.0.1;dbname=salt', 'root', '');
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$manager = new UsersManager($db);
    
$manager->add($user);

?>