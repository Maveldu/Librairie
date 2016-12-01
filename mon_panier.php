<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Mon Panier"; //Titre ‡ changer sur chaque page
require_once 'menu.php';



?>
<br/><br/>
<br/><br/>
<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">Mon Panier</div>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>