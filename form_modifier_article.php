<?php
session_start();
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>

<?php

	$isbnact = $_POST['modifier'];
	
	$result = $bdd->query( 'SELECT * FROM article WHERE  ISBN_ISSN LIKE "' .$isbnact. '"');



	$post = $result->fetch();
	$titre = $post['TITRE'];
    $isbn = $post['ISBN_ISSN'];
    $quantiteStock = $post['QUANTITE_STOCK'];
    $editeur= $post['NOM_EDITEUR'];
    $collection = $post['COLLECTION'];
    $dateParution= $post['DATE_PARUTION'];
    $numeroCollection= $post['NUMERO_COLLECTION'];
    $edition= $post['EDITION'];
    $prix= $post['PRIX'];
    $resume= $post['RESUME'];
    $noteGerant= $post['NOTE_GERANT'];
    $support= $post['SUPPORT'];

	?>


<br/><br/>
<br/><br/>
    <fieldset>

	<form action="modifier_article.php" method="post">

		<p>

			 
		<?php echo "
			<label for='isbn'>ISBN:</label>		<input required type='text' value='$isbn' name='isbn' placeholder='Entrez un ISBN' readonly /><br /> <br />"; ?>

			<label for='Titre'>Titre:</label>	<input required type='text' value="<?php echo $titre ?>" name='titre' pattern='/^[\p{L}-. ]*$/u'/><br /><br />

			<?php echo "

			<label for='Quantité en stock'>Quantité en stock:</label>	<input type='text' value=$quantiteStock name='quantiteStock' pattern='[0-9]{0,10}' /><br /><br />

			<label for='Editeur'>Editeur:</label>	<input required type='text' value='$editeur' name='editeur' readonly/><br /><br />

			<label for='Collection'>Collection:</label>	<input type='text' value='$collection' name='collection' pattern='/^[\p{L}-. ]*$/u'/><br /><br />

			<label for='Date de parution'>Date de parution:</label>	<input required type='date' value=$dateParution name='dateParution' /><br /><br />

			<label for='Numero de collection'>Numéro de collection:</label>		<input type='text' value='$numeroCollection' name='numeroCollection' pattern='[0-9]{0,10}' /><br /><br />

			<label for='Edition'>Édition:</label>	<input type='text' value='$edition' name='edition' pattern='[a-Z]'/><br /><br />

			<label for='Prix'>Prix:</label>		<input  type='text' value='$prix' name='prix' pattern='[0-9]{1,}[.,]{0,1}[0-9]{0,2}'/>  <br /><br />

			<label for='Resume'>Résumé:</label>		<textarea name='resume' rows='8' cols='45'>".$resume."</textarea><br /><br />

			<label for='Note du gérant'>Note du gérant:</label>		<input type='text' value='$noteGerant' name='noteGerant' pattern='[a-Z]'/><br /><br />

			<label for='Support'>Support:</label>  

			<select name='support'><option value=$support>papier</option><option value='choix2'>numerique</option></select><br /><br />
			"; ?>
		
   		</p>

	<input type="submit" value="Valider" />
	<br /><br />

	</form>
	</fieldset>

</html>


