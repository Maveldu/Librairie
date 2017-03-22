<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Gestion des comptes"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<html>
<body>
<br><br><br><br>
<center>
    <h1>Menu d'administration des comptes</h1>
    <br/>
<?php if (f_compte($bdd)=="admin") { ?>
    <a class="btn btn-primary" href="form_compte_admin.php">Créer un Compte "Gérant"</a><br><br>
    <a class="btn btn-primary" href="form_compte_client_pro.php">Gestion des comptes "Client Professionnel"</a><br><br>
    <a class="btn btn-primary" href="form_compte_fournisseur.php">Gestion des comptes "Fournisseur"</a><br><br>
    <a class="btn btn-primary" href="form_compte_admin.php">Gestion des comptes "Gérant"</a><br><br>
<?php } ?>
</center>
</body>
</html>