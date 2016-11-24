<?php
session_start();
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>

<html>

		<style>

		.aucentre {
			text-align: center;
		}

		label {
			display: block;
			width: 150px;
			float: left;
		}

		body #maincontent {
			width: 90%;
			min-height: 400px;
		}

		#maincontent {
    		padding: 32px 16px;
    		max-width: 894px;
    		min-width: 320px;
		}

		body #maincontent, body .pageSectionContainer, body #c_content {
    		margin: 1 auto;
   			margin-top: 0px;
   			margin-right: auto;
    		margin-bottom: 0px;
    		margin-left: 400px;
		}


		</style><br/>
<body>
<fieldset>
	<div id ="maincontent">
<?php 
	if(isset($_SESSION['id'])){
		echo "<p> Vous êtes connecté, vous ne pouvez pas vous inscrire ! </p>";
	}
	else{ ?>
<form  method="post">
	<p>
			<fieldset>
			<legend> Identifiants :</legend>
				<label class="text-base"  for="pseudo">Pseudonyme: *</label>
		    	<input type="text" name="pseudo" pattern="[a-zA-Z0-9]{4,}$"/><br /><br />
				<label  for="passe">Mot de passe: *</label>
				<input type="password" name="passe" pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
				<label >Confirmation du mot de passe: *</label>
				<input type="password" name="passe2"/><br/><br/>
			</fieldset>

			<fieldset>
		    <legend>Adresse Postale: </legend>
				<label class="text-base"  for="rue">Adresse: *</label>
				<input type="text" name="adresse" pattern="([a-zA-Z0-9](\s){,1}){4,}$"/><br /><br />
				<label class="text-base"  for="postale">Code Postale: *</label>
				<input type="text" name="postale" pattern="[0-9]{5,5}$"/><br /><br />
				<label class="text-base"  for="ville">Ville: *</label>
				<input type="text" name="ville" pattern="[a-zA-Z]{2,}$"/><br /><br />
			</fieldset>

			<fieldset>
			<legend>Coordonnées</legend>
				<label class="text-base"  for="nom">Nom: *</label>
				<input type="text" name="nom" pattern="[a-zA-Z]{2,}$"/><br /><br />
				<label class="text-base"  for="prenom">Prenom: *</label>
				<input type="text" name="prenom" pattern="[a-zA-Z]{2,}$"/><br /><br />
				<label  >Adresse e-mail: *</label>
				<input type="text" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/><br/><br/>
				<label class="text-base"  for="numero">Numero de téléphone: *</label>
				<input type="text" name="numero" pattern="[0-9]{10,12}"/><br /><br />
			</fieldset>
			<br/>
			<input class="btn btn-default" type="submit" name="valider" value="S'inscrire"/>
	<input class="btn btn-default" type="button" name="Retour" value="Retour" onclick="self.location.href='index.php'">
	</p>
</form>
<?php } ?>
</div>
</fieldset>
</body>
</html>


<!--VERIFICATION DU FORMULAIRE-->
<?php
	if(isset($_POST['valider'])){
		$i = 1;


	if((empty($_POST['pseudo'])))
	{
		$i = 0;
		$text = "Veuillez rentrer un identifiant";
	}
		if((empty($_POST['nom'])))
		{
			$i = 0;
			$text = "Veuillez rentrer un nom";
		}
		if((empty($_POST['prenom'])))
		{
			$i = 0;
			$text = "Veuillez rentrer un prenom";
		}
		if((empty($_POST['adresse'])))
		{
			$i = 0;
			$text = "Veuillez rentrer une adresse postale";
		}
		if((empty($_POST['postale'])))
		{
			$i = 0;
			$text = "Veuillez rentrer un code postale";
		}
		if((empty($_POST['ville'])))
		{
			$i = 0;
			$text = "Veuillez rentrer une ville";
		}
		if((empty($_POST['numero'])))
		{
			$i = 0;
			$text = "Veuillez rentrer un numero de telephone";
		}
	else{
		$nbligne = $bdd->query('SELECT IDENTIFIANT FROM compte WHERE IDENTIFIANT = \''.$_POST['pseudo'].'\' ');
		$nbligne = $nbligne->rowCount();
		if($nbligne != 0){
			$text = "le nom de compte existe déjà";
		}

	}
	if( (!empty($_POST['passe']) && !empty($_POST['passe2'])) && ($i == 1)) {
		if($_POST['passe'] != $_POST['passe2']){

			$i = 0;
			$text = "Les mots de passes ne correspondent pas";
		}
	}
	else if($i == 1){
		$i = 0;
		$text = "merci de rentrer un mot de passe";
	}


	if($i == 1){

		$nb = $bdd->query('SELECT max(NUMERO_COMPTE) as max FROM compte');
		$nb = $nb->fetch();
		$bdd->exec('INSERT INTO compte(NUMERO_COMPTE, IDENTIFIANT, MOT_DE_PASSE, ADRESSE_MAIL, ADRESSE, CODE_POSTALE, VILLE) 
					VALUES(
					 \''.strip_tags($nb['max']+1).'\',
					 \''.strip_tags($_POST['pseudo']).'\',
					 \''.strip_tags(md5($_POST['passe'])).'\',
					 \''.strip_tags($_POST['email']).'\',
					 \''.strip_tags($_POST['adresse']).'\',
					 \''.strip_tags($_POST['postale']).'\',
					 \''.strip_tags($_POST['ville']).'\')');
		$bdd->exec('INSERT INTO client(NUMERO_COMPTE, NOM, PRENOM) 
					VALUES(
					 \''.strip_tags($nb['max']+1).'\',
					 \''.strip_tags($_POST['nom']).'\',
					 \''.strip_tags($_POST['prenom']).'\')');

		echo"<p> Vous êtes bien inscris ! </p>";

	}
	else{
		echo "<p>".$text."</p>";
	}
}

?>


