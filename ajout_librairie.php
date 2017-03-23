<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Ajout à la librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<html>
<body>
<br><br><br><br>
<center>
    <h1>Menu d'ajouts à la librairie</h1>
    <br/>
    <?php if (f_compte($bdd)=="admin") { ?>
        <a class="btn btn-primary" href="ajouter_article.php">Ajouter un Article</a><br><br>
        <a class="btn btn-primary" href="ajouter_auteur.php">Ajouter un Auteur</a><br><br>
        <a class="btn btn-primary" href="ajouter_editeur.php">Ajouter un Editeur</a><br><br>
        <a class="btn btn-primary" href="index.php">Retour à l'Accueil </a><br><br>
    <?php } ?>
</center>
</body>
</html>