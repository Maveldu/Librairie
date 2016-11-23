<head>

        <meta charset="utf-8" />

        <link href="css/bootstrap.css" rel="stylesheet">

</head>



<?php


require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page


$isbn_issn=str_replace('-', '', $_POST['isbn']);

$editeur=$_POST['editeur'];

$editeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE NOM = "'.$editeur.'"');
$ligneResult = $editeurExist->rowCount();

$isbnExist = $bdd->query('SELECT ISBN_ISSN FROM article WHERE ISBN_ISSN = "'.$isbn_issn.'"');
$ligneResult2 = $isbnExist->rowCount();


$auteur = explode (' ', $_POST['auteur']);
$aut = $bdd->query('SELECT ID_AUTEUR FROM auteur WHERE NOM_AUTEUR = "'.$auteur[0].'" AND PRENOM_AUTEUR = "'.$auteur[1].'"');
	$ida = $aut->fetch();
$idauteur = $ida['ID_AUTEUR'];
$isbnEditeur = explode ('-', $_POST['isbn']);

if(strlen($isbn_issn) == 10){
	$isbnEditeur = $isbnEditeur[1];
}
else $isbnEditeur = $isbnEditeur[2];


$rep = $bdd->query('SELECT ID_EDITEUR AS id FROM editeur WHERE NOM = "'.$editeur.'"');
	$donnees = $rep->fetch();

$idEditeur=($donnees['id']);

if($ligneResult != 1){

	echo 'L\'éditeur n\'existe pas, créez le d\'abord';
	include('form_ajouter_editeur.php');
	
}

else if($ligneResult2 == 1){
	echo 'L\'ISBN que vous essayez de rentrer existe déjà';
	include ('form_ajouter_article.php');
}

else if($isbnEditeur != $idEditeur){
	
	 
	echo 'L\'ISBN entré ne correspond pas à l\'éditeur';
	include ('form_ajouter_article.php');

}

else{


	

	$req = $bdd->prepare('INSERT INTO article(ISBN_ISSN, ID_EDITEUR, TITRE, QUANTITE_STOCK, NOM_EDITEUR, COLLECTION, DATE_PARUTION, NUMERO_COLLECTION, EDITION, PRIX, RESUME, NOTE_GERANT, SUPPORT ) 
						VALUES(:isbn, :idEditeur, :titre, :quantiteStock, :editeur, :collection, :dateParution, :numeroCollection, :edition, :prix, :resume, :noteGerant, :support)');
	$req->execute(array(
	'isbn' => strip_tags(strtoupper(str_replace('-', '', $_POST['isbn']))),
	'idEditeur' => strip_tags($donnees['id']),
	'titre' => strip_tags($_POST['titre']),
	'quantiteStock' => strip_tags($_POST['quantiteStock']),
	'editeur' => strip_tags($editeur),
	'collection' =>strip_tags($_POST['collection']),
	'dateParution' =>strip_tags($_POST['dateParution']),
	'numeroCollection' =>strip_tags($_POST['numeroCollection']),
	'edition' =>strip_tags($_POST['edition']),
	'prix' =>strip_tags(str_replace(',', '.' , $_POST['prix'])),
	'resume' =>strip_tags($_POST['resume']),
	'noteGerant' =>strip_tags($_POST['noteGerant']),
	'support' =>strip_tags($_POST['support'])));

	$reqa = $bdd->prepare('INSERT INTO ecrire(ID_AUTEUR, ISBN_ISSN) VALUES( :idauteur, :isbn)');
	$reqa->execute(array(
		'idauteur' => strip_tags($idauteur),
		'isbn' => strip_tags(strtoupper(str_replace('-', '', $_POST['isbn'])))));
echo 'L\'article a bien été ajouté !';

?>

<a href="http://localhost/librairie/menu.php" class="bouton">Retour au menu</a></div>

<?php

}

?>







