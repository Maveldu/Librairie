<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<html>
<div align="center">
<?php

echo "<br/>";
echo "<br/>";

echo "<h1>";
echo "<b>";
echo "Contenu de la commande : ";
echo "</b>";
echo "<br/>";
echo "</h1>";
$comm = $_GET['num'];

$sql = "select Couverture, NUMERO_COMMANDE, ISBN_ISSN, QTE_CMDEE, PRIX_UNIT from lig_cde join article using (ISBN_ISSN) WHERE NUMERO_COMMANDE = '".$comm."'";
$tab = AfficherTabCompte($sql, $bdd);
function AfficherTabCompte($sql, $bdd){
$tab = $bdd->query($sql,PDO::FETCH_ASSOC);
foreach($tab as $contenu) {
    echo "Couverture : ";
    echo "<br/>";
    $img = $contenu['ISBN_ISSN']. ".jpg";
    echo '<img src="./couverture/' . $img . '" style="width:250px;height:300px;padding:0px;border:1px;"/>';
    echo "<br/>";
    echo "Numero : ";
    echo $contenu['NUMERO_COMMANDE'];
    echo "<br/>";
    echo "ISBN : ";
    echo $contenu['ISBN_ISSN'];
    echo "<br/>";
    echo "Quantité : ";
    echo $contenu['QTE_CMDEE'];
    echo "<br/>";
    echo "Prix : ";
    echo $contenu['PRIX_UNIT'];
    echo "<br/>";
}
}

?>
<input class="btn btn-default" type="button" name="Retour" value="Retour"
                                onclick="self.location.href='form_commande.php'"></div>
<br/>
<br/>
</html>
