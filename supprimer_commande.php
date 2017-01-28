<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php

echo "<br/>";
echo "<br/>";
echo "<br/>";
$commande = $_GET['com'];
$test = $_GET['sup'];
if ($test == 1) {
    $sql = "UPDATE commande set ETAT_COMMANDE =\"ANNULE\" where NUMERO_COMPTE = (select NUMERO_COMPTE from compte WHERE IDENTIFIANT = '" . $_SESSION['id'] . "') and NUMERO_COMMANDE ='" . $commande . "'";
    $bdd->exec($sql);
}
else {
    $sql = "UPDATE commande set ETAT_COMMANDE =\"TERMINE\" where NUMERO_COMPTE = (select NUMERO_COMPTE from compte WHERE IDENTIFIANT = '" . $_SESSION['id'] . "') and NUMERO_COMMANDE ='" . $commande . "'";
    $bdd->exec($sql);
}
?>
<script language="javascript">
    setTimeout("location.href = 'MonCompte.php'",0);
</script>
