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
<body>
<br><br><br><br>
<center>
    <h1>Panneau Administration des Comptes</h1>
<?php if (f_compte($bdd)=="admin") { ?>
    <a class="btn btn-danger" href="form_compte_admin.php">Créer un Compte Gérants</a><br><br>
    <a class="btn btn-danger" href="form_compte_client_pro.php">Gerer des comptes Clients Professionnels</a><br><br>
    <a class="btn btn-danger" href="form_compte_fournisseur.php">Gestion des comptes Fournisseurs</a><br><br>
    <a class="btn btn-danger" href="form_compte_admin.php">Gestion des comptes Gérants</a><br><br>
<?php } ?>
</center>
</body>
</html>