<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<br/><br/>

<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Mon Panier"; //Titre à changer sur chaque page
require_once 'menu.php';
error_reporting(0);
if(isset($_POST["valider"])){

	//Bloque le rechargement de la page
	if(!isset($_SESSION['nb_chargements'])) $_SESSION['nb_chargements']=0;
	elseif(isset($_GET['reset']) && $_GET['reset']==1) $_SESSION['nb_chargements']=0;

	$nb_chargements = intval($_SESSION['nb_chargements']);
	$_SESSION['nb_chargements'] = ++$nb_chargements;

	if($nb_chargements>1) {

		$chargement = "Impossible de recharger la page";
		if(isset($_SESSION['nb_chargements'])) $_SESSION['nb_chargements']=0;
		?>
		<script language="javascript">
			setTimeout("location.href = 'MonCompte.php'",1);
		</script>
		<?php
		echo '<script type="text/javascript">window.alert("'.$chargement.'");</script>';
		die();
	}



	//Bloque au maximum à 5 articles différents par commande
	$req = "SELECT max(NUMERO_COMMANDE) as max FROM commande";
	$TabMaxCmdee = LireDonneesPDO1($bdd, $req);
	$MaxCmdee = $TabMaxCmdee['0']['max'];

	$req="SELECT count(ISBN_ISSN) as nbarticle FROM lig_cde join article using (ISBN_ISSN) WHERE NUMERO_COMMANDE = '$MaxCmdee'";
	$nbart=LireDonneesPDO1($bdd, $req);
	$art=$nbart['0']['nbarticle'];
	if ($art>6) {
		?>
		<center>
			<p>
				Vous ne pouvez commander que cinq articles différents par commande (hors quantité d'article identique). <br/>
				Merci de supprimer un ou des articles et d'effectuer deux commandes différentes.
				<br/>
				<input class="btn btn-default" type="button" name="Retour" value="Retour"
					   onclick="self.location.href='mon_panier.php'">
			</p>
		</center>
		<?php
	}
	else {
		//Commande validé
		echo "<br/><br/>&nbsp&nbsp&nbsp";
		echo "Votre commande a été validée par nos services. Vous pourrez récuperer vos articles à la librairie une fois celle-ci acceptée.";
		echo "<br/><br/><b>&nbsp&nbsp&nbsp";
		echo "Pour plus d'informations, rendez-vous dans la page \"Mon Compte\" pour voir son statut.";
		echo "</b>";
		$date = date("d-m-Y");
		$req = "UPDATE commande SET etat_commande='EN ATTENTE DE VALIDATION', date_commande = '" . $date . "' WHERE etat_commande='EN COURS' and NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
		$res = ExecuterRequete($bdd, $req);
		$req = "SELECT max(NUMERO_COMMANDE) as max FROM commande";
		$TabMaxCmdee = LireDonneesPDO1($bdd, $req);
		$MaxCmdee = $TabMaxCmdee['0']['max'] + 1;
		$req = "INSERT INTO commande(NUMERO_COMPTE, NUMERO_COMMANDE) VALUES((SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')," . $MaxCmdee . ")";
		$res = ExecuterRequete($bdd, $req);
		//nom client
		$req = "SELECT NOM as nomclient FROM client where NUMERO_COMPTE =(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
		$nom = LireDonneesPDO1($bdd, $req);
		$nomcli = $nom['0']['nomclient'];
		//prenom client
		$req = "SELECT PRENOM as prenomclient FROM client where NUMERO_COMPTE =(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
		$prenom = LireDonneesPDO1($bdd, $req);
		$prenomcli = $prenom['0']['prenomclient'];
		//numeroclient
		$req = "SELECT NUMERO_COMPTE as numcompte FROM client where NUMERO_COMPTE =(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
		$numerocompte = LireDonneesPDO1($bdd, $req);
		$numecompte = $numerocompte['0']['numcompte'];
		//contenu de la commande
		$MaxCmdee = $MaxCmdee - 1;
		//compte le nombre d'article dans la commande
		$req = "SELECT count(ISBN_ISSN) as nbarticle FROM lig_cde join article using (ISBN_ISSN) WHERE NUMERO_COMMANDE = '$MaxCmdee'";
		$nbart = LireDonneesPDO1($bdd, $req);
		$art = $nbart['0']['nbarticle'];
		//Récupère les articles dans la commande
		$sql = "select TITRE, NUMERO_COMMANDE, ISBN_ISSN, QTE_CMDEE, PRIX_UNIT from lig_cde join article using (ISBN_ISSN) WHERE NUMERO_COMMANDE = '$MaxCmdee'";
		$tab = LireDonneesPDO1($bdd, $sql);
		$tab = $bdd->query($sql, PDO::FETCH_ASSOC);

		$i = 0;
		$message0="";
		$message1="";
		$message2="";
		$message3="";
		//ajoute dans le mail les articles de la commande
		foreach ($tab as $article) {
			$titre = $article['TITRE'];
			$numero_commande = $article['NUMERO_COMMANDE'];
			$isbn_issn = $article['ISBN_ISSN'];
			$qte_cmdee = $article['QTE_CMDEE'];
			$prix_unit = $article['PRIX_UNIT'];


			if ($art == 2) {
				$message0 = '
       <p>Titre : ' . $titre . '</p>
       <p>ISBN_ISSN : ' . $isbn_issn . '</p>
       <p>Quantité : ' . $qte_cmdee . ' </p>
       <p>Prix unitaire : ' . $prix_unit . '</p>
       ';
				$art = 0;
			}
			if ($art == 3) {
				$message1 = '
       <p>Titre : ' . $titre . '</p>
       <p>ISBN_ISSN : ' . $isbn_issn . '</p>
       <p>Quantité : ' . $qte_cmdee . ' </p>
       <p>Prix unitaire : ' . $prix_unit . '</p>
       ';
				$art = $art - 1;
			}
			if ($art == 4) {
				$message2 = '
       <p>Titre : ' . $titre . '</p>
       <p>ISBN_ISSN : ' . $isbn_issn . '</p>
       <p>Quantité : ' . $qte_cmdee . ' </p>
       <p>Prix unitaire : ' . $prix_unit . '</p>
       ';
				$art = $art - 1;
			}
			if ($art == 5) {
				$message3 = '
       <p>Titre : ' . $titre . '</p>
       <p>ISBN_ISSN : ' . $isbn_issn . '</p>
       <p>Quantité : ' . $qte_cmdee . ' </p>
       <p>Prix unitaire : ' . $prix_unit . '</p>
       <p>Rendez-vous sur la page "Gestion des commandes" pour accepter ou refuser celle-ci.<p>
       ';
				$art = $art - 1;
			}

		}

		?>
		<br/><br/>
		<input class="btn btn-default" type="button" name="Retour à l'accueil" value="Retour à l'accueil"
			   onclick="self.location.href='index.php'">
		<input class="btn btn-default" type="button" name="Mon Compte" value="Mon Compte"
			   onclick="self.location.href='MonCompte.php'">
		<?php
		//Système de mail
		$sql = "select ADRESSE_MAIL from compte join compte_gerantp using (NUMERO_COMPTE)";
		$tab = LireDonneesPDO1($bdd, $sql);
		$tab = $bdd->query($sql, PDO::FETCH_ASSOC);
		foreach ($tab as $utilisateur) {
			$mail = $utilisateur['ADRESSE_MAIL'];
		}
		//mail
		$to = $mail;

		// Sujet
		$subject = 'Commmande d\'article(s) n°' . $MaxCmdee;

		// message
		$message = '
     <html>
      <head>
       <title>Commande d\'article(s) n°' . $MaxCmdee . '</title>
      </head>
      <body>
      <p>Bonjour,</p>
      <p>Le client ' . $nomcli . ' ' . $prenomcli . ' n°' . $numecompte . ' souhaiterai faire une commande</p>
       <p>Voici le(s) article(s) commandé(s)</p>
       <p>Numéro commande : ' . $numero_commande . '</p>
       <p>Titre : ' . $titre . '</p>
       <p>ISBN_ISSN : ' . $isbn_issn . '</p>
       <p>Quantité : ' . $qte_cmdee . ' </p>
       <p>Prix unitaire : ' . $prix_unit . '</p>
       <p>
       ' . $message0 . '
       </p>
       <p>
       ' . $message1 . '
       </p>
       <p>
       ' . $message2 . '
       </p>
        <p>
       ' . $message3 . '
       </p>
      </body>
     </html>
     ';
		// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// En-tête additionnel
		$headers .= 'From: LibrairieAssociative175 <LibrairieAssociative175@ne-pas-repondre.fr>' . "\r\n";

		// Envoi
		mail($to, $subject, $message, $headers);
	}
}
else{
	$req="SELECT NUMERO_COMMANDE FROM commande WHERE upper(ETAT_COMMANDE) = 'EN COURS' and NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
	$TabNumCommande=LireDonneesPDO1($bdd, $req);
	$N_Commande=$TabNumCommande['0']['NUMERO_COMMANDE'];

	if(isset($_POST["suppr_isbn"])){
		$qte_suppr=$_POST["suppr_nb_".$_POST["suppr_isbn"]];
		if($qte_suppr<1){$qte_suppr=1;}
		$req="SELECT qte_cmdee FROM lig_cde WHERE numero_commande=".$N_Commande." and isbn_issn=".$_POST['suppr_isbn']."";
		$tab_qte_cmdee=LireDonneesPDO1($bdd, $req);
		$qte_cmdee=$tab_qte_cmdee['0']['qte_cmdee'];
		$qte_finale=$qte_cmdee-$qte_suppr;
		if($qte_finale>0){
			$del="UPDATE lig_cde SET qte_cmdee = ".$qte_finale." WHERE numero_commande=".$N_Commande." and isbn_issn=".$_POST['suppr_isbn']."";
			$res=ExecuterRequete($bdd, $del);
		}else{
			$del="DELETE FROM lig_cde WHERE numero_commande=".$N_Commande." and isbn_issn=".$_POST['suppr_isbn']."";
			$res=ExecuterRequete($bdd, $del);
		}
	}

	error_reporting(0);
	$req="SELECT ISBN_ISSN, QTE_CMDEE, PRIX_UNIT FROM lig_cde where NUMERO_COMMANDE ='".$N_Commande."';";
	$ElemCmde=LireDonneesPDO1($bdd, $req);
	error_reporting(1);

	foreach($ElemCmde as $n=>$e){
		$req="SELECT TITRE, NOM_EDITEUR, DATE_PARUTION FROM article WHERE ISBN_ISSN='".$e['ISBN_ISSN']."'";
		$ArticleCmde=LireDonneesPDO1($bdd, $req);
		$infosArticle[$e['ISBN_ISSN']]['LIEN_COUV']='./couverture/'.$e['ISBN_ISSN'].'.jpg';
		$infosArticle[$e['ISBN_ISSN']]['TITRE']=$ArticleCmde[0]['TITRE'];
		$infosArticle[$e['ISBN_ISSN']]['NOM_EDITEUR']=$ArticleCmde[0]['NOM_EDITEUR'];
		$infosArticle[$e['ISBN_ISSN']]['DATE_PARUTION']=$ArticleCmde[0]['DATE_PARUTION'];
		$infosArticle[$e['ISBN_ISSN']]['QTE_CMDEE']=$e['QTE_CMDEE'];
		$infosArticle[$e['ISBN_ISSN']]['PRIX_UNIT']=$e['PRIX_UNIT'];
	}

	?>
	<form method="post" action="#">
	<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">Mon Panier</div>
	</div>
	<div class="panel-body">
	<?php
	if(!$ElemCmde){
		echo "Vous n'avez pas d'article dans votre panier";
		echo "</div></div>";
	}else{
		?>
		<table style='width:100%;'>
			<tr>
				<th>
					ISBN
				</th>
				<th>
					Couverture
				</th>
				<th>
					Titre
				</th>
				<th>
					Editeur
				</th>
				<th>
					Date de parution
				</th>
				<th>
					Quantité commandée
				</th>
				<th>
					Prix unitaire
				</th>
				<th>
					Total article
				</th>
				<th>
					Supprimer du panier
				</th>
			</tr>
			<?php
			$total=0;
			foreach ($infosArticle as $isbn=>$infos){

				echo "<tr>";
				echo "<td>";
				echo $isbn;
				echo "</td>";
				echo "<td>";
				echo "<img src=".$infos['LIEN_COUV']." style='height:150px;'>";
				echo "</td>";
				echo "<td>";
				echo $infos['TITRE'];
				echo "</td>";
				echo "<td>";
				echo $infos['NOM_EDITEUR'];
				echo "</td>";
				echo "<td>";
				echo $infos['DATE_PARUTION'];
				echo "</td>";
				echo "<td>";
				echo $infos['QTE_CMDEE'];
				echo "</td>";
				echo "<td>";
				echo $infos['PRIX_UNIT'].'€';
				echo "</td>";
				echo "<td>";
				echo $infos['PRIX_UNIT']*$infos['QTE_CMDEE'].'€';
				echo "</td>";
				echo "<td>";
				echo "<input type='texte' name='suppr_nb_".$isbn."' style ='float: right' size='5' value='1'/>";
				echo "<input type='image' src='supprimer.png' name='suppr_isbn' alt='Submit' align='right' width='32' height='32' value='".$isbn."'/>";
				echo "</td>";
				echo "</tr>";
				$total+=$infos['PRIX_UNIT']*$infos['QTE_CMDEE'];
			}


			?>
			<tr>
				<td colspan='6'>
				</td>
				<th>
					Total
				</th>
				<th>
					<?php echo $total."€";?>
				</th>
				<td>
				</td>
			</tr>
		</table>
		</div>
		</div>
		<div style="text-align:right;padding-right:15px;">
			<input class="btn btn-primary" type="submit" name="valider" value="Valider la commande" />
		</div>

		</form>
		<?php
	}
}
?>

