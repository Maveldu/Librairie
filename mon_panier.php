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

if(isset($_POST["valider"])){
	echo "<br/><br/>&nbsp&nbsp&nbsp";
	echo "Votre commande a été validée par nos services. Vous pourrez récuperer vos articles à la librairie une fois celle-ci accepté.";
	echo "<br/><br/><b>&nbsp&nbsp&nbsp";
	echo "Pour plus d'informations rendez-vous dans la page \"Mon Compte\" pour voir son statut.";
	echo "</b>";
	$date = date("d-m-Y");
	$req="UPDATE commande SET etat_commande='EN ATTENTE DE VALIDATION', date_commande = '".$date."' WHERE etat_commande='EN COURS' and NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '".$_SESSION['id']."')";
	$res=ExecuterRequete($bdd, $req);
	$req="SELECT max(NUMERO_COMMANDE) as max FROM commande";
	$TabMaxCmdee=LireDonneesPDO1($bdd, $req);
	$MaxCmdee=$TabMaxCmdee['0']['max']+1;
	$req="INSERT INTO commande(NUMERO_COMPTE, NUMERO_COMMANDE) VALUES((SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '".$_SESSION['id']."'),".$MaxCmdee.")";
	$res=ExecuterRequete($bdd, $req);
	?>
	<br/><br/>
	<input class="btn btn-default" type="button" name="Retour à l'accueil" value="Retour à l'accueil"
		   onclick="self.location.href='index.php'">
	<input class="btn btn-default" type="button" name="Mon Compte" value="Mon Compte"
		   onclick="self.location.href='MonCompte.php'">
	<?php
}else{
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
				echo "Vous n'avez pas d'atricle dans votre panier";
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