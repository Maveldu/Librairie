<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=librairie4.0;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$rep = $bdd->query('SELECT max(ID_AUTEUR) as id FROM AUTEUR');
$donnees = $rep->fetch();


$req = $bdd->prepare('INSERT INTO auteur(ID_AUTEUR, NOM_AUTEUR, PRENOM_AUTEUR) VALUES(:idAuteur, :nomAuteur, :prenomAuteur)');
$req->execute(array(
    'idAuteur' => ($donnees['id'] + 1),
    'nomAuteur' => strip_tags($_POST['nomAuteur']),
    'prenomAuteur' => strip_tags($_POST['prenomAuteur'])));


echo 'L\'auteur a bien été ajouté !';


?>

<a href="http://localhost/librairie/menu.php">Retour au menu</a>