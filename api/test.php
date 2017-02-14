<?php
$user = new User([
  'mail' => 'jmich@gmail.com',
  'username' => 'Jean-Michel'
  'password' => md5('cacabite'),
  'avatar' => 'salt.it/img/potato.png',
  'birthDate' => '12/05/1972',
  'rank' => 'Fromage Blanc',
  'signupDate' => '31 Février 2017'
]);

require 'Database.php';
$manager = new UsersManager($db);
    
$manager->add($user);

?>