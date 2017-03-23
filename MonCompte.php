<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = 'Mon compte';
require_once 'menu.php';
?>
<br/><br/>
<br/>

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
			<?php if (f_compte($bdd)!="admin") { ?>
			<label class="text-base" for="rue">Nom :</label>
			<?php
			$count = $bdd->prepare("SELECT NOM FROM from compte join compte_client using (NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count = $bdd->prepare("SELECT NOM FROM compte join client using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);
			foreach ($req as $test) {
				echo $test;
			}
			?><br/>

			<label class="text-base" for="rue">Prénom :</label>
			<?php
			$count = $bdd->prepare("SELECT PRENOM FROM compte_client join compte using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count = $bdd->prepare("SELECT PRENOM FROM compte join client using(NUMERO_COMPTE) WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);

			foreach ($req as $test) {
				echo $test;
			}
			}?><br/>


			<label class="text-base" for="rue">Adresse Mail : </label>
			<?php
			$count = $bdd->prepare("SELECT ADRESSE_MAIL FROM compte WHERE IDENTIFIANT = '".$_SESSION['id']."'");
			$count->execute(array($_SESSION['id']));
			$req = $count->fetch(PDO::FETCH_ASSOC);

			foreach ($req as $test) {
				echo $test;
			}
			?><br/>

			<label class="text-base" for="rue">Numéro de téléphone :</label>
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
			<label class="text-base">Code Postal :</label>
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
			$cancel = 0;
			function AfficherTabCompte($sql, $bdd){


				$tab = $bdd->query($sql,PDO::FETCH_ASSOC);

				if (f_compte($bdd)!="admin") {
					echo "<font color =\"blue\">Vous pouvez ajouter de nouveaux articles à votre panier.</font>";
					echo "<br/>____________________________";
				}
				foreach($tab as $utilisateur){

					if ($utilisateur['ETAT_COMMANDE']=="EN COURS"){
					}elseif ($utilisateur['ETAT_COMMANDE']=="EN ATTENTE DE VALIDATION" or $utilisateur['ETAT_COMMANDE']=="VALIDE" or $utilisateur['ETAT_COMMANDE']=="REFUSE") {
						echo "<fieldset>";
						echo "Numero : ";
						echo "<b>";
						echo $utilisateur['NUMERO_COMMANDE'];
						echo "</b>";
						echo "&nbsp";
						echo "Date : ";
						if ($utilisateur['DATE_COMMANDE'] == null) {
							echo "<b>";
							echo "Non définie";
							echo "</b>";
						} else {
							echo "<b>";
							echo $utilisateur['DATE_COMMANDE'];
							echo "</b>";
						}
						echo "<br/>";
						echo "État : ";
						if ($utilisateur['ETAT_COMMANDE'] == "EN ATTENTE DE VALIDATION") {
							echo "<font color =\"orange\">";
							echo "En attente de validation par un administrateur";
							echo "</font>";
							echo "<br/>";
							$commande = $utilisateur['NUMERO_COMMANDE'];
							$cancel = 1;
							echo "<input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Annuler la commande\"
                           onclick=\"self.location.href='supprimer_commande.php?com=$commande&amp;sup=$cancel'\">";
							echo "</br>";
						} else if ($utilisateur['ETAT_COMMANDE'] == "VALIDE") {
							echo "<font color =\"green\">";
							echo "Validée";
							echo "<br/>";
							echo "Votre commande est prête à être récupérée à la librairie.";
							echo "</font>";
							echo "<br/>";
							$commande = $utilisateur['NUMERO_COMMANDE'];
							$cancel = 0;
							echo "<input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Retirer de l'historique\"
                           onclick=\"self.location.href='supprimer_commande.php?com=$commande&amp;sup=$cancel'\">";
							echo "<br/>";

						}
						if ($utilisateur['ETAT_COMMANDE'] == "REFUSE") {
							echo "<font color =\"red\">";
							echo "Refusée";
							echo "<br/>";
							echo "Votre commande a été refusée. Allez voir votre boîte mail pour plus d'informations.";
							echo "</font>";
							echo "<br/>";
							$commande = $utilisateur['NUMERO_COMMANDE'];
							$cancel = 0;
							echo "<input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Retirer de l'historique\"
                           onclick=\"self.location.href='supprimer_commande.php?com=$commande&amp;sup=$cancel'\">";
							echo "<br/>";
						}
						echo "____________________________";
						echo "</fieldset>";
					}
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




