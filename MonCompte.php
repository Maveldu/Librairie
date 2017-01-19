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
	</center>
<center>
<fieldset>
	<legend>Mes commandes :</legend>
<?php
$sql = "select NUMERO_COMMANDE, NUMERO_COMPTE, DATE_COMMANDE, ETAT_COMMANDE from commande join compte using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'";
$tab = AfficherTabCompte($sql, $bdd);

function AfficherTabCompte($sql, $bdd){


	$tab = $bdd->query($sql,PDO::FETCH_ASSOC);



	foreach($tab as $utilisateur){
		          echo "<fieldset>";
		          echo "Numero de commande : ";
                  echo $utilisateur['NUMERO_COMMANDE'];
		          echo "<br/>";
		          echo "Date de la commande : ";
		          if ($utilisateur['DATE_COMMANDE'] == null) {
			      echo "Non définie";
		          }
				  else {

					  echo $utilisateur['DATE_COMMANDE'];
				  }
		          echo "<br/>";
		          echo "Etat de la commande : ";


		if ($utilisateur['ETAT_COMMANDE']=="EN COURS") {
			echo "<p><font color =\"blue\">";
			echo "Prêt à ajouter des articles";
			echo "</font></p>";
		}
		if ($utilisateur['ETAT_COMMANDE']=="EN ATTENTE DE VALIDATION") {
			echo "<p><font color =\"orange\">";
			echo "En attente de validation";
			echo "</font></p>";
		}
		else if ($utilisateur['ETAT_COMMANDE']=="VALIDE") {
			echo "<p><font color =\"green\">";
			echo "Validé";
			echo "<br/>";
			echo "Votre commande est prête à être enlevée.";
			echo "</font></p>";
			$commande=$utilisateur['NUMERO_COMMANDE'];
			echo "<input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Supprimer la commande\"
                           onclick=\"self.location.href='supprimer_commande.php?com=$commande'\">";
			echo "<br/>";

		}
		if ($utilisateur['ETAT_COMMANDE']=="REFUSE") {
			echo "<p><font color =\"red\">";
			echo "Refusé";
			echo "<br/>";
			echo "Votre commande a été refusée. Allez voir votre boîte mail pour plus d'informations.";
			echo "</font></p>";
			$commande=$utilisateur['NUMERO_COMMANDE'];
			echo "<input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Supprimer la commande\"
                           onclick=\"self.location.href='supprimer_commande.php?com=$commande'\">";
			echo "<br/>";
		}
		echo "____________________________";
		echo "</fieldset>";

	}

}
?>

<?php

if (isset($_POST['valider'])) :
echo "test";
endif;
if (isset($_POST['supprimer'])) :

	echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
endif;
?>
	</fieldset>
</center>
</body>
</html>




