<?php 
// Vérification de la validité des informations

// Hachage du mot de passe
$pass_hache = sha1('gz' . $_POST['pass']);

// Insertion
$req = $bdd->prepare('INSERT INTO user(username, password, mail, avatar, birthDate, rank, singupDate, badge_id) VALUES(:pseudo, :pass, :email, :avatar, :birthDate, :rank, :badge,  CURDATE())');

$req->execute(array(
    'pseudo' => $username,
    'pass' => $pass_hache,
    'email' => $mail,
    'avatar' => $avatar,
    'birthDate' => $birthDate,
    'rank' => $rank,
    'badge' => $badge_id));

$resultat = $req->fetch();

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else {
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $username;
    echo 'Vous êtes connecté !';
}