<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'menu.php';
?>
<html>
<head><TITLE>test</TITLE>
	<meta charset="utf-8">
	<script type="text/javascript" src="script_compte_pro.js"></script>
</head>
<body>
<br/><br/><br/>
<form method="post">
<?php
$sql = "select IDENTIFIANT, NUMERO_COMPTE, ADRESSE, CODE_POSTALE, VILLE , NUMERO_PRO from compte join compte_client_pro using (NUMERO_COMPTE) where VALIDE = 0 ";
$tab = AfficherTabCompte($sql, $bdd);

   function AfficherTabCompte($sql, $bdd){
	   
	 
    $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
	
	/*
	 while ($test = $tab->fetch())
	 {
		

		
	echo '<table border="1">';
	echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> ADRESSE</td><td>CODE_POSTALE</td><td>VILLE</td><td>NUMERO_PRO</td><td>VALIDE</td><td>SUPPRIMER</td></tr>';
	foreach($tab as $key => $ligne){
		echo '<tr>';
		
			foreach($ligne as $cle =>$valeur){
				echo '<td>';
				echo "$cle : ";
				$valeur = utf8_encode($valeur);
				echo $valeur."\t";
					
				echo'</td>';
      }
				?>		
				 <td>
				<input class="btn btn-default" type="submit" name="valider" value="Valider"/>
				 </td>
				<?php
				?>
				 <td>
                <input class="btn btn-default" type="button" name="supprimer" value="Supprimer"/>
				 </td>
				<?php
			
		echo'</tr>';
    }
  echo '</table>';
	}
	*/
	echo '<table border="1">';
	echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> ADRESSE</td><td>CODE_POSTALE</td><td>VILLE</td><td>NUMERO_PRO</td><td>VALIDE</td><td>SUPPRIMER</td></tr>';
	foreach($tab as $utilisateur){
		
          echo "<tr>
                  <td>",$utilisateur['IDENTIFIANT'],"</td>
                  <td>",$utilisateur['NUMERO_COMPTE'],"</td>
                  <td>",$utilisateur['ADRESSE'],"</td>
                  <td>",$utilisateur['CODE_POSTALE'],"</td>
                  <td>",$utilisateur['VILLE'],"</td>
                  <td>",$utilisateur['NUMERO_PRO'],"</td>
                  <td><input class='btn btn-default' type='submit' name='valider_",$utilisateur['NUMERO_COMPTE'],"' value='Valider' id='val' onClick=\"getname(this)\"/></td>
				  <td><input class='btn btn-default' type='submit' name='supprimer_",$utilisateur['NUMERO_COMPTE'],"' value='Supprimer' id='suppr' onClick=\"getname(this)\"/></td>
                </tr>";
          }
		    echo '</table>';
  }
?>

<?php

if (isset($_POST['valider'])) :
 
endif;
if (isset($_POST['supprimer'])) :
    $bdd->exec('DELETE FROM compte_client_pro WHERE NUMERO_PRO="' . $_POST['delete'] . '"');
    $bdd->exec('DELETE FROM compte WHERE NUMERO_COMPTE in (select NUMERO_COMPTE from compte_client_pro where NUMERO_PRO= "' . $_POST['delete'] . '"');
    echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
endif;
echo "<br/>";

?>


<input type="checkbox" name="hidd" id="hid" value="" hidden>
<?php 
if(isset($_POST['hidd'])){
	$explode = explode("_",$_POST['hidd']);
    $id_user = $explode[1];
	echo $id_user;
	if($explode[0] == "valider"){
		$sql = "UPDATE compte_client_pro set VALIDE = 1 where NUMERO_COMPTE=".$id_user;
		$bdd->exec($sql);
		echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
	}	
	else if($explode[0] == "supprimer"){
		$sql1 = "DELETE FROM compte_client_pro WHERE NUMERO_COMPTE=".$id_user;
		$bdd->exec($sql1);
		echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
		echo "supprimer";
	}
	
	}
?>
</form>

</body>
</html>