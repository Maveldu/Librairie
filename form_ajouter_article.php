<html>
<link rel="icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="Style.css" />
</html>
<?php

session_start();
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';


$auteurs = $bdd->query('SELECT NOM_AUTEUR, PRENOM_AUTEUR, ID_AUTEUR FROM auteur');
$editeurs = $bdd->query('SELECT NOM, ID_EDITEUR FROM editeur');
?>


<br/><br/>
<br/><br/>

    <fieldset>
		

	<form class="form-group" method="post">

		<p>
			<div id="gauche" class="form-group">

				<div  class="form-group">
				<label class="col-md-2 control-label" for="ISBN">ISBN:</label>		
				<input required type="text" name="isbn" placeholder="ISBN" pattern="(?:(?=.{17}$)97[89][ -](?:[0-9]+[ -]){2}[0-9]+[ -][0-9]|97[89][0-9]{10}|(?=.{13}$)(?:[0-9]+[ -]){2}[0-9]+[ -][0-9Xx]|[0-9]{9}[0-9Xx])"/><br /> <br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Titre">Titre:</label>	
				<input required type="text" name="titre" placeholder="Titre" pattern="/^[\p{L}-. ]*$/u"/><br /><br />
				</div>

			

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Quantité en stock">Quantité en stock:</label>	
				<input required type="text" name="quantiteStock" placeholder="Quantité" pattern="[1-9][0-9]{0,10}" /><br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Editeur">Editeur:</label>	
				<input required name="editeur" placeholder="Editeur" type="text" pattern="/^[\p{L}-. ]*$/u" list="editeur" autocomplete="off"/><br /><br />
					<datalist id="editeur">
							
					<?php while( $post = $editeurs->fetch() )
	   				{		
						echo "<option label='".$post['ID_EDITEUR']."'value='".$post['NOM']."' >".$post['NOM']."</option> ";
					} ?>
					</datalist> <br /><br />
				</div>


				<div  class="form-group">
				<label class="col-md-2 control-label" for="Collection">Collection:</label>	
				<input type="text" name="collection" placeholder="Collection" pattern="/^[\p{L}-. ]*$/u"/><br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Date de parution">Date de parution:</label>	
				<input required type="date" name="dateParution" /><br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Numero de collection">Numéro de collection:</label>		
				<input type="text" name="numeroCollection" placeholder="N°collection" pattern="[0-9]{0,10}" /><br /><br />
				</div>

			</div>
		


			<div id="droite" class="form-group">

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Edition">Édition:</label>	
				<input type="text" name="edition" placeholder="Edition" pattern="[a-Z]"/><br /><br />
				</div>

				

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Auteur">Nom de l'auteur:</label>  
				<input required name="auteur" placeholder="Nom auteur" type="text" list="auteur" autocomplete="off"/><br /><br />
					<datalist id="auteur">
						<?php while( $post = $auteurs->fetch() )
	   					{		
							echo "<option id='auteur' label='' value='".$post['NOM_AUTEUR']." ".$post['PRENOM_AUTEUR']." ' ></option> ";
						} ?>
					</datalist> 
				</div>


				<div  class="form-group">
				<label class="col-md-2 control-label" for="Prix">Prix:</label>		
				<input require  type="text" name="prix" placeholder="Prix" pattern="[0-9]{1,}[.,]{0,1}[0-9]{0,2}"/>  <br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Resume">Résumé:</label>		
				<textarea name="resume" placeholder="Résumé" rows="8" cols="45"></textarea><br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Note du gérant">Note du gérant:</label>		
				<input type="text" name="noteGerant" placeholder="Note" pattern="[a-Z]"/><br /><br />
				</div>

				<div  class="form-group">
				<label class="col-md-2 control-label" for="Support">Support:</label>  
					<select name="support"><option value="papier">papier</option><option value="choix2">numerique</option></select><br /><br />
				</div>

			</div>

		

   		</p>

   	
   		<p align="center"><input class="btn btn-default" type="submit" name="valider" value="Valider" /></p>
   	

	</fieldset>
	<br /><br />
	

	</form>


</html>

<?php
if(isset($_POST['valider'])){


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
	
}

else if($ligneResult2 == 1){
	echo 'L\'ISBN que vous essayez de rentrer existe déjà';
}

else if($isbnEditeur != $idEditeur){
	
	 
	echo 'L\'ISBN entré ne correspond pas à l\'éditeur';

}

else{


	

	$bdd->exec('INSERT INTO article(ISBN_ISSN, ID_EDITEUR, TITRE, QUANTITE_STOCK, NOM_EDITEUR, COLLECTION, DATE_PARUTION, NUMERO_COLLECTION, EDITION, PRIX, RESUME, NOTE_GERANT, SUPPORT ) 
						VALUES(\''.strip_tags(strtoupper(str_replace('-', '', $_POST['isbn']))).'\',
							\''.strip_tags($donnees['id']).'\',
							\''.strip_tags($_POST['titre']).'\',
							\''.strip_tags($_POST['quantiteStock']).'\',
							\''.strip_tags($editeur).'\',
							\''.strip_tags($_POST['collection']).'\',
							\''.strip_tags($_POST['dateParution']).'\',
							\''.strip_tags($_POST['numeroCollection']).'\',
							\''.strip_tags($_POST['edition']).'\',
							\''.strip_tags(str_replace(',', '.' , $_POST['prix'])).'\',
							\''.strip_tags($_POST['resume']).'\',
							\''.strip_tags($_POST['noteGerant']).'\',
							\''.strip_tags($_POST['support']).'\'
							)');

	$bdd->exec('INSERT INTO ecrire(ID_AUTEUR, ISBN_ISSN) 
						VALUES( \''.strip_tags($idauteur).'\',
	 						\''.strip_tags(strtoupper(str_replace('-', '', $_POST['isbn']))).'\'
	 						)');
echo 'L\'article a bien été ajouté !';

}
}
?>