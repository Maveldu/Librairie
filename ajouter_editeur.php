<head>

        <meta charset="utf-8" />

        <link rel="stylesheet" href="menu.css" />

</head>


<?php


require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page

$idEditeur=$_POST['idEditeur'];
$idEditeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE ID_EDITEUR = "'.$idEditeur.'"');
$ligneResult = $idEditeurExist->rowCount();



if($ligneResult == 1){
	echo 'L\'éditeur que vous essayez de rentrer exise déjà';
}
else{
	$req = $bdd->prepare('INSERT INTO editeur(ID_EDITEUR, NOM) VALUES(:idEditeur, :nomEditeur)');
	$req->execute(array(
	'idEditeur' => strip_tags($_POST['idEditeur']),
	'nomEditeur' => strip_tags($_POST['nomEditeur'])));



echo 'L\'éditeur a bien été ajouté !';
}




?>

<a href=".php">Retour au menu</a>