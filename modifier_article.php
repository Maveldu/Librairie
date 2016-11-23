

<?php

require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page



	$req = $bdd->prepare('UPDATE article 
						SET TITRE = :titre, QUANTITE_STOCK = :quantiteStock, COLLECTION = :collection, DATE_PARUTION = :dateParution, NUMERO_COLLECTION = :numeroCollection, 
						EDITION = :edition, PRIX = :prix, RESUME = :resume, NOTE_GERANT = :noteGerant, SUPPORT = :support where ISBN_ISSN = "'.$_POST['isbn'].'"');
	$req->execute(array(
	'titre' => strip_tags($_POST['titre']),
	'quantiteStock' => strip_tags($_POST['quantiteStock']),
	'collection' =>strip_tags($_POST['collection']),
	'dateParution' =>strip_tags($_POST['dateParution']),
	'numeroCollection' =>strip_tags($_POST['numeroCollection']),
	'edition' =>strip_tags($_POST['edition']),
	'prix' =>strip_tags(str_replace(',', '.' , $_POST['prix'])),
	'resume' =>strip_tags($_POST['resume']),
	'noteGerant' =>strip_tags($_POST['noteGerant']),
	'support' =>strip_tags($_POST['support'])));

echo 'L\'article a bien été modifié !';

?>

<a href="index.php" class="bouton">Retour au menu</a></div>

<?php


?>







