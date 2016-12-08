<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'menu.php';
?>
<html>
<head><TITLE>test</TITLE>
	<meta charset="utf-8">
</head>
<body>
<br/><br/><br/>
<?php
$sql = "select IDENTIFIANT, NUMERO_COMPTE, ADRESSE, CODE_POSTALE, VILLE , ID_EDITEUR, NOM from compte join editeur using (NUMERO_COMPTE) where ID_EDITEUR is not null and VALIDE not in (select VALIDE from editeur where VALIDE = 0) ";
$tab = AfficherTabCompte($sql, $bdd);

   function AfficherTabCompte($sql, $bdd){
	   
	 
    $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
	 while ($test = $tab->fetch())
	 {
		 
	echo '<table border="1">';
	echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> ADRESSE</td><td>CODE_POSTALE</td><td>VILLE</td><td>ID_EDITEUR</td><td>NOM</td></tr>';
	foreach($tab as $key => $ligne){
		echo '<tr>';
			foreach($ligne as $cle =>$valeur){
				echo '<td>';
				echo "$cle : ";
				$valeur = utf8_encode($valeur);
				echo $valeur."\t";
				echo'</td>';
      }
		echo'</tr>';
    }
  echo '</table>';
	}
  }
?>
</body>
</html>