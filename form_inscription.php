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


		</style>


<br/><br/>
<br/><br/>

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


		
			<label class="text-base"  for="pseudo">Pseudonyme: </label>
			<input type="text" name="pseudo" pattern="[a-z0-9]{4,}$"/><br /><br />
		

			
			<label  for="passe">Mot de passe: </label>
			<input type="password" name="passe" pattern="[a-z0-9]{4,}$"/><br/><br/>
			

			
			<label >Confirmation du mot de passe: </label>
			<input type="password" name="passe2"/><br/><br/>
			

			
			<label  >Adresse e-mail: </label>
			<input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/><br/><br/>
			

			<input class="btn btn-default" type="submit" name="valider" value="S'inscrire"/>

		
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
		$bdd->exec('INSERT INTO compte(NUMERO_COMPTE, IDENTIFIANT, MOT_DE_PASSE, ADRESSE_MAIL) 
					VALUES(
					 \''.strip_tags($nb['max']+1).'\',
					 \''.strip_tags($_POST['pseudo']).'\',
					 \''.strip_tags(md5($_POST['passe'])).'\',
					 \''.strip_tags($_POST['email']).'\')');

		echo"<p> Vous êtes bien inscris ! </p>";

	}
	else{
		echo "<p>".$text."</p>";
	}
}

?>


