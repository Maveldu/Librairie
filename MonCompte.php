
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'menu.php';
?>

<html>

	
<br/><br/>
<br/><br/>

<body>
<fieldset>
<center>
    <div id ="maincontent"> 
	
		<fieldset>
		<legend>Compte</legend>
		<label class="text-base" for="rue">Identifiant :</label>
		<?php echo($_SESSION['id']); ?> <br/>
		</fieldset>
		
		</br>
		
		<fieldset>
		<legend>Coordonnées</legend>
		<label class="text-base" for="rue">Nom :</label>
		<?php if (f_compte($bdd)=="admin") { ?>
		<?-<p> Admin </p>
		<?php } ?>
		<?php }else if (f_compt($bdd)=="gerant") ?>		
		<p> Gérant </p>
		<?php } ?>
		
		<?php else
				$count = $bdd->prepare("SELECT NOM FROM from compte join compte_client using (NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				foreach ($req as $test) {
						echo $test;
				}	
		?><br/>
				
		<label class="text-base" for="rue">Prénom :</label>			
		<?php
				$count = $bdd->prepare("SELECT PRENOM FROM compte_client join compte using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo $test;
					}	
				?><br/>
		
		
		<label class="text-base" for="rue">Adresse Mail : </label>			
		<?php
				$count = $bdd->prepare("SELECT ADRESSE_MAIL FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo $test;
					}	
				?><br/>
				
		<label class="text-base" for="rue">Numéro de télephone :</label>			
		<?php
				$count = $bdd->prepare("SELECT NUMERO_TELEPHONE FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo "0".$test;
					}	
				?><br/>
				
		</fieldset>		
		
		<fieldset>
		<legend>Adresse Postale </legend>	
		<label class="text-base" for="rue">Adresse :</label>
		<?php
				$count = $bdd->prepare("SELECT ADRESSE FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo $test;
					}
					?><br/>
					
				<label class="text-base">Ville :</label>	
				<?php
				$count = $bdd->prepare("SELECT VILLE FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo $test;
					}	
				?>	<br/>
				<label class="text-base">Code Postale :</label>	
				<?php
				$count = $bdd->prepare("SELECT CODE_POSTALE FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				
					foreach ($req as $test) {
						echo $test;
					}	
				?>
		</fieldset>			
	</center>
</body>