<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<br/><br/>
<br/><br/>

<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Mon Panier"; //Titre ‡ changer sur chaque page
require_once 'menu.php';

$req="SELECT NUMERO_COMMANDE FROM commande WHERE upper(ETAT_COMMANDE) = 'EN COURS' and NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')";
$TabNumCommande=LireDonneesPDO1($bdd, $req);
$N_Commande=$TabNumCommande['0']['NUMERO_COMMANDE'];

$req="SELECT ISBN_ISSN, QTE_CMDEE, PRIX_UNIT FROM lig_cde where NUMERO_COMMANDE ='".$N_Commande."'";
$ElemCmde=LireDonneesPDO1($bdd, $req);
print_r($ElemCmde);
?>
<br/><br/>
<br/><br/>
<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">Mon Panier</div>
  </div>
  <div class="panel-body">
    <?php 
      //foreach ();
    
    ?>
  </div>
</div>