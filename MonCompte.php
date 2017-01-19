<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
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
		<?php
				$count = $bdd->prepare("SELECT NOM FROM compte join client using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
				$count->execute(array($_SESSION['id']));
				$req = $count->fetch(PDO::FETCH_ASSOC);
				foreach ($req as $test) {
						echo $test;
					}	
				?><br/>
				
		<label class="text-base" for="rue">Prénom :</label>			
		<?php
				$count = $bdd->prepare("SELECT PRENOM FROM compte join client using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
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
		<fieldset>
			<legend>Mes commandes : </legend>

			<label class="text-base" for="rue">Numero Commande :</label>
			<?php
			$count = $bdd->prepare("SELECT NUMERO_COMMANDE FROM compte join commande using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);

			foreach ($req as $test) {
				echo $test;
			}
			?>
			<br/>
			<label class="text-base" for="rue">Date Commande :</label>
			<?php
			$count = $bdd->prepare("SELECT DATE_COMMANDE FROM compte join commande using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);

			foreach ($req as $test) {
				echo $test;
			}
			?>
			<br/>
			<label class="text-base" for="rue">Etat Commande :</label>
			<?php
			$count = $bdd->prepare("SELECT ETAT_COMMANDE FROM compte join commande using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);

			foreach ($req as $test) {
				if ($test=="EN COURS") {
					echo "<p><font color =\"blue\">";
					echo $test;
					echo "</font></p>";
				}
				if ($test=="EN ATTENTE DE VALIDATION") {
					echo "<p><font color =\"orange\">";
					echo $test;
					echo "</font></p>";
				}
				else if ($test=="VALIDE") {
					echo "<p><font color =\"green\">";
					echo $test;
					echo "<br/>";
					echo "Votre commande est prête à être enlevée.";
					echo "</font></p>";

				}
				if ($test=="REFUSE") {
					echo "<p><font color =\"red\">";
					echo $test;
					echo "<br/>";
					echo "Votre commande a été refusée. Allez voir votre boîte mail pour plus d'informations.";
					echo "</font></p>";

				}

			}


			?>

		</fieldset>
	</center>
</body>
</html>




